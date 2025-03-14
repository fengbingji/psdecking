<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Carousel;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class CarouselController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Carousel(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('group');
            $grid->column('url');
            $grid->column('title');
            $grid->column('lang');
            $grid->column('order')->orderable();
            $grid->column('updated_at')->sortable();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            })
                ->model()
                ->orderBy('group')
                ->orderBy('order');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Carousel(), function (Form $form) {
            $form->display('id');
            $form->select('group')->options(['home' => 'home'])->required()->default('home');
            $form->text('url');
            $form->image('image')->required()
                ->uniqueName()
                ->move('carousel')
                ->autoUpload()
                ->scaleDown(1920, 800)
                ->toWebp(90);
            $form->text('title');
            $form->textarea('description');
            $form->embeds('extends', '扩展', function ($form) {
                $form->radio('effect', '动画效果')->options(['bounceInLeft' => '左到右', 'bounceInRight' => '右到左'])->default('bounceInLeft');
                $form->text('icon');
                $form->list('advantages', '优势');
            });
            $form->radio('lang')->options(['zh' => '中文', 'en' => 'English'])->default('zh');
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
