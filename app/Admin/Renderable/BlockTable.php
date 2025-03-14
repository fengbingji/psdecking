<?php

namespace App\Admin\Renderable;

use App\Admin\Repositories\Block;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;

class BlockTable extends LazyRenderable
{
    public function grid(): Grid
    {
        return Grid::make((new Block), function (Grid $grid) {
            // $grid->column('id');
            $grid->column('slug');
            $grid->column('title');
            // $grid->column('lang');
            $grid->column('remark');

            $grid->disablePagination();
            $grid->disableActions();

            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('username')->width(4);
                $filter->like('name')->width(4);
            })->model()->where('locale', config('project.default_locale'));
        });
    }
}
