@extends('app',['site_title'=>$entity['title']])
@section('content')
    <x-header></x-header>
    <section class="relative mb-12 h-80 bg-cover bg-bottom"
             style="background-image: url({{$entity->cover?'/storage/'.$entity->cover : ($entity->category->slug=='about-us'?'/images/page-normal-top-bg.jpg':'')}})">
        <div class="absolute inset-0 flex flex-col items-center justify-center bg-brown/60">
            <h1 class="mb-3 text-center text-3xl text-white">{{ $entity['title'] }}</h1>
        </div>
        <div class="absolute inset-x-0 bottom-0 bg-black/50 text-gray-100">
            <div class="container mx-auto py-4">
                <a href="/{{ $lang }}/">{{ __('Home') }}</a>
                <span class="font-icon mx-1 font-bold">&#xe840;</span>
                {{ $entity->category->slug=='about-us'? __('About us'):$entity->title }}
            </div>
        </div>
    </section>
    <section class="container mx-auto">
        <div class="content my-6 leading-7">
            {!! $entity['content'] !!}
        </div>
    </section>
@endsection

@push('css')
  <style>
    .content p {
      text-indent: 2em;
      margin-bottom: 1rem;
    }

    .content p img {
      max-width: 90%;
      border-radius: 10px;
      display: block;
      margin: auto;
    }
  </style>
@endpush
