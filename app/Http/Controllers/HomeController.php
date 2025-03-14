<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\ImageObject;
use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Thing;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return config('setting.en.site_name');
        $client = new \GuzzleHttp\Client([
            'verify' => 'D:\laragon\etc\ssl\cacert.pem',
        ]);
        $url = 'https://api.deepseek.com/chat/completions';
        $token = 'sk-a4119f2524db450cafada8b022a615bb';
        $data = [
            'model' => 'deepseek-chat',
            'messages' => [
                ['role' => 'system', 'content' => '
                你是一个SEO文案写手，请以 "${theme}" 为关键词撰写高质量的文章，对 ${sub_theme} 有独特见解，如有提供 product参数，可以少量加入product信息，否则不要加入product信息。
                正文字数控制在${word}字。并返回json格式
                EXAMPLE JSON OUTPUT:
{
    "title": "文章标题",
    "description": "内容概要",
    "content": "文章正文",
    "keywords": "关键词1,关键词2,关键词3"
}
                '],
                ['role' => 'user', 'content' => 'theme=除甲醛;sub_theme=甲醛危害;word=3000'],
            ],
            'stream' => false,
        ];


        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'json' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);
            if ($statusCode >= 200 && $statusCode < 300) {
                return $body;
            }

            return $body;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $url = 'https://dashscope.aliyuncs.com/api/v1/apps/3f90449a375b406aa29b9b066f2e0c0c/completion';
        $token = 'sk-6e1b39ce9b894f4791dc358f7ad8430e';

        $data = [
            'input' => [
                'prompt' => 'theme=除甲醛;sub_theme=甲醛危害;word=3000',
            ],
            'parameters' => [
                'name' => '',
            ],
            'debug' => [],
        ];

        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'json' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);
            $content = [];
            if ($statusCode >= 200 && $statusCode < 300) {
                if (isset($body['output']['text'])) {
                    $content = json_decode(str_replace('```', '', str_replace('```json', '', $body['output']['text'])));
                }
            }

            return $content->content;

            return response()->json($content->content, $statusCode);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return '';

        $categories = Category::where('parent_id', 3)->with('translation')->get();
        foreach ($categories as $category) {
            \Barryvdh\Debugbar\Facades\Debugbar::info($category->translation->name);
        }

        return 'ok';
        $lang = \Str::replace('_', '-', app()->getLocale());
        $graph = new Graph;
        $logo = Schema::imageObject()->url(config('app.url').'/asset/logo.png')
            ->identifier(config('app.url').'/#logo')
            ->caption('{网站描述}')
            ->width(500)
            ->height(200)
            ->inLanguage($lang);

        $graph->organization()->identifier(config('app.url').'/#organization')->name('{公司名称}')->logo($logo);
        $graph->webSite()
            ->identifier(config('app.url').'/#website')
            ->url(config('app.url').'/')
            ->name('{网站名称}')
            ->publisher(['@id' => $graph->organization()->getProperty('identifier')])
            ->inLanguage($lang);
        $graph->imageObject()->identifier('{cover.jpg}')->url('{cover.jpg}')->width(1000)->height(800)->caption('{文章标题}')->inLanguage($lang);
        $graph->breadcrumbList()->identifier(\URL::current().'#breadcrumb')->itemListElement([
            Schema::listItem()->position(1)->item((new Thing)->identifier(config('app.url'))->name('Home')),
            Schema::listItem()->position(2)->item((new Thing)->identifier(config('app.url').'/{目录名称}')->name('{目录}')),
            Schema::listItem()->position(3)->item((new Thing)->identifier(\URL::current())->name('{文章标题}')),
        ]);
        $graph->person()->identifier(\URL::current().'#author')->name('{作者名称、公司名称}')->image(
            Schema::imageObject()
                ->identifier('https://avatars.githubusercontent.com/u/3113752?v=4')
                ->url('https://avatars.githubusercontent.com/u/3113752?v=4')
                ->caption('{作者名称、公司名称}')
                ->inLanguage($lang)
        )->sameAs($graph->webSite()->getProperty('url'))
            ->worksFor($graph->organization()->getProperty('name'));
        // 详情页，非列表页
        $graph->itemPage()->identifier(\URL::current().'#webpage')
            ->url(\URL::current())
            ->name('{ 文章标题}')
            ->datePublished(Carbon::now()->toIso8601String())
            ->dateModified(Carbon::now()->toIso8601String())
            ->author(['@id' => $graph->person()->getProperty('identifier')])
            ->isPartOf($graph->webSite()->getProperty('identifier'))
            ->primaryImageOfPage(['@id' => $graph->imageObject()->getProperty('identifier')])
            ->inLanguage($lang)
            ->breadcrumb(['@id' => \URL::current().'#breadcrumb']);
        // 产品类相关
        $graph->product()->identifier(\URL::current().'#product')
            ->name('{产品名称}')
            ->description('{产品描述}')
            // ->sku(['s','m','l'])
            ->category('{产品分类}')
            ->mainEntityOfPage(['@id' => $graph->itemPage()->getProperty('identifier')])
            ->offers(Schema::offer()
                ->price('{价格}')
                ->priceCurrency('CNY')
                ->availability('https://schema.org/InStock')
                ->url(\URL::current())
                ->seller(Schema::organization()->name('{公司名称}')->url($graph->webSite()->getProperty('url'))->logo($logo->getProperty('url'))))
            // ->color(['black', 'blue'])
            ->identifier(\URL::current())
            ->image('/product/123.webp');
        // ->image(['@id' => $graph->imageObject()->getProperty('identifier')]);

        return $graph;

        // return \Route::current()->parameter('locale');
        return localized_url('news/123.html');

        return route('home', $request->route('locale').'/?id=2');

        return $request->route('locale').' index';
    }

    public function createCategoryTranslationsFactory()
    {
        $categories = Category::where('parent_id', 3)->with('translation')->get();
        foreach ($categories as $category) {
            foreach (config('project.supported_locales') as $locale) {
                $category->translations()->createMany([
                    [
                        'name' => $category->name,
                        'keywords' => $category->keywords,
                        'description' => $category->description,
                        'locale' => $locale['lang'],
                    ],
                ]);
            }
            \Barryvdh\Debugbar\Facades\Debugbar::info($category->translation->keywords);
        }
    }

    public function news(Request $request)
    {
        return app()->getLocale().' news';
    }

    public function newsDetail(Request $request)
    {
        return app()->getLocale().' newsDetail';
    }

    public function editor(Request $request)
    {
        return view('editor');
    }
}
