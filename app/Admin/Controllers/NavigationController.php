<?php

namespace App\Admin\Controllers;

use App\Models\Navigation;
use App\Models\NavigationTranslation;
use Dcat\Admin\Form;
use Dcat\Admin\Http\Actions\Menu\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Tree;
use Dcat\Admin\Widgets\Box;
use Dcat\Admin\Widgets\Form as WidgetForm;

class NavigationController extends AdminController
{
    public array $locales;

    public function __construct()
    {
        $this->locales = collect(config('project.supported_locales'))->keyBy('lang')->toArray();
    }

    public function title()
    {
        return trans('网站导航');
    }


    public function index(Content $content): Content
    {
        return $content
            ->title($this->title())
            ->body(function (Row $row) {
                $row->column(7, $this->treeView()->render());

                $row->column(5, function (Column $column) {
                    $form = new WidgetForm;
                    $form->action(admin_url('navigation'));

                    $form->select('parent_id', trans('admin.parent_id'))->options(Navigation::selectOptions(rootText: '一级导航'));
                    $form->text('name', trans('名称'))->required();
                    $form->text('url', trans('url'));

                    $form->width(9, 2);

                    $column->append(Box::make(trans('admin.new'), $form));
                });
            });
    }

    protected function treeView(): Tree
    {

        return new Tree((new Navigation), function (Tree $tree) {
            $tree->disableCreateButton();
            $tree->disableQuickCreateButton();
            $tree->disableEditButton();
            $tree->maxDepth(3);

            $tree->actions(function (Tree\Actions $actions) {
                $actions->prepend(new Show);
            });

            $tree->branch(function ($branch) {
                $payload = "<strong>{$branch['name']}</strong>";

                if (! isset($branch['children'])) {
                    $url = $branch['url'];
                    $payload .= "&nbsp;&nbsp;&nbsp;<a href=\"$url\" class=\"dd-nodrag\" target='_blank'>$url</a>";
                }

                return $payload;
            });
        });
    }

    public function edit($id, Content $content)
    {

        return parent::edit($id, $content);
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(Navigation::with('translations'), function (Form $form) {
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });

            $form->tab('基础配置', function (Form $form) {
                $form->display('id', 'ID');

                $form->select('parent_id', trans('admin.parent_id'))->options(function () {
                    return Navigation::selectOptions();
                })->saving(function ($v) {
                    return (int) $v;
                });
                $form->text('name', trans('名称'))->required();
                $form->text('url');
                $form->switch('show', trans('admin.show'));
            });

            $form->tab('多语言配置', function (Form $form) {
                $form->hasMany('translations', '', function (Form\NestedForm $form) {
                    $form->text('name');
                    $form->radio('locale', '语言')
                        ->options(array_column(config('project.supported_locales'), 'name', 'lang'))
                        ->default(config('project.supported_locales')[config('project.default_locale')]['lang'])
                        ->required();
                });
            });
        })->saved(function (Form $form, $result) {
            if ($form->isCreating()) {
                $existingLocales = collect($form->model()->translations)->pluck('locale')->toArray();
                $locales = collect(config('project.supported_locales'))->keyBy('lang')->toArray();
                $navigation = Navigation::find($form->getKey());
                foreach ($locales as $locale => $details) {
                    if (! in_array($locale, $existingLocales)) {
                        $navigation->translations()->create([
                            'locale' => $locale,
                            'name' => $navigation->name,
                        ]);
                    }
                }
            }

            $response = $form->response()->location('navigation');

            if ($result) {
                return $response->success(__('admin.save_succeeded'));
            }

            return $response->info(__('admin.nothing_updated'));
        })->deleted(function (Form $form, $result) {
            if ($result) {
                foreach ($form->model()->toArray() as $navigation) {
                    NavigationTranslation::where('navigation_id', $navigation['id'])->delete();
                }

            }
        });
    }
}
