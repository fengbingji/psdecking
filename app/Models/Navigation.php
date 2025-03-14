<?php

namespace App\Models;

use Dcat\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;

/**
 * 
 *
 * @property int $id
 * @property int|null $order 排序
 * @property string|null $name 名称
 * @property int|null $parent_id 所属父节点
 * @property string|null $url 跳转的地址
 * @property int|null $show 是否显示
 * @property string|null $binding_type 绑定类型:cate,news-detail,product-detail,page-detail
 * @property int|null $binding_id 绑定对象的id
 * @property-read \App\Models\NavigationTranslation $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NavigationTranslation> $translations
 * @property-read int|null $translations_count
 * @method static Builder<static>|Navigation newModelQuery()
 * @method static Builder<static>|Navigation newQuery()
 * @method static Builder<static>|Navigation ordered(string $direction = 'asc')
 * @method static Builder<static>|Navigation query()
 * @method static Builder<static>|Navigation whereBindingId($value)
 * @method static Builder<static>|Navigation whereBindingType($value)
 * @method static Builder<static>|Navigation whereId($value)
 * @method static Builder<static>|Navigation whereName($value)
 * @method static Builder<static>|Navigation whereOrder($value)
 * @method static Builder<static>|Navigation whereParentId($value)
 * @method static Builder<static>|Navigation whereShow($value)
 * @method static Builder<static>|Navigation whereUrl($value)
 * @mixin \Eloquent
 */
class Navigation extends Model implements Sortable
{
    use ModelTree;

    protected $guarded = [];
    public $titleColumn = 'name';
    public $timestamps = false;

    public function translations(): \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(NavigationTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(NavigationTranslation::class)->ofMany([], function (Builder $query) {
            $query->where('locale', app()->getLocale());
        })->withDefault(function (NavigationTranslation $translation, Category $category) {
            $translation->name = $category->name;
            $translation->keywords = $category->keywords;
            $translation->description = $category->description;
        });
    }
}
