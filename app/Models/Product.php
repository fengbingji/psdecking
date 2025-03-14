<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $name 产品名称
 * @property int|null $category_id 类别
 * @property string|null $slug url别名
 * @property string|null $locale 语言
 * @property int|null $sales_volume 销量
 * @property array<array-key, mixed>|null $images 相册
 * @property string|null $price 价格
 * @property string|null $content 介绍
 * @property array<array-key, mixed>|null $tags
 * @property string|null $title seo标题
 * @property string|null $keyword seo关键词
 * @property string|null $description 描述
 * @property array<array-key, mixed>|null $blocks 区块
 * @property array<array-key, mixed>|null $params 参数
 * @property int|null $prop 属性:0=常规;1=热推;...
 * @property int|null $published 是否发布
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $cover
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereBlocks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereKeyword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereParams($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereProp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSalesVolume($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Product withoutTrashed()
 * @mixin \Eloquent
 */
class Product extends Model
{
    use SoftDeletes;

    protected $casts = [
        'images' => 'json',
        'params' => 'json',
        'blocks' => 'json',
        'tags'=>'json',
        'created_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $guarded = [];

    protected $appends = [
        'cover',
    ];

    public function cover(): Attribute
    {
        return Attribute::make(
            get: fn () => (is_array($this->images) && count($this->images) > 0) ? \Str::replaceLast('.', '-s.', $this->images[0]) : null,
        );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
