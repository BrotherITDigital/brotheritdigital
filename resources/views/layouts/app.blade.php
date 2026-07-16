<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- SEO Meta --}}
    <title>@yield('title', ($settings['meta_title'] ?? 'Brother IT Digital PLC') . ' – ' . ($settings['site_tagline'] ?? 'Building Digital Solutions for the Future'))</title>
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Brother IT Digital PLC is a professional software development company.')">
    <meta name="keywords" content="@yield('meta_keywords', 'software development, web development, mobile apps, Laravel, Bangladesh, Brother IT Digital')">
    <meta name="author" content="{{ $settings['site_name'] ?? 'Brother IT Digital PLC' }}">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', $settings['site_name'] ?? 'Brother IT Digital PLC')">
    <meta property="og:description" content="@yield('og_description', $settings['site_description'] ?? 'Building Digital Solutions for the Future.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:site_name" content="{{ $settings['site_name'] ?? 'Brother IT Digital PLC' }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $settings['site_name'] ?? 'Brother IT Digital PLC')">
    <meta name="twitter:description" content="@yield('og_description', $settings['site_description'] ?? 'Building Digital Solutions for the Future.')">

    {{-- Schema.org JSON-LD --}}
    <script type="application/ld+json">
    {
        "{{ '@context' }}": "https://schema.org",
        "{{ '@type' }}": "Organization",
        "name": "{{ $settings['site_name'] ?? 'Brother IT Digital PLC' }}",
        "url": "{{ config('app.url') }}",
        "logo": "{{ asset('images/logo.png') }}",
        "description": "{{ $settings['site_description'] ?? 'Professional software development company.' }}",
        "telephone": "{{ $settings['contact_phone'] ?? '+88016-09113112' }}",
        "email": "{{ $settings['contact_email'] ?? 'brotheritdigital@gmail.com' }}",
        "sameAs": [
            "{{ $settings['facebook_url'] ?? '#' }}",
            "{{ $settings['linkedin_url'] ?? '#' }}",
            "{{ $settings['github_url'] ?? '#' }}",
            "{{ $settings['twitter_url'] ?? '#' }}"
        ]
    }
    </script>

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Swiper CSS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles

    @stack('styles')
</head>
<body>
    {{-- Page Loader --}}
    <div id="page-loader" class="page-loader">
        <div class="loader-ring"></div>
    </div>

    {{-- Navigation --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main id="main-content">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

    {{-- Swiper JS --}}
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    @livewireScripts

    @stack('scripts')
</body>
</html>
