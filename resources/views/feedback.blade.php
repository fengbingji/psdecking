@extends('app')
@section('content')
  <x-header :index="7"></x-header>
  <section class="relative mb-12 h-80 bg-cover bg-center" style="background-image: url(/images/bg-feedback-cover.jpg)">
    <div class="absolute inset-0 flex flex-col items-center justify-center bg-brown/60">
      <h1 class="mb-3 text-center text-4xl text-white">{{ __('Get A Quote') }}</h1>
    </div>
    <div class="absolute inset-x-0 bottom-0 bg-black/50 text-gray-100">
      <div class="container mx-auto py-4">
        <a href="/{{ $lang }}/">{{ __('Home') }}</a>
        <span class="font-icon mx-1 font-bold">&#xe840;</span>
        {{ __('Get A Quote') }}
      </div>
    </div>
  </section>
  <form class="mx-auto mb-24 max-w-3xl" method="post">
    @csrf
    <h1 class="mb-3 mt-8 text-center text-4xl font-bold text-brown">{{ __('Get A Quote') }}</h1>

    @if (session('success'))
      <div class="mb-12 text-center text-brown p-4 my-4 border rounded bg-brown/30">
        {{ session('success') }}
      </div>
    @else
      <p class="mb-12 text-center text-gray-500">{{ __('Please leave your basic information, and we will contact you as soon as possible.') }}</p>
    @endif
    <div class="md:flex md:flex-wrap">
      <label class="mb-6 pr-3 md:w-1/2">
        <input class="w-full border p-3 focus:outline-brown" name="author" type="text" value="{{ old('author') }}" placeholder="{{ __('Your Name') }}*" required />
      </label>

      <label class="mb-6 md:w-1/2">
        <input class="w-full border p-3 focus:outline-brown" name="email" type="email" value="{{ old('email') }}" placeholder="{{ __('Your Email') }}*" required />
      </label>

      <label class="mb-6 pr-3 md:w-1/2">
        <input class="w-full border p-3 focus:outline-brown" name="phone" type="text" value="{{ old('phone') }}" placeholder="{{ __('Your Phone') }}" />
      </label>
      <label class="mb-6 md:w-1/2">
        <input class="w-full border p-3 focus:outline-brown" name="subject" type="text" value="{{ old('subject') }}" placeholder="{{ __('Your Subject') }}" />
      </label>

      <label class="mb-6 md:flex-1">
        <textarea class="w-full border p-3 focus:outline-brown" name="content[message]" placeholder="{{ __('Your Message') }}" rows="4">{{ old('content[message]') }}</textarea>
      </label>
    </div>
    <div class="text-center">
      <button class="border border-brown px-6 py-2 text-brown duration-200 hover:bg-brown hover:text-white">{{ __('SEND MESSAGE') }}</button>
    </div>

  </form>
@endsection
