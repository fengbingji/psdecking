<?php

namespace App\Admin\Controllers;

use App\Admin\Renderable\BlockTable;
use App\Admin\Repositories\Product;
use App\Admin\RowActions\Copy;
use App\Enums\ContentType;
use App\Models\Block;
use App\Models\Category;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class ProductController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Product('category'), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('category.name', '产品分类')->filter(Grid\Column\Filter\Equal::make()->valueFilter()->hide());
            $grid->column('locale', '语言')
                ->using(array_column(config('project.supported_locales'), 'name', 'lang'))
                ->filter(Grid\Column\Filter\In::make(array_column(config('project.supported_locales'), 'name', 'lang')));
            $grid->column('cover', '封面')->image('', 100);
            $grid->column('prop', '推荐')->switch();
            $grid->column('published', '发布')->switch();
            $grid->column('created_at');

            $grid->quickSearch(['id', 'name']);

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            })->model()->orderByDesc('id');

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(new Copy(\App\Models\Product::class));
            });

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Product, function (Form $form) {
            $form->display('id');
            $form->text('name');
            $form->select('category_id', trans('category'))->options(Category::selectOptions(function (Category $query) {
                return $query->where('content_type', ContentType::Product);
            }, rootText: '请选择'));
            $form->embeds('params', '产品参数', function ($form) {
                $form->text('dimensions', '尺寸');
                $form->text('length', '长度');
                $form->textarea('selling_point', '卖点')->placeholder('一行一个');
                $form->editor('price_desc', '报价说明');
            });

            $form->textarea('description', '简介')->rules('max:500')->rows(3);
            $form->text('keyword', '关键词')->placeholder('多个关键词用,分割');

            $form->multipleImage('images')
                ->move('product')
                ->uniqueName()
                ->removable()
                ->maxSize(1024 * 3)
                ->sortable()
                ->limit(20)
                ->autoUpload()
                ->help('2MB以内')
                ->scaleDown(1000)
                ->thumbnail('s', 300, 300)
                ->toWebp(80);
            $form->multipleSelectTable('blocks', '底部区块')
                ->title('底部区块')
                ->from(BlockTable::make())
                ->model(Block::class, 'slug', 'remark')
                ->help('区块是可以指定语种的,如果所在语种没有该区块,前端则自动选择一个语种显示,<a href="'.admin_url('block').'">点击此处</a>添加区块');

            $form->editor('content', '介绍')->height(500);
            $form->switch('prop', '推荐');
            $form->switch('published')->default(1);
            $form->radio('locale', '语言')
                ->options(array_column(config('project.supported_locales'), 'name', 'lang'))
                ->default(config('project.supported_locales')[config('project.default_locale')]['lang'])
                ->required();
            $form->display('created_at');
            $form->display('updated_at');

            if ($form->isEditing()) {
                $form->tools(function (Form\Tools $tools) use ($form) {
                    $tools->append('<div class="btn-group pull-right" style="margin-right: 5px">
    <a href="/pro-'.$form->model()->category?->slug.'/'.$form->model()->id.'.html" target="_blank" class="btn btn-sm btn-primary "><i class="feather icon-eye"></i><span class="d-none d-sm-inline">&nbsp;预览</span></a>
</div>');
                });
            }

        });
    }
}
