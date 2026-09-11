<!doctype html>
<html lang="en" translate="no" class="notranslate">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta-title', 'TITLE')</title>
    <meta name="description" content="@yield('meta-description', 'DESCRIPTION')">
    <meta name="keywords" content="@yield('meta-keywords', 'KEYWORDS')">
    <meta name="author" content="{{ config('app.author') }}">
    <link rel="canonical" href="@yield('meta-url', 'URL')" />

    <meta property="og:title" content="@yield('meta-title', 'TITLE')" />
    <meta property="og:description" content="@yield('meta-description', 'DESCRIPTION')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="@yield('meta-url', 'URL')" />
    <meta property="og:image" content="@yield('meta-image', 'IMAGE')" />
    <meta property="og:image:alt" content="@yield('meta-image-alt', 'IMAGE ALT')" />
    <meta property="og:site_name" content="@yield('meta-site-name', 'SITE NAME')" />
    <meta property="og:locale" content="ru_RU" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="@yield('meta-title', 'TITLE')" />
    <meta name="twitter:description" content="@yield('meta-description', 'DESCRIPTION')" />
    <meta name="twitter:image" content="@yield('meta-image', 'IMAGE')" />
    <meta name="twitter:image:alt" content="@yield('meta-image-alt', 'IMAGE ALT')" />
    <meta name="twitter:url" content="@yield('meta-url', 'URL')" />

    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">

    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('images/favicon/site.webmanifest') }}">
    <meta name="theme-color" content="#ffffff">

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
