<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Form;
use Dcat\Admin\Repositories\Repository;
use Illuminate\Support\Facades\Cache;

class Setting extends Repository
{
    public function edit(Form $form)
    {
        $settings = \App\Models\Setting::where('slug', 'setting')->first();
        if ($settings) {
            return $settings->value;
        }

        return [];
    }

    public function update(Form $form)
    {
        $locales = collect(config('project.supported_locales'))->keyBy('lang')->toArray();
        $fields = ['phone', 'email', 'whatsapp', 'instagram', 'facebook', 'twitter', 'youtube', 'linkedin', 'statistics'];
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

    public function updating(Form $form)
    {
        return [];
    }
}
