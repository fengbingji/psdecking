@if (config('base.top_notice'))
  <div class="bg-gray-50">
    <p class="py-3 text-center text-sm text-gray-400">
      {{ config('base.top_notice') }}
    </p>
  </div>
@endif
<section class="bg-bottom bg-repeat-x " >
    <div class="container mx-auto my-2 flex space-x-4 bg-white px-4" >
        <div class="flex-1">
            <a href="/">
                <img class="h-12" src="/images/logo.png?v=3" alt="" />
            </a>
        </div>
        <div class="flex items-center space-x-1">
            <span class="font-icon !text-3xl leading-none text-brown">&#xe6f0;</span>
            <div>
                <div class="text-black">JIHUA ROAD</div>
                <div>Foshan City,China</div>
            </div>
        </div>
        <div class="flex items-center space-x-1">
            <span class="font-icon !text-3xl leading-none text-brown">&#xe844;</span>
            <div>
                <div class="text-black">+86 0757 812345678</div>
                <div>master@praysun.com</div>
            </div>
        </div>
    </div>
</section>


<div class="z-50 bg-white shadow-lg mb-0 sticky top-0 bg-bottom bg-repeat-x" id="sticker" style="background-image: url(/images/scale.png); ">
  <div class="container mx-auto flex flex-wrap items-center justify-between  py-3 font-bold bg-white ">
    <nav class="main-nav hidden flex-1 sm:block overflow-hidden hover:overflow-visible">
      <ul class="parent mr-16 flex justify-around">
        @foreach (collect($menus)->where('parent_id', 0)->toArray() as $index => $p_menu)
          <li class="{{$index == 1?'active':'group'}}">
            <a class="group-hover:text-brown" href="/{{ $p_menu['url'] ? request('lang') . $p_menu['url'] : 'javascript:;' }}">{{ $p_menu['name'] }}</a>
            @if (collect($menus)->where('parent_id', $p_menu['id'])->count() > 0)
              <ul class="son">
                @foreach (collect($menus)->where('parent_id', $p_menu['id'])->toArray() as $s_menu)
                  <li><a href="/{{ request('lang') . $s_menu['url'] }}">{{ $s_menu['name'] }}</a></li>
                @endforeach
              </ul>
            @endif
          </li>
        @endforeach
      </ul>
    </nav>

    <div class="mr-4">
      <a class="block border border-brown px-4 py-2 duration-200 hover:bg-brown hover:text-white text-brown" href="/{{ $lang }}/feedback">
        GET A QUOTE
      </a>
    </div>

    <ul class="menu bg-base-100 rounded-box mt-2 hidden w-full shadow" id="mobile-menu">
      @foreach (collect($menus)->where('parent_id', 0)->toArray() as $index => $p_menu)
        <li @if ($index == 1) class="active" @endif>
          <a href="{{ $p_menu['url'] ? request('lang') . $p_menu['url'] : 'javascript:;' }}">{{ $p_menu['name'] }}</a>
          @if (collect($menus)->where('parent_id', $p_menu['id'])->count() > 0)
            <ul class="son">
              @foreach (collect($menus)->where('parent_id', $p_menu['id'])->toArray() as $s_menu)
                <li><a href="{{ request('lang') . $p_menu['url'] }}">公司介绍</a></li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    </ul>
  </div>
</div>

<script>
  $('#show-menu .swap-on').click(function() {
    $('#mobile-menu').toggle()
  })
</script>
