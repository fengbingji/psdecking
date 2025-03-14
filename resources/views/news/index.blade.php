@extends('app', ['site_title' => __('News')])
@section('content')
  <x-header></x-header>
  <section class="relative mb-12 h-80 bg-cover bg-bottom" style="background-image: url(/images/bg-news-cover.jpg)">
    <div class="absolute inset-0 flex flex-col items-center justify-center bg-brown/60">
      <h1 class="mb-3 text-center text-3xl text-white">{{ __('News') }}</h1>
    </div>
    <div class="absolute inset-x-0 bottom-0 bg-black/50 text-gray-100">
      <div class="container mx-auto py-4">
        <a href="/{{ $lang }}/">{{ __('Home') }}</a>
        <span class="font-icon mx-1 font-bold">&#xe840;</span>
        {{ __('News') }}
      </div>
    </div>
  </section>

  <section class="container mx-auto">
    <div class="flex flex-col">
      @foreach ($articles as $article)
        <div class="group mb-5 flex items-start py-4 duration-150 hover:bg-brown/80">
          <div class="ml-3 flex flex-col border bg-white p-2 text-center leading-8">
            <span class="text-2xl">{{ \Carbon\Carbon::make($article['created_at'])->format('m/d') }}</span>
            <span>{{ \Carbon\Carbon::make($article['created_at'])->format('Y') }}</span>
          </div>

          <div class="ml-2 flex-1">
            <a class="text-xl text-brown group-hover:text-white" href="/{{ $lang }}/news/{{ $article['id'] }}.html">{{ $article['title'] }}</a>
            <p class="group-hover:text-gray-200">{{ $article['description'] }}</p>
          </div>

          <a class="font-icon flex h-20 w-20 items-center justify-center text-5xl text-white hover:text-white" href="/{{ $lang }}/news/{{ $article['id'] }}.html">
            &#xe840;
          </a>

        </div>
      @endforeach
    </div>
    <div class="my-6">{{ $articles->links() }}</div>
  </section>
@endsection
