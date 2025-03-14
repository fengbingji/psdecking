<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Setting;
use Dcat\Admin\Form;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Illuminate\Http\UploadedFile;

class SettingController extends AdminController
{
    public array $locales;

    public function __construct()
    {
        $this->locales = collect(config('project.supported_locales'))->keyBy('lang')->toArray();
    }

    public function title()
    {
        return trans('网站设置');
    }

    public function index(Content $content): Content
    {
        return $content
            ->translation($this->translation())
            ->title($this->title())
            ->description($this->description()['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit(0));
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    public function form()
    {
        return Form::make(new Setting, function (Form $form) {
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();
            });

            $form->tab(trans('基础信息'), function (Form $form) {
                $form->image('logo', trans('logo'))->autoUpload()->name(fn () => 'logo-'.\Str::substr(time(), -5).'.webp')->toWebp();
                $fields = ['phone', 'email', 'whatsapp', 'instagram', 'facebook', 'twitter', 'youtube', 'linkedin'];
                foreach ($fields as $field) {
                    $form->text($field)->append('<span class="input-group-prepend"><span class="input-group-text bg-white">setting.'.$field.'</span></span>');
                }
                $form->textarea('statistics', trans('统计代码'))->help("可放入统计代码，客服代码等<br />setting.{$field}");
                $form->hidden('_method')->value('POST');
            });

            foreach ($this->locales as $lang => $locale) {
                $form->tab(trans($locale['name']), function (Form $form) use ($lang) {
                    $fields = ['site_name', 'seo_title', 'seo_keywords'];
                    foreach ($fields as $field) {
                        $form->text($lang.'.'.$field)->append('<span class="input-group-prepend"><span class="input-group-text bg-white">setting.'.$lang.'.'.$field.'</span></span>');
                    }
                    $form->textarea("{$lang}.seo_description")->help("setting.{$lang}.seo_description");
                    $form->text("{$lang}.contact_person")->append('<span class="input-group-prepend"><span class="input-group-text bg-white">setting.'.$lang.'.contact_person</span></span>');
                });
            }
        })
            ->disableHeader()
            ->disableEditingCheck()
            ->disableListButton()
            ->action('setting/0');
    }
}
