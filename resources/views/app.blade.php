<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', \Illuminate\Support\Facades\App::currentLocale()) }}">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="chrome=1,IE=edge">
  <meta name="renderer" content="webkit">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <meta name="keyword" content="{{ $keyword ?? config("{$lang}.keyword") }}">
  <meta name="description" content="{{ $description ?? config("{$lang}.description") }}">
  @yield('site-meta')
  <title>{{ isset($site_title) ? $site_title . ' - ' . config("{$lang}.site_name") : config("{$lang}.site_title") }}</title>
  <link href="https://cdn.bootcdn.net/ajax/libs/animate.css/4.1.1/animate.compat.css" rel="stylesheet">
  <link href="https://cdn.bootcdn.net/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
  @stack('css')
  <script src="/script/jquery.3.1.0.min.js"></script>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
  @stack('header-script')
  {!! config('base.statistics') !!}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/jquery.rd-navbar/jquery.rd-navbar.min.js"></script>
    <link rel="stylesheet" href="/js/jquery.rd-navbar/rd-navbar.css">

</head>

<body>

  @yield('content')
  <x-footer />
  @stack('footer-script')
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-C4X3XG0YLR"></script>
  <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-C4X3XG0YLR');
  </script>
  this is a test
{{--  <!-- Start cookieyes banner --> <script id="cookieyes" type="text/javascript" src="https://cdn-cookieyes.com/client_data/a32586904503b9d5eec7b90e/script.js"></script> <!-- End cookieyes banner -->--}}
</body>

</html>
