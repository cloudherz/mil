<!doctype html>
<html lang="en" translate="no" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta-title', 'TITLE')</title>
    <meta name="description" content="@yield('meta-description', 'DESCRIPTION')">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.author') }}">

    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:url" content="@yield('meta-url', 'URL')" />
    <meta property="og:title" content="@yield('meta-title', 'TITLE')" />
    <meta property="og:description" content="@yield('meta-description', 'DESCRIPTION')" />
    <meta property="og:image" content="@yield('meta-image', 'IMAGE')" />

    <meta name="twitter:card" content="summary" />
    <meta name="twitter:url" content="@yield('meta-url', 'URL')" />
    <meta name="twitter:title" content="@yield('meta-title', 'TITLE')">
    <meta name="twitter:description" content="@yield('meta-description', 'DESCRIPTION')">
    <meta name="twitter:image" content="@yield('meta-image', 'IMAGE')" />

    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="icon" href="" type="image/x-icon">
    <link rel="apple-touch-icon" href="">

    @vite(['resources/css/app.css'])
</head>
<body id="APP">
    <div class="S-DESKTOP-wrapper">
        <div class="S-DESKTOP-carcass">
            @yield('mode-desktop')
        </div>
    </div>
    <div class="S-LANDSCAPE-wrapper">
        <div class="S-LANDSCAPE-carcass">
            @yield('mode-landscape')
        </div>
    </div>
    <div class="S-MOBILE-wrapper">
        <div class="S-MOBILE-carcass">
            @yield('mode-mobile')
        </div>
    </div>

    @vite(['resources/js/app.js'])
    @yield('scripts')
</body>
</html>
