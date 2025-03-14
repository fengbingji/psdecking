<?php

namespace App\Admin\Repositories;

use App\Models\Article as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Tag extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public static function syncTags($tags): void
    {
        foreach ($tags as $tag) {
            if ($tag) {
                Model::class::firstOrCreate(['name' => $tag, 'slug' => \Str::slug($tag) ?: $tag]);
            }
        }
    }
}
