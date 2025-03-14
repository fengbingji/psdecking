@extends('app',['site_title'=>__('Project')])
@section('content')
    <x-header></x-header>
    <section class="container mx-auto">
        <div class="py-6"><a href="/{{ $lang }}/">{{ __('Home') }}</a> / {{ __('Project') }}</div>
        <div class="grid md:grid-cols-3 grid-cols-1 gap-6">
            @foreach ($projects as $project)
                <div class="group flex flex-col bg-gray-100 duration-150 hover:shadow-lg">
                    <a class="relative after:absolute after:inset-2 after:border after:opacity-0 after:duration-500 after:content-[''] group-hover:after:opacity-100"
                       data-src="/storage/{{ $project['images'][0] }}"
                       data-fancybox="gallery" data-caption="{{ $project['description'] }}" href="javascript:">
                        <img class="block h-52 w-full object-cover"
                             src="/storage/{{ Str::replaceLast('.', '-s.', $project['images'][0]) }}"
                             alt="{{ $project['title'] }}">
                    </a>
                    <div class="flex flex-1 flex-col p-4">
                        <h2 class="mb-2 flex-1 text-2xl text-brown">{{ $project['title'] }}</h2>
                        <div class="flex flex-nowrap space-x-2 overflow-hidden">
                            @foreach ($project['tags'] as $tag)
                                <span class="rounded bg-gray-400 px-2 py-1 text-xs text-white">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="mt-4 flex justify-end">
                            <a class="inline-block border-2 border-brown px-6 py-3 font-bold duration-500 hover:bg-brown hover:text-white"
                               href="/{{ $lang }}/project/{{ $project['id'] }}.html">{{ __('READ MORE') }}</a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        <div class="my-6">{{ $projects->links() }}</div>
  </section>
@endsection
