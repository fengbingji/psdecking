@extends('app')

@section('content')
  <x-header :index="1"></x-header>

  <section class="w-full">
    <div class="swiper" id="sec-banner">
      <div class="swiper-wrapper">
        @foreach ($banners as $banner)
          <div class="swiper-slide relative z-0 !h-96 sm:!h-auto">
            <img class="h-full object-cover md:w-full" src="/storage/{{ $banner['image'] }}" alt="{{ $banner['title'] }}" />
            <div class="container absolute inset-x-0 top-1/2 mx-auto h-80 -translate-y-1/2">
              <div class="ani {{ $banner['extends']['effect'] == 'bounceInLeft' ? 'left-0' : 'right-0' }} absolute flex h-80 overflow-visible bg-black/70 p-6 sm:max-w-[42rem]" swiper-animate-effect="{{ $banner['extends']['effect'] }}"
                swiper-animate-delay="0.1s">
                <span class="mr-4 hidden ff !text-5xl font-bold text-brown sm:block">{{ $banner['extends']['icon'] }}</span>
                <div class="flex-1">
                  <h2 class="relative border-b border-amber-950/60 pb-2 text-xl sm:text-2xl text-white">
                    {{ $banner['title'] }}
                    <span class="absolute bottom-0 left-0 h-0.5 w-10 bg-brown"></span>
                  </h2>
                  <div class="whitespace-pre-wrap py-4 sm:leading-8 text-gray-400/80">{{ $banner['description'] }}</div>
                  <div class="grid grid-cols-2 gap-y-2 text-brown">
                    @foreach ($banner['extends']['advantages'] as $adv)
                      <p><span class="font-icon">&#xe691;</span> {{ $adv }}</p>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </section>

  <section class="container mx-auto py-10">
    <h2 class="relative mb-8 py-4 text-center text-3xl text-gray-800">
      {{ __('OUR PRODUCTS') }}
      <span class="absolute bottom-0 left-1/2 h-0.5 w-16 -translate-x-1/2 bg-brown"></span>
    </h2>
    <div class="flex flex-col sm:grid sm:grid-cols-3 sm:gap-4">
      @foreach ($categories as $category)
        <a class="block rounded border border-gray-100 duration-200 hover:shadow-xl" href="/{{ $lang }}/pro-{{ $category['slug'] }}">
          <div class="overflow-hidden">
            @if ($category['images'])
              <img class="h-60 w-full object-cover duration-75 hover:scale-110" src="/storage/{{ $category['images'][0] }}" alt="{{ $category['name'] }}" />
            @endif
          </div>
          <div class="px-6 py-4">
            <h3 class="mb-2 text-xl text-gray-800">{{ $category['name'] }}</h3>
            <p class="line-clamp-3 leading-7 text-gray-400">{{ $category['description'] }}</p>
          </div>
        </a>
      @endforeach
    </div>
    <div class="my-16 text-center">
      <a class="inline-block border border-brown px-5 py-3 text-lg font-bold text-brown duration-200 hover:border-white hover:bg-brown hover:text-white" href="/{{ $lang }}/pro-all">
        {{ __('VIEW ALL PRODUCTS') }}
      </a>
    </div>
  </section>

  <section class="flex h-52 items-center bg-cover bg-center" style="background-image: url(/images/composite-decking-vs-wood-decking.jpg)">
    <div class="container m-auto text-4xl font-bold text-gray-100">
      <a class="block hover:text-white" href="/{{ $lang }}/page/composites-decking-vs-wood">
        <h3 class="w-1/2 text-center">Composite Decking</h3>
        <div class="text-center text-green-600">VS</div>
        <h3 class="ml-auto w-1/2 text-center">Wood Decking</h3>
      </a>
    </div>
  </section>

  <section class="bg-gray-50">
    <div class="container mx-auto py-10">
      <h2 class="relative mb-8 py-4 text-3xl text-gray-800">
        {{ __('ABOUT Praysun') }}
        <span class="absolute bottom-0 left-0 h-0.5 w-16 bg-brown"></span>
      </h2>
      <div class="flex flex-col md:flex-row">
        <div class="mb-4 leading-7 md:mr-4">
          <h3 class="mb-5 text-2xl text-gray-800">{{ $blocks['home-about-us']['title'] ?? 'no title' }}</h3>
          {!! $blocks['home-about-us']['content'] ?? 'no content' !!}
        </div>
        <div class="border border-gray-200 bg-white p-2">
          <div class="group relative flex">
            {!! $blocks['home-video']['content'] ?? 'no home video' !!}
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="bg-white">
    <div class="container mx-auto py-10 md:flex">
      <div class="sec-testimonials mb-10 md:w-1/2 md:pr-8">
        <h2 class="relative mb-6 flex justify-between py-2 text-3xl text-gray-800">
          {{ __('TESTIMONIALS') }}
          <div class="flex space-x-2">
            <span class="swiper-button-prev3 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-2 border-gray-100 font-icon !text-2xl text-brown hover:border-brown">&#xe83e;</span>
            <span class="swiper-button-next3 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-2 border-gray-100 font-icon !text-2xl text-brown hover:border-brown">&#xe840;</span>
          </div>
          <span class="absolute bottom-0 left-0 h-0.5 w-16 bg-brown"></span>
        </h2>
        <div class="swiper">
          <div class="swiper-wrapper">
            {!! $blocks['home-testimonials']['content'] ?? 'no home testimonials' !!}
          </div>
        </div>
      </div>
      <div class="md:w-1/2">
        <h2 class="relative mb-6 flex justify-between py-2 text-3xl text-gray-800">
          {{ __('LATEST NEWS') }}
          <span class="absolute bottom-0 left-0 h-0.5 w-16 bg-brown"></span>
        </h2>
        <div>
          @foreach ($news as $item)
            <div class="group mb-2 flex">
              <a class="mr-2 h-32 w-32 flex-shrink-0" href="/{{ $lang }}/news/{{ $item['id'] }}.html">
                <img class="h-full w-full rounded object-cover duration-200 group-hover:opacity-60" src="/storage/{{ $item['cover'] }}" alt="{{ $item['title'] }}" />
              </a>
              <div>
                <h3 class="mb-2 line-clamp-2 text-lg font-bold text-gray-800">
                  <a href="/{{ $lang }}/news/{{ $item['id'] }}.html">{{ $item['title'] }}</a>
                </h3>
                <p class="line-clamp-2">{{ $item['description'] }}</p>
                <div class="text-right text-gray-300">
                  <span class="font-icon">&#xe854;</span>
                  {{ \Carbon\Carbon::make($item['created_at'])->format('Y-m-d') }}
                </div>
              </div>
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </section>

  <section class="sec-info bg-gray-50">
    <div class="container mx-auto py-10">
      <h2 class="relative mb-6 flex justify-between py-2 text-3xl text-gray-800">
        {{ __('ENTERPRISE CERTIFICATION') }}
        <div class="flex space-x-2">
          <span class="swiper-button-prev2 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-2 border-gray-100 font-icon !text-2xl text-brown hover:border-brown">&#xe83e;</span>
          <span class="swiper-button-next2 flex h-12 w-12 cursor-pointer items-center justify-center rounded-full border-2 border-gray-100 font-icon !text-2xl text-brown hover:border-brown">&#xe840;</span>
        </div>
        <span class="absolute bottom-0 left-0 h-0.5 w-16 bg-brown"></span>
      </h2>
      <div class="swiper">
        <div class="swiper-wrapper">
          @foreach ($cert['images'] as $image)
            <div class="swiper-slide border">
              <img data-fancybox="cert" src="/storage/{{ $image }}" alt="{{ $cert['title'] }}" />
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </section>
@endsection

@push('css')
  <link href="/script/swiper/swiper-bundle.min.css" rel="stylesheet" />
  <style>

  </style>
@endpush

@push('footer-script')
  <script src="/script/swiper/swiper.animate1.0.3.min.js"></script>
  <script></script>
@endpush
