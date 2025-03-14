<?php

namespace App\Services;

use DateTimeInterface;
use Spatie\SchemaOrg\BlogPosting;
use Spatie\SchemaOrg\CollectionPage;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\Product;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\WebSite;

class JsonLd
{
    public string $lang;

    public string $siteName;

    public string $companyName;

    public \Spatie\SchemaOrg\ImageObject $logo;

    public \Spatie\SchemaOrg\ListItem $homeBreadcrumb;

    public Graph $graph;

    public \Spatie\SchemaOrg\ImageObject $authorAvatar;

    public function __construct($lang = '')
    {
        $this->lang = \Str::replace('_', '-', $lang ?: app()->getLocale());
        $this->siteName = config('setting.'.$this->lang.'.site_name') ?: '';
        $this->companyName = config('setting.'.$this->lang.'.company_name') ?: $this->siteName;
        $this->logo = Schema::imageObject()->url(config('app.url').'/'.config('setting.logo'))
            ->identifier(config('app.url').'/#logo')
            ->caption(config('setting.'.$this->lang.'.site_name'))
            ->width(Schema::quantitativeValue()->value(500))
            ->height(Schema::quantitativeValue()->value(200))
            ->inLanguage($this->lang);
        $this->authorAvatar = Schema::imageObject()
            ->identifier('https://avatars.githubusercontent.com/u/3113752?v=4')
            ->url('https://avatars.githubusercontent.com/u/3113752?v=4')
            ->caption(config('setting.'.$this->lang.'.site_name'))
            ->inLanguage($this->lang);
        $this->homeBreadcrumb = Schema::listItem()->position(1)->item(['name' => __('Home'), '@id' => config('app.url')]);

        $this->graph = new Graph;

    }

    /**
     * 生成首页Graph
     *
     * @param  string|null  $cover  首页产品代表图
     */
    public function generateHomeGraph(?string $cover = null): Graph
    {
        $this->buildOrganization();
        $this->buildWebSite();
        if ($cover) {
            $this->graph->imageObject()
                ->identifier($cover)
                ->url($cover)
                ->width(Schema::quantitativeValue()->value(200))
                ->height(Schema::quantitativeValue()->value(200))
                ->inLanguage($this->lang);
        }

        $this->buildPerson();

        $this->buildWebPage();

        return $this->graph;

    }

    /**
     * 生成博客列表页Graph
     *
     * @param  string  $title  标题
     * @param  string  $cover  封面
     */
    public function generateBlogListGraph(string $title, string $cover = ''): Graph
    {
        $this->buildOrganizationById();
        $this->buildWebSite();
        if ($cover) {
            $this->graph->imageObject()
                ->identifier($cover)
                ->url($cover)
                ->width(Schema::quantitativeValue()->value(200))
                ->height(Schema::quantitativeValue()->value(200))
                ->inLanguage($this->lang);
        }

        $this->graph->breadcrumbList()->identifier(\Request::fullUrl().'#breadcrumb')
            ->itemListElement(
                [
                    $this->homeBreadcrumb,
                    Schema::listItem()->position(2)->item(['name' => __('Blog'), '@id' => \Request::url()]),
                ]
            );

        $this->graph->collectionPage()
            ->identifier(route('blog.index').'#webpage')
            ->url(\Request::url())
            ->name($title)
            ->about(Schema::thing()->identifier(config('app.url').'/#organization'))
            ->isPartOf(['@id' => config('app.url').'/#website'])
            ->if($cover, fn (CollectionPage $collectionPage) => $collectionPage->primaryImageOfPage(Schema::imageObject()->identifier($cover)))
            ->inLanguage($this->lang)
            ->breadcrumb(['@id' => $this->graph->breadcrumbList()->getProperty('identifier')]);

        return $this->graph;
    }

