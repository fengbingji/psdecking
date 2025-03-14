<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * 
 *
 * @property int $id
 * @property string|null $group 分组
 * @property string|null $url url
 * @property string|null $image 图片
 * @property string|null $title 标题
 * @property string|null $description 摘要
 * @property array<array-key, mixed>|null $extends 扩展
 * @property string|null $lang 语种
 * @property int|null $order 排序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel ordered(string $direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereExtends($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereLang($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Carousel withoutTrashed()
 * @mixin \Eloquent
 */
class Carousel extends Model implements Sortable
{
    use SoftDeletes;
    use SortableTrait;

    protected $casts = [
        'extends' => 'json',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $sortable = [
        // 设置排序字段名称
        'order_column_name' => 'order',
        // 是否在创建时自动排序，此参数建议设置为true
        'sort_when_creating' => true,
    ];
}
