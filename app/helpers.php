<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

if (! function_exists('localized_url')) {
    /**
     * 生成本地化的 URL。
     *
     * @param  string  $path  URL 路径 (例如：'news/123.html')
     * @param  string|null  $locale  语言区域代码 (可选，为空则使用当前应用语言区域)
     * @return string 本地化后的 URL
     */
    function localized_url(string $path, ?string $locale = null): string
    {
        $locale = $locale ?: Route::current()->parameter('locale'); // 如果未提供语言区域，则使用当前应用语言区域

        if ($locale) { // 假设 'en' 是你的默认语言
            return URL::to('/'.$locale.'/'.ltrim($path, '/')); // 非默认语言添加语言区域前缀
        } else {
            return URL::to($path); // 默认语言不添加语言区域前缀
        }
    }
}
