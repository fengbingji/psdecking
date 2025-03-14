<?php

namespace App\Models;

use App\Enums\ContentType;
use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property ContentType|null $content_type 分类类型
 * @property int $parent_id 父目录id
 * @property string|null $name 目录名称
 * @property string|null $slug 别名/segment
 * @property int $order 排序
 * @property array<array-key, mixed>|null $images 封面/图标
 * @property array<array-key, mixed>|null $blocks 区块
 * @property int|null $show 是否首页显示
 * @property string|null $remark 备注
 * @property string|null $locales 多语言信息
 * @property string|null $keywords 关键词
 * @property string|null $description 描述
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Article> $articles
 * @property-read int|null $articles_count
 * @property-read \App\Models\TFactory|null $use_factory
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Page> $pages
 * @property-read int|null $pages_count
 * @property-read Category|null $parent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @property-read \App\Models\CategoryTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\CategoryTranslation> $translations
 * @property-read int|null $translations_count
 * @method static Builder<static>|Category newModelQuery()
 * @method static Builder<static>|Category newQuery()
 * @method static Builder<static>|Category ordered(string $direction = 'asc')
 * @method static Builder<static>|Category query()
 * @method static Builder<static>|Category whereBlocks($value)
 * @method static Builder<static>|Category whereContentType($value)
 * @method static Builder<static>|Category whereCreatedAt($value)
 * @method static Builder<static>|Category whereDescription($value)
 * @method static Builder<static>|Category whereId($value)
 * @method static Builder<static>|Category whereImages($value)
 * @method static Builder<static>|Category whereKeywords($value)
 * @method static Builder<static>|Category whereLocales($value)
 * @method static Builder<static>|Category whereName($value)
 * @method static Builder<static>|Category whereOrder($value)
 * @method static Builder<static>|Category whereParentId($value)
 * @method static Builder<static>|Category whereRemark($value)
 * @method static Builder<static>|Category whereShow($value)
 * @method static Builder<static>|Category whereSlug($value)
 * @method static Builder<static>|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements Sortable
{
    use HasFactory;
    use ModelTree {
        allNodes as treeAllNodes;
        ModelTree::boot as treeBoot;
    }

    protected $guarded = [];

    protected $titleColumn = 'name';

    protected $casts = [
        'images' => 'json',
        'blocks' => 'json',
        'content_type' => ContentType::class,
    ];


    public function translations(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(CategoryTranslation::class)->ofMany([], function (Builder $query) {
            $query->where('locale', app()->getLocale());
        })->withDefault(function (CategoryTranslation $translation, Category $category) {
            $translation->name = $category->name;
            $translation->keywords = $category->keywords;
            $translation->description = $category->description;
        });
    }

    public function articles(): Builder|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'category_id');
    }

    public function pages(): Builder|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Page::class, 'category_id');
    }

    public function products(): Builder|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
