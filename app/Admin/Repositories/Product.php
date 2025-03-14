<?php

namespace App\Admin\Repositories;

use App\Models\Product as Model;
use Dcat\Admin\Form;
use Dcat\Admin\Repositories\EloquentRepository;

class Product extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function store(Form $form)
    {
        Tag::syncTags($form->input('tags'));

        return parent::store($form);
    }

    public function update(Form $form): ?bool
    {
        Tag::syncTags($form->input('tags'));

        return parent::update($form);
    }
}