    /**
     * 生成博客详情页Graph
     *
     * @param  string  $title  文章标题
     * @param  DateTimeInterface  $datePublished  发布时间
     * @param  DateTimeInterface|null  $dateModified  修改时间
     * @param  string  $keywords  关键词
     * @param  string  $description  描述
     * @param  string  $cover  封面
     */
    public function generateBlogGraph(
        string $title,
        DateTimeInterface $datePublished,
        ?DateTimeInterface $dateModified = null,
        string $keywords = '',
        string $description = '',
        string $cover = ''): Graph
    {
        $this->buildOrganization();
        $this->buildWebSite();
        if ($cover) {
            $this->graph->imageObject()
                ->identifier($cover)
                ->url($cover)
                ->width(Schema::quantitativeValue()->value(1000))
                ->height(Schema::quantitativeValue()->value(500))
                ->caption($title)
                ->inLanguage($this->lang);
        }
        $this->graph->breadcrumbList()->identifier(\Request::fullUrl().'#breadcrumb')
            ->itemListElement(
                [
                    $this->homeBreadcrumb,
                    Schema::listItem()->position(2)->item(['name' => __('Blog'), '@id' => route('blog.index')]),
                    Schema::listItem()->position(3)->item(['name' => $title, '@id' => \Request::url()]),
                ]
            );
        $this->buildPerson();
        $this->buildWebPage();
        $this->buildBlogPosting($title, $datePublished, $dateModified, $keywords, $description, $cover);

        return $this->graph;
    }

    /**
     * 生成产品列表页Graph
     */
    public function generateProductListGraph(): Graph
    {
        $this->buildOrganizationById();
        $this->graph->breadcrumbList()->identifier(\Request::fullUrl().'#breadcrumb')
            ->itemListElement(
                [
                    $this->homeBreadcrumb,
                    Schema::listItem()->position(2)->item(['name' => __('Product'), '@id' => \Request::url()]),
                ]
            );

        return $this->graph;
    }

    /**
     * 生成产品详情页Graph
     *
     * @param  string  $title  产品名称
     * @param  string  $categoryName  分类名称
     * @param  string  $categoryUrl  分类链接
     * @param  DateTimeInterface  $datePublished  发布时间
     * @param  DateTimeInterface|null  $dateModified  修改时间
     * @param  string|null  $cover  产品代表图
     * @param  string|null  $description  描述
     * @param  string|string[]|null  $sku  型号
     * @param  string|null  $price  价格
     * @param  string|null  $priceCurrency  价格单位
     */
    public function generateProductGraph(
        string $title,
        string $categoryName,
        string $categoryUrl,
        DateTimeInterface $datePublished,
        ?DateTimeInterface $dateModified = null,
        ?string $cover = null,
        ?string $description = null,
        array|string|null $sku = null,
        ?string $price = null,
        ?string $priceCurrency = null): Graph
    {
        $this->buildOrganization();
        $this->buildWebSite();

        if ($cover) {
            $this->graph->imageObject()->identifier($cover)->url($cover)
                ->width(Schema::quantitativeValue()->value(1000))
                ->height(Schema::quantitativeValue()->value(800))
                ->caption($title)
                ->inLanguage($this->lang);
        }

        $this->graph->breadcrumbList()->identifier(\Request::fullUrl().'#breadcrumb')
            ->itemListElement(
                [
                    $this->homeBreadcrumb,
                    Schema::listItem()->position(2)->item(['name' => $categoryName ?? __('Product'), '@id' => $categoryUrl]),
                    Schema::listItem()->position(3)->item(['name' => $title, '@id' => \Request::fullUrl()]),
                ]
            );

        $this->buildPerson();

        $this->graph->itemPage()->identifier(\Request::fullUrl().'#webpage')
            ->url(\Request::fullUrl())
            ->name($title)
            ->datePublished($datePublished)
            ->dateModified($dateModified ?? $datePublished)
            ->author(Schema::person()->identifier($this->graph->person()->getProperty('identifier')))
            ->isPartOf(['@id' => $this->graph->webSite()->getProperty('identifier')])
            ->primaryImageOfPage(Schema::imageObject()->identifier($cover))
            ->inLanguage($this->lang)
            ->breadcrumb(['@id' => $this->graph->breadcrumbList()->getProperty('identifier')]);

        $this->graph->product()->identifier(\Request::fullUrl().'#richSnippet')
            ->name($title)
            ->sku($sku)
            ->if($cover, fn (Product $product) => $product->description($description))
            ->category($categoryName ?: __('Product'))
            ->mainEntityOfPage(Schema::webPage()->identifier(\Request::fullUrl().'#webpage'));

        if ($price) {
            $this->graph->product()->offers(
                Schema::offer()
                    ->price($price)
                    ->priceCurrency($priceCurrency ?? 'CNY')
                    ->availability(Schema::itemAvailability()::InStock)
                    ->seller(Schema::organization()->identifier(config('app.url').'/')
                        ->url(config('app.url'))
                        ->name($this->companyName)
                        ->logo($this->logo->getProperty('url')))
                    ->url(\Request::fullUrl().'#richSnippet')
            );
        }

        return $this->graph;
    }


