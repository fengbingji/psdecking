<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $category_id
 * @property string $locale
 * @property string $name
 * @property string|null $description
 * @property string|null $keywords
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|CategoryTranslation whereName($value)
 * @mixin \Eloquent
 */
class CategoryTranslation extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
