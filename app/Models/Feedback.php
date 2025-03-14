<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Feedback
 *
 * @property int $id
 * @property string|null $subject 反馈主题
 * @property string|null $feed_type 反馈类型
 * @property string|null $author 昵称
 * @property string|null $email 邮箱地址
 * @property string|null $phone 联系电话
 * @property array<array-key, mixed>|null $content 反馈内容
 * @property string|null $ip ip 地址
 * @property string|null $useragent 浏览器信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereFeedType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback whereUseragent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Feedback withoutTrashed()
 * @mixin \Eloquent
 */
class Feedback extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'content' => 'json',
    ];
}
