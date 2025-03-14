<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

// Route::any('editor', [HomeController::class, 'editor']);
// Route::get('{any?}/{any2?}/{any3?}', [HomeController::class, 'index']);
Route::get('demo',function (){
    return view('welcome');
});

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
    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('product/{id}.html', [ProductController::class, 'show'])->name('product.show');
    //    Route::get('news', [NewsController::class, 'index'])->name('news');
    Route::get('news', [HomeController::class, 'news'])->name('blog.index');
    //    Route::get('news/{id}.html', [NewsController::class, 'show'])->name('news.show');
    Route::get('news/{id}.html', [HomeController::class, 'newsDetail'])->name('blog.show');
    //    Route::get('faq', [NewsController::class, 'faq'])->name('faq');
}
