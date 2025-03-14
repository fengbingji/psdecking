<div class="pb-10 pt-16 text-white" style="background-image: url(/images/footer-bg.jpg)">
  <div class="container mx-auto flex flex-col md:flex-row md:space-x-4">
    <div class="md:w-1/3 mb-6 md:mb-0">
      <h3 class="mb-3 text-2xl">{{ config("{$lang}.siate_name") }}</h3>
      <div class="pr-6 leading-8">
        {{ config("{$lang}.description") }}
      </div>
    </div>
    <div class="md:w-1/3 mb-6 md:mb-0">
      <h3 class="mb-3 text-2xl">{{ __('PRODUCTS') }}</h3>
      <div class="leading-8">
        <a class="mr-2 inline-block rounded border border-gray-100 px-3 py-0.5 hover:border-brown hover:bg-brown hover:text-white" href="/{{$lang}}/pro-fence">
          {{ __('FENCE') }}
        </a>
        <a class="mr-2 inline-block rounded border border-gray-100 px-3 py-0.5 hover:border-brown hover:bg-brown hover:text-white" href="/{{$lang}}/pro-3d-embossing-decking">
          {{ __('DECKING') }}
        </a>
      </div>
      <div class="mt-8">
        <a class="inline-block border border-brown bg-brown px-5 py-3 text-lg font-bold text-white duration-200 hover:border-white hover:bg-transparent hover:text-brown" href="/{{ $lang }}/pro-all">
          {{ __('VIEW ALL PRODUCTS') }}
        </a>
      </div>
    </div>
    <div class="md:w-1/3 mb-6 md:mb-0">
      <h3 class="mb-3 text-2xl">{{ __('CONTACT DETAILS') }}</h3>
      <div class="mb-3 flex items-center space-x-1 text-gray-200">
        <span class="font-icon !text-3xl leading-none text-brown">&#xe6f0;</span>
        <div class="whitespace-pre-wrap">{{ config("{$lang}.address") }}</div>
      </div>
      <div class="flex items-center space-x-1 text-gray-200">
        <span class="font-icon !text-3xl leading-none text-brown">&#xe844;</span>
        <div>
          <p><a href="tel:{{ config("{$lang}.tel") }}">{{ config("{$lang}.tel") }}</a></p>
          <p>{{ config("{$lang}.email") }}</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="bg-black text-gray-100">
  <div class="container mx-auto flex justify-between py-4 flex-col md:flex-row">
    <div>Copyrights © {{ date('Y') }} All Rights Reserved</div>
    <div class="flex space-x-4 mt-2 md:md-0">
      <a href="/{{ $lang }}">{{ __('Home') }}</a>
      <a href="/{{ $lang }}/page/about">{{ __('About') }}</a>
      <a href="/{{ $lang }}/page/contact">{{ __('Contact') }}</a>
    </div>
  </div>
</div>

<a class="group fixed bottom-[15%] right-8 z-50 rounded-xl bg-brown/20 p-4 text-center duration-500 hover:bg-brown" href="{{ config('base.whatsapp') }}" target="_blank">
  <svg height="50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    <path class="fill-brown duration-200 group-hover:fill-white/90"
      d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
  </svg>
</a>
