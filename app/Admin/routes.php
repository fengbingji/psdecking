<?php

use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    // $router->resource('{cate_id}/page', 'PageController')->where(['cate_id' => '[0-9]+']);
    // $router->resource('page', '\App\Admin\Controllers\PageController');
    // $router->resource('{p_cate_id}/article', 'ArticleController')->where(['p_cate_id' => '[0-9]+']);
    $router->resource('article', '\App\Admin\Controllers\ArticleController')->except(['show']);
    $router->resource('feedback', 'FeedbackController')->except(['show']);
    $router->resource('product', 'ProductController')->except(['show']);
    $router->resource('category', 'CategoryController')->except(['show']);
    $router->resource('navigation', 'NavigationController')->except(['show']);
    $router->resource('setting', 'SettingController')->except(['show']);
    $router->put('setting/{any}', 'SettingController@update');
    $router->resource('tag', 'TagController')->except(['show']);
    $router->resource('block', 'BlockController')->except(['show']);
    $router->resource('tag', 'TagController')->except(['show']);
    $router->resource('project', 'ProjectController')->except(['show']);
    $router->resource('gallery', 'GalleryController')->except(['show']);
    $router->resource('carousel', 'CarouselController')->except(['show']);

});
