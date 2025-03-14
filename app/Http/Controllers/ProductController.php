<?php

namespace App\Http\Controllers;

use App\Services\JsonLd;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        return (new JsonLd)->generateProductListGraph();

        return app()->getLocale().' product';
    }

    public function show(Request $request)
    {
        return (new JsonLd)->generateProductGraph(
            title: 'blog 标题',
            categoryName: 'category name',
            categoryUrl: route('product'),
            datePublished: \Date::make('2022-12-12 08:12:11'),
            dateModified: \Date::make('2022-12-12 08:12:11'),
            cover: 'product-cover.webp',
            description: 'description',
            sku: ['x001', 'x002', 123],
            price: '100',
            // priceCurrency: 'CNY'
        );
            // ->toScript();

        return app()->getLocale().' show product';
    }
}
