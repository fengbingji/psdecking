@extends('app', ['site_title' => $entity['title']])
@section('content')
  <x-header></x-header>
  <section class="container mx-auto">
    <div class="py-6"><a href="/{{ $lang }}/">{{ __('Home') }}</a> / <a href="/{{ $lang }}/project">{{ __('Project') }}</a></div>
    <h1 class="mb-8 text-center text-3xl">{{ $entity['title'] }}</h1>
    <div class="mb-8 grid md:grid-cols-4 grid-cols-1 gap-6">
      @foreach ($entity['images'] as $image)
        <a class="duration-200 hover:shadow-xl hover:shadow-black/40" data-src="/storage/{{ $image }}" data-fancybox="gallery" href="javascript:">
          <img class="w-full object-cover" src="/storage/{{ Str::replaceLast('.', '-s.', $image) }}">
        </a>
      @endforeach
    </div>
    <div class="my-6">
      {!! $entity['description'] !!}
    </div>
  </section>
@endsection
