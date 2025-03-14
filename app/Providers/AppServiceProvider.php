<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 获取配置文件
        $settings = Cache::get('settings');
        if ($settings === null) {
            $settings = Setting::where('slug', 'setting')->firstOrNew();
            Cache::put('settings', $settings->value);
        }
        foreach ($settings as $key => $setting) {
            if (is_array($setting)) {
                foreach ($setting as $k => $value) {
                    config()->set("setting.{$key}.{$k}", $value);
                }
            } else {
                config()->set("setting.{$key}", $setting);
            }
        }
    }
}
