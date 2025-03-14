<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Article
 *
 * @property int $id
 * @property string|null $title 文章标题
 * @property string|null $short_title 短标题
 * @property int|null $category_id 目录id
 * @property string|null $cover 封面
 * @property string|null $description 描述
 * @property string|null $keywords
 * @property array<array-key, mixed>|null $tags 标签
 * @property string|null $author 作者
 * @property int $flags 文章标识:0=普通;1=推荐;
 * @property int $published 文章属性:0=>未发布;1=已发布
 * @property int $hits 点击量
 * @property string|null $content 正文
 * @property string|null $locale 语言:简体=zh_CN繁体=zh_HK;英文=en
 * @property int|null $editor_id 编辑者id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Category|null $category
 * @property-read mixed $cover_full
 * @property-read mixed $desc
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereEditorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereFlags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article wherePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereShortTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereTags($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Article withoutTrashed()
 * @mixin \Eloquent
 */
class Article extends Model
{
    use HasDateTimeFormatter;
    use SoftDeletes;

    protected $casts = [
        'tags' => 'array',
    ];

    protected $guarded = [];

    protected $appends = ['desc', 'cover_full'];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getDescAttribute()
    {
        $text = preg_replace('/\[.*?\]/', '', $this->content);
        $text = str_replace('&nbsp;', '', $text);
        // 先使用 strip_tags 过滤掉所有 HTML 标签
        $text = preg_replace("/[\r\n]+/", "\n", strip_tags($text));

        return trim($text);
    }

    public function getCoverFullAttribute()
    {
        $value = $this->cover;

        return \Str::startsWith($value, 'http') ? $value : config('filesystems.disks.local.url').'/'.$value;
    }
}
