<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.seo')
    <script>document.documentElement.classList.add('js');</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-paper-50 font-sans text-ink-900 antialiased">
    <a href="#main" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:rounded-full focus:bg-ink-950 focus:px-5 focus:py-2 focus:text-sm focus:font-semibold focus:text-paper-50">
        Skip to content
    </a>

    @include('partials.nav')

    <main id="main" class="flex-1">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>
