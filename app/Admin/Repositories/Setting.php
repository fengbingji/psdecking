<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Form;
use Dcat\Admin\Form\Field\UploadField;
use Dcat\Admin\Repositories\Repository;
use Illuminate\Support\Facades\Cache;

class Setting extends Repository
{
    use UploadField;

    public function edit(Form $form)
    {
        $settings = \App\Models\Setting::where('slug', 'setting')->first();
        if ($settings) {
            return $settings->value;
        }

        return [];
    }

    public function update(Form $form): true
    {
        /**
         * 更新logo
         */
        if ($form->input('_id') && $form->input('logo')) {
            \App\Models\Setting::where('slug', 'setting')->update(['value->logo' => $form->input('logo')]);
            $settings = Cache::get('settings');
            $settings['logo'] = $form->input('logo');
            Cache::put('settings', $settings);
            return true;
        }
        /**
         * 删除logo
         */
        if ($form->input('_file_del_')) {
            $this->getStorage()->delete($form->input('_file_del_'));
            $settings = Cache::get('settings');
            $settings['logo'] = '';
            Cache::put('settings', $settings);
            \App\Models\Setting::where('slug', 'setting')->update(['value->logo' => '']);
            return true;
        }

        /**
         * 更新全量字段
         */
        $locales = collect(config('project.supported_locales'))->keyBy('lang')->toArray();
        $fields = ['phone', 'email', 'whatsapp', 'instagram', 'facebook', 'twitter', 'youtube', 'linkedin', 'statistics', 'logo'];
        $settings = [];
        foreach ($fields as $field) {
            $settings[$field] = $form->input($field);
        }
        foreach ($locales as $lang => $locale) {
            $fields = ['site_name', 'seo_title', 'seo_keywords', 'seo_description', 'contact_person'];
            foreach ($fields as $field) {
                $settings[$lang][$field] = $form->input($lang)[$field];
            }
        }
        Cache::put('settings', $settings);
        \App\Models\Setting::where('slug', 'setting')->update(['value' => $settings]);

        return true;
    }

    public function updating(Form $form): array
    {
        return [];
    }
}
