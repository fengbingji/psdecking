@extends('app', ['site_title' => $entity['title']])
@section('content')
  <x-header></x-header>
  <section class="container mx-auto">
    <div class="py-6"><a href="/{{ $lang }}/">{{ __('Home') }}</a> / <a href="/{{ $lang }}/news">{{ __('News') }}</a>
    </div>

    <div class="mb-8 flex flex-col md:flex-row">
      <div class="content md:flex-1 mb-6">
        <h1 class="mb-6 text-center text-lg md:text-2xl">{{ $entity['title'] }}</h1>
        {!! $entity['content'] !!}
      </div>
      <div class="md:ml-2 md:w-1/4 flex-shrink-0">
        <h2 class="mb-3 border-b border-brown pb-1 text-2xl"><span class="font-icon mr-1 text-2xl text-brown">&#xe606;</span>{{ __('Recommend') }}
        </h2>
        @foreach ($recommends as $item)
          <div class="group relative mb-4 overflow-hidden">
            <a class="" href="/{{ $lang }}/news/{{ $item['id'] }}.html">
              <img class="block h-44 w-full object-cover duration-1000 group-hover:opacity-80" src="/storage/{{ $item['cover'] }}" alt="{{ $item['title'] }}">
              <div class="absolute bottom-0 h-7 bg-brown p-1 text-white duration-150 group-hover:h-24 group-hover:bg-brown/70">
                <h3 class="mb-1 line-clamp-1">{{ $item['title'] }}</h3>
                <p class="line-clamp-3 text-gray-200">{{ $item['description'] }}</p>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    </div>

  </section>
@endsection
@push('css')
  <style>
    .content img {
      max-width: 90%;
    }
  </style>
@endpush
@push('header-script')

@endpush