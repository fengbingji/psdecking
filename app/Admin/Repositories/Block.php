<?php

namespace App\Admin\Repositories;

use App\Models\Block as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Block extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
