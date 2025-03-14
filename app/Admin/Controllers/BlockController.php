<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Block;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Validation\Rule;

class BlockController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Block, function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('slug');
            $grid->column('title');
            $grid->column('remark')->display(function ($value) {
                return $value.'_'.$this->locale;
            });

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            })->model()->orderBy('slug')->orderBy('locale');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Block, function (Form $form) {
            $form->hidden('id');
            $form->text('slug')
                ->required()
                ->creationRules(['required', Rule::unique('blocks', 'slug')->where(function ($query) use ($form) {
                    $query->where('locale', $form->input('locale'));
                })])
                ->updateRules(['required', Rule::unique('blocks', 'slug')->where(function ($query) use ($form) {
                    $query->where('locale', $form->input('locale'));
                })->ignore($form->getKey())])
                ->help('同一个语种下,不能重复');
            $form->text('title');
            $form->editor('content');
            $form->text('remark');
            $form->radio('locale', '语言')
                ->options(array_column(config('project.supported_locales'), 'name', 'lang'))
                ->default(config('project.supported_locales')[config('project.default_locale')]['lang'])
                ->required();
        });
    }
}
