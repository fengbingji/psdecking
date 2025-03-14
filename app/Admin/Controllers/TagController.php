<?php

namespace App\Admin\Controllers;

use App\Models\Tag;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class TagController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Tag, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('slug');
            $grid->column('title')->limit(80);
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            })->model()->orderByDesc('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Tag, function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('slug')
                ->required()
                ->creationRules(['required', 'unique:tags,slug'])
                ->updateRules(['required', 'unique:tags,slug,'.$form->getKey()]);
            $form->editor('summary');
            $form->text('title');
            $form->textarea('description')->rows(3);

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