    /**
     * 构建组织信息
     */
    private function buildOrganization(): void
    {
        $this->graph->organization()
            ->identifier(config('app.url').'/#organization')
            ->name($this->companyName)
            ->logo($this->logo);
    }

    /**
     * 构建组织信息 by identifier
     */
    private function buildOrganizationById(): void
    {
        $this->graph->organization()
            ->identifier(config('app.url').'/#organization')
            ->name($this->companyName);
    }

    /**
     * 构建网站信息
     */
    private function buildWebSite(): void
    {
        $this->graph->webSite()
            ->identifier(config('app.url').'/#website')
            ->url(config('app.url'))
            ->name($this->siteName)
            ->publisher(Schema::organization()->identifier($this->graph->organization()->getProperty('identifier')))
            ->inLanguage($this->lang)
            ->if(\Request::route()->getName() == 'home', function (WebSite $webSite) {
                $webSite->potentialAction(Schema::searchAction()
                    ->target(config('app.url').'/search?={search_string}')
                    ->setProperty('query-input', 'requiredname=search_string'));
            });
    }

    /**
     * 构建作者信息
     */
    private function buildPerson(): void
    {
        $this->graph->person()->identifier(\Request::fullUrl().'#author')->name(config('setting.'.$this->lang.'.site_name'))->image(
            $this->authorAvatar
        )->sameAs($this->graph->webSite()->getProperty('url'))
            ->worksFor($this->graph->organization()->getProperty('name'));
    }

    /**
     * 构建网站页面信息
     */
    public function buildWebPage(string $title = '', ?string $datePublished = null, ?string $dateModified = null): void
    {
        $this->graph->webPage()->identifier(\Request::fullUrl().'#webpage')
            ->url(\Request::fullUrl())
            ->name($title ?: $this->siteName)
            ->datePublished($datePublished ?? new \DateTime('2023-04-15 08:00:00'))
            ->dateModified($dateModified ?? now())
            ->author(['@id' => $this->graph->person()->getProperty('identifier')])
            ->isPartOf(['@id' => $this->graph->webPage()->getProperty('identifier')])
            ->primaryImageOfPage(['@id' => $this->graph->imageObject()->getProperty('identifier')])
            ->inLanguage($this->lang);
    }

    /**
     * 构建博客详情页面信息
     *
     * @param  string  $title  文章标题
     * @param  DateTimeInterface  $datePublished  发布时间
     * @param  DateTimeInterface|null  $dateModified  修改时间
     * @param  string  $keywords  关键词
     * @param  string  $description  描述
     * @param  string  $cover  封面
     */
    public function buildBlogPosting(
        string $title,
        DateTimeInterface $datePublished,
        ?DateTimeInterface $dateModified = null,
        string $keywords = '',
        string $description = '',
        string $cover = ''): void
    {
        $this->graph->blogPosting()->identifier(\Request::fullUrl().'#richSnippet')
            ->name($title)
            ->headline($title)
            ->keywords($keywords)
            ->description($description)
            ->datePublished($datePublished)
            ->dateModified($dateModified ?? $datePublished)
            ->author(['@id' => $this->graph->person()->getProperty('identifier')])
            ->publisher(['@id' => $this->graph->organization()->getProperty('identifier')])
            ->isPartOf(['@id' => $this->graph->webPage()->getProperty('identifier')])
            ->if($cover, fn (BlogPosting $blogPosting) => $blogPosting->image(Schema::imageObject()->identifier($cover)))
            ->mainEntityOfPage(['@id' => $this->graph->webPage()->getProperty('identifier')])
            ->inLanguage($this->lang);
    }
}
