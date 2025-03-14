<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string|null $slug 标识
 * @property string|null $title 标题
 * @property string|null $content 内容
 * @property string|null $remark 说明
 * @property string|null $locale 语种
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Block whereTitle($value)
 * @mixin \Eloquent
 */
class Block extends Model
{
    use HasDateTimeFormatter;

    public $timestamps = false;
}
