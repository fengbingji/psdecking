@extends('app', ['site_title' => $category['name']])
@section('content')
  <x-header></x-header>
  <section class="relative mb-12 h-80 bg-cover bg-center" style="background-image: url(/images/bg-product-1.jpg)">
    <div class="absolute inset-0 flex flex-col items-center justify-center bg-brown/60">
      <h1 class="mb-3 text-center text-3xl text-white">{{ $category['name'] }}</h1>
    </div>
    <div class="absolute inset-x-0 bottom-0 bg-black/50 text-gray-100">
      <div class="container mx-auto py-4">
        <a href="/{{ $lang }}/">{{ __('Home') }}</a>
        <span class="mx-1 font-icon font-bold">&#xe840;</span>
        {{ __($category['name']) }}
      </div>
    </div>
  </section>
  @foreach($blocks as $block)
    <section class="container mx-auto my-6 leading-7">
      {!! $block->content !!}
    </section>
  @endforeach
  <section class="container mx-auto">
    <div class="grid grid-cols-2 gap-7 md:grid-cols-3 lg:grid-cols-4">
      @foreach ($products as $product)
        <a class="block" href="/{{ $lang }}/pro-{{ $product['category']['slug'] }}/{{ $product['id'] }}.html">
          <div class="group relative overflow-hidden rounded duration-200 hover:drop-shadow-[0px_10px_15px_rgba(0,0,0,0.8)]">
            @if ($product->prop == 1)
              <span title="Recommended Boutiques" class="badge z-50 bg-brown font-icon text-lg text-white">&#xe620;</span>
            @endif
            <img class="block w-full object-cover duration-1000 group-hover:opacity-80" src="/storage/{{ $product['cover'] }}" alt="{{ $product['name'] }}">
            <div class="absolute inset-x-0 bottom-0 h-9 overflow-hidden bg-brown/80 p-2 text-white duration-200 group-hover:h-32 group-hover:text-white">
              <h2 class="line-clamp-1 text-base font-bold">{{ $product['name'] }}</h2>
              <p class="line-clamp-3 whitespace-pre-wrap leading-7 text-gray-300">{{ $product['description'] }}</p>
            </div>
          </div>
        </a>
      @endforeach
    </div>

    <div class="py-4">{{ $products->links() }}</div>
  </section>
@endsection
