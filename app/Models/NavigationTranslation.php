<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $navigation_id
 * @property string $locale
 * @property string $name
 * @property-read \App\Models\Navigation|null $navigation
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NavigationTranslation whereNavigationId($value)
 * @mixin \Eloquent
 */
class NavigationTranslation extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function navigation(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Navigation::class);
    }
}
