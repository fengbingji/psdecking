<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $title 标题
 * @property array<array-key, mixed>|null $tags 标签
 * @property array<array-key, mixed>|null $images 图册
 * @property string|null $description 描述
 * @property string|null $locale 语言:简体=zh_CN繁体=zh_HK;英文=en
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Gallery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Gallery extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'gallery';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'images' => 'json',
        'tags' => 'json',
    ];

    protected $guarded = [];
}
