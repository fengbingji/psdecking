<header>

    <div class="bg-gray-100 py-2">
        <div class="container m-auto flex text-gray-400">
            <div class="mr-4 line-clamp-1 flex-1 whitespace-nowrap flex items-center">{{ config('base.top_notice') }}</div>
            <div class="flex space-x-2">
                <a class="group" href="{{ config('base.facebook') }}" target="_blank">
                    <svg height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path class="fill-gray-400 duration-200 group-hover:fill-brown/80"
                              d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                    </svg>
                </a>
                <a class="group" href="{{ config('base.instagram') }}" target="_blank">
                    <svg height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                        <path class="fill-gray-400 duration-200 group-hover:fill-brown/80"
                              d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                    </svg>
                </a>
                <a class="group" href="{{ config('base.youtube') }}" target="_blank">
                    <svg height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                        <path class="fill-gray-400 duration-200 group-hover:fill-brown/80"
                              d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <div class="bg-bottom bg-repeat-x">
        <div class="container mx-auto my-2 flex items-center space-x-4 bg-white">
            <div class="mr-auto">
                <a href="/">
                    <img class="h-12" src="/storage/{{ config("setting.logo") }}" alt="{{ config("{$lang}.site_name") . ' - ' . config("{$lang}.site_title") }}" />
                </a>
            </div>

            <div class="space-x-1 py-2 md:flex hidden">
                <a class="{{ $lang == 'en' ? 'bg-brown text-white shadow hover:text-white ' : 'hover:bg-brown/50' }} flex items-center rounded px-2 duration-200" href="/en">
                    @if ($lang == 'en')
                        <span class="font-icon mr-1 !text-xl leading-none text-white">&#xe844;</span>
                    @endif
                    English
                </a>
                <a class="{{ $lang == 'zh' ? 'bg-brown text-white shadow hover:text-white ' : 'hover:bg-brown/50' }} flex items-center rounded px-2 duration-200" href="/zh">
                    @if ($lang == 'zh')
                        <span class="font-icon mr-1 !text-xl leading-none text-white">&#xe844;</span>
                    @endif
                    中文
                </a>
            </div>
        </div>
    </div>

    <div class="rd-navbar-wrap ">
        <nav class="rd-navbar md:shadow-lg md:backdrop-blur !bg-yellow-500/30 ">
            <div class="rd-navbar-inner bg-red-100">
                <div class="rd-navbar-panel bg-green-100">
                    <a href="/{{request()->get('locale')}}">
                        <img class="h-12" src="/storage/{{ config("setting.logo") }}" alt="{{ config("{$lang}.site_name") . ' - ' . config("{$lang}.site_title") }}" />
                    </a>
                </div>
                <div class="rd-navbar-nav-wrap md:!flex items-center">
                    <ul class="rd-navbar-nav md:flex-1">
                        @foreach (collect($menus)->where('parent_id', 0)->toArray() as $index => $p_menu)
                            <li class="{{ $index == 1 ? 'active' : '' }}">
                                <a href="{{ $p_menu['url'] ? '/' . request()->get('locale') . $p_menu['url'] : 'javascript:' }}">{{ $p_menu['name'] }}</a>
                                @if (collect($menus)->where('parent_id', $p_menu['id'])->count() > 0)
                                    <ul class="rd-navbar-dropdown">
                                        @foreach (collect($menus)->where('parent_id', $p_menu['id'])->toArray() as $s_menu)
                                            <li>
                                                <a href="/{{ request()->get('locale') . $s_menu['url'] }}">{{ $s_menu['name'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        <a class="block border border-brown px-4 py-2 text-brown duration-200 hover:bg-brown hover:text-white" href="/{{ $lang }}/feedback">
                            {{ __('GET A QUOTE') }}
                        </a>
                    </div>
                </div>

                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap">
                    <span></span>
                </button>
            </div>
        </nav>
    </div>

    <nav class="sticky top-0 z-50 mb-0 hidden bg-white/70 shadow-lg backdrop-blur " id="sticker">
        <div class="container mx-auto flex flex-col flex-wrap justify-between py-3 font-bold md:flex-row md:items-center">
            <div class="main-nav flex-1 overflow-hidden hover:overflow-visible">

            </div>

            <div class="mr-4">
                <a class="block border border-brown px-4 py-2 text-brown duration-200 hover:bg-brown hover:text-white" href="/{{ $lang }}/feedback">
                    {{ __('GET A QUOTE') }}
                </a>
                <div class="space-x-1 py-2 flex justify-end md:hidden">
                    <a class="{{ $lang == 'en' ? 'bg-brown text-white shadow hover:text-white ' : 'hover:bg-brown/50' }} flex items-center rounded px-2 duration-200" href="/en">
                        @if ($lang == 'en')
                            <span class="font-icon mr-1 !text-xl leading-none text-white">&#xe844;</span>
                        @endif
                        English
                    </a>
                    <a class="{{ $lang == 'zh' ? 'bg-brown text-white shadow hover:text-white ' : 'hover:bg-brown/50' }} flex items-center rounded px-2 duration-200" href="/zh">
                        @if ($lang == 'zh')
                            <span class="font-icon mr-1 !text-xl leading-none text-white">&#xe844;</span>
                        @endif
                        中文
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    o = $('.rd-navbar');

    o.RDNavbar({
        responsive: {
            0: {
                layout: 'rd-navbar-fixed'
            },
            768: {
                layout: 'rd-navbar-fullwidth'
            },
            1200: {
                layout: 'rd-navbar-static',
                stickUpClone: false,
                stickUpOffset:'120%'
            }
        }
    })
</script>





