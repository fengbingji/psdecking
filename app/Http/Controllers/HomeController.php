<?php

namespace App\Http\Controllers;

use App\Enums\ContentType;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // return $request->get('locale');
        $banners = [];
        $categories = Category::where('content_type', ContentType::Product)
            ->where('parent_id', 3)
            ->with('translation')
            ->get();
        $blocks = $news = [];
        $cert['images'] = [];

        return view('index', compact('banners', 'categories', 'blocks', 'news', 'cert'));
    }

    public function createCategoryTranslationsFactory()
    {
        $categories = Category::where('parent_id', 3)->with('translation')->get();
        foreach ($categories as $category) {
            foreach (config('project.supported_locales') as $locale) {
                $category->translations()->createMany([
                    [
                        'name' => $category->name,
                        'keywords' => $category->keywords,
                        'description' => $category->description,
                        'locale' => $locale['lang'],
                    ],
                ]);
            }
            \Barryvdh\Debugbar\Facades\Debugbar::info($category->translation->keywords);
        }
    }

    public function news(Request $request)
    {

        return (new JsonLd)->generateBlogListGraph('新闻中心', 'cover.wbep');

        return app()->getLocale().' news';
    }

    public function newsDetail(Request $request)
    {

        return (new JsonLd)->generateBlogGraph('blog 标题', \Date::make('2022-12-12 08:12:11'), now(), 'keywords', 'description', 'blog-cover.webp');

        return app()->getLocale().' newsDetail';
    }

    public function editor(Request $request)
    {
        return view('editor');
    }

    public function demo()
    {

        return config('setting.en.site_name');
        $client = new \GuzzleHttp\Client([
            'verify' => 'D:\laragon\etc\ssl\cacert.pem',
        ]);
        $url = 'https://api.deepseek.com/chat/completions';
        $token = 'sk-a4119f2524db450cafada8b022a615bb';
        $data = [
            'model' => 'deepseek-chat',
            'messages' => [
                ['role' => 'system', 'content' => '
                你是一个SEO文案写手，请以 "${theme}" 为关键词撰写高质量的文章，对 ${sub_theme} 有独特见解，如有提供 product参数，可以少量加入product信息，否则不要加入product信息。
                正文字数控制在${word}字。并返回json格式
                EXAMPLE JSON OUTPUT:
{
    "title": "文章标题",
    "description": "内容概要",
    "content": "文章正文",
    "keywords": "关键词1,关键词2,关键词3"
}
                '],
                ['role' => 'user', 'content' => 'theme=除甲醛;sub_theme=甲醛危害;word=3000'],
            ],
            'stream' => false,
        ];

        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'json' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);
            if ($statusCode >= 200 && $statusCode < 300) {
                return $body;
            }

            return $body;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        $url = 'https://dashscope.aliyuncs.com/api/v1/apps/3f90449a375b406aa29b9b066f2e0c0c/completion';
        $token = 'sk-6e1b39ce9b894f4791dc358f7ad8430e';

        $data = [
            'input' => [
                'prompt' => 'theme=除甲醛;sub_theme=甲醛危害;word=3000',
            ],
            'parameters' => [
                'name' => '',
            ],
            'debug' => [],
        ];

        try {
            $response = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
                'json' => $data,
            ]);

            $statusCode = $response->getStatusCode();
            $body = json_decode($response->getBody(), true);
            $content = [];
            if ($statusCode >= 200 && $statusCode < 300) {
                if (isset($body['output']['text'])) {
                    $content = json_decode(str_replace('```', '', str_replace('```json', '', $body['output']['text'])));
                }
            }

            return $content->content;

            return response()->json($content->content, $statusCode);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return '';

        $categories = Category::where('parent_id', 3)->with('translation')->get();
        foreach ($categories as $category) {
            \Barryvdh\Debugbar\Facades\Debugbar::info($category->translation->name);
        }

        return 'ok';
    }
}
