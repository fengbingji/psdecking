<?php

use App\Http\Controllers\HomeController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;


// 英文路由重定向 (移除 /en/ 前缀) - 放在最前面，优先处理
Route::group(['prefix' => 'en'], function () {
    Route::redirect('/{any?}', '/{any?}')->where('any', '.*')->name('en.redirect'); // 重定向所有 /en/ 开头的路由
});

Route::middleware(SetLocale::class)->group(function () {
    defineWebsiteRoutes();
});

Route::group(['prefix' => '{locale?}',
    'middleware' => SetLocale::class,
    'where' => ['locale' => implode('|', array_keys(config('project.supported_locales')))],
], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    defineWebsiteRoutes();
});

/**
 * 定义网站前端路由
 */
function defineWebsiteRoutes(): void
{
    //    Route::get('case', [HomeController::class, 'case'])->name('case');
    //    Route::any('contact', [HomeController::class, 'contact'])->name('contact');
    //    Route::get('page/{alias}', [HomeController::class, 'page'])->name('page.alias');
    //    Route::get('news', [NewsController::class, 'index'])->name('news');
    //    Route::get('news/{id}.html', [NewsController::class, 'show'])->name('news.show');
    //    Route::get('faq', [NewsController::class, 'faq'])->name('faq');
}
