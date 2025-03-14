<?php

use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;

/**
 * Dcat-admin - admin builder based on Laravel.
 *
 * @author jqh <https://github.com/jqhph>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 *
 * extend custom field:
 * Dcat\Admin\Form::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Column::extend('php', PHPEditor::class);
 * Dcat\Admin\Grid\Filter::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 */
// app('view')->prependNamespace('admin', resource_path('views/admin'));

Grid::resolving(function (Grid $grid) {
    $grid->actions(function (Grid\Displayers\Actions $actions) {
        $actions->disableView();
        // $actions->disableDelete();
    });
});

Form::resolving(function (Form $form) {
    $form->tools(function (Form\Tools $tools) {
        $tools->disableView();
    });
    $form->disableViewCheck();
    $form->disableDeleteButton();
});

Form\Field\Editor::resolving(function (Form\Field\Editor $editor) {
    $editor->options([
        'extended_valid_elements' => 'svg[*],path[*]',
        // 'content_css' => Vite::asset('resources/css/app.css'),
    ]);
});
