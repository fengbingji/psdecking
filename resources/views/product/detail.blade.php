@extends('app', ['site_title' => $entity['name'], 'keyword' => $entity['keyword'], 'description' => $entity['description']])
@section('content')
  <x-header></x-header>

  <section class="container mx-auto mb-6">
    <div class="py-6"><a href="/{{ $lang }}/">{{ __('Home') }}</a> /
      <a href="/{{ $lang }}/pro-{{ $category['slug'] }}">{{ __($category['name']) }}</a> /
      {{ $entity['name'] }}
    </div>

    <div class="mb-6 flex flex-col md:flex-row">
      <div class="mb-4 md:w-1/2 md:pr-4">
        <div class="swiper border mb-3" id="swiper-p-detail-images">
          <div class="swiper-wrapper">
            @foreach ($entity['images'] as $image)
              <div class="swiper-slide !h-96 cursor-zoom-in">
                <a data-src="/storage/{{ $image }}" data-fancybox="gallery">
                  <img class="h-full w-full object-cover" src="/storage/{{ $image }}" alt="{{$entity['title']}}" loading="lazy" />
                  <div class="swiper-lazy-preloader"></div>
                </a>
              </div>
            @endforeach
          </div>
        </div>
        <div class="swiper" id="swiper-p-detail-thumb">
          <div class="swiper-wrapper">
            @foreach ($entity['images'] as $image)
              <div class="swiper-slide cursor-pointer border">
                <img src="/storage/{{ Str::replaceLast('.', '-s.', $image) }}" alt="{{$entity['title']}}" />
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="flex-1 leading-7 text-base">
        <h1 class="mb-4 text-xl">{{ $entity['name'] }}</h1>
        @if ($entity['params']['selling_point'])
          <ul class="mb-2">
            @foreach (explode("\n", $entity['params']['selling_point']) as $point)
              <li><span class="mr-1 font-icon text-brown">&#xe840;</span>{{ $point }}</li>
            @endforeach
          </ul>
        @endif
        @if ($entity['params']['dimensions'])
          <div>{{ __('Dimensions') }}: {{ $entity['params']['dimensions'] }}</div>
        @endif
        @if ($entity['params']['length'])
          <div>{{ __('Length') }}: {{ $entity['params']['length'] }}</div>
        @endif
        @if ($entity['params']['price_desc'])
          <div class="mt-3">{!! $entity['params']['price_desc'] !!}</div>
        @endif
      </div>
    </div>

    <div class="content mb-3 text-base">
      {!! $entity['content'] !!}
    </div>

    @foreach ($blocks as $block)
      <h2 class="relative mb-2 border-b py-2 text-lg font-bold after:absolute after:bottom-0 after:left-0 after:h-1 after:w-24 after:bg-brown after:content-['']">{{ $block->title }}</h2>
      <div class="mb-4">{!! $block->content !!}</div>
    @endforeach

  </section>
@endsection

@push('css')
  <style>

  </style>
@endpush

@push('footer-script')
  <script></script>
@endpush
