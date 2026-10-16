<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Sign in') — {{ config('bfern.name') }}</title>

    @if (file_exists(public_path('favicon.ico')))
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex min-h-screen flex-col bg-ink-950 font-sans text-ink-900 antialiased">
    <div class="flex flex-1 items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">
            <div class="mb-8 flex justify-center">
                <x-brand variant="light" />
            </div>

            @yield('content')

            <p class="mt-8 text-center text-xs text-paper-300/60">
                &copy; {{ now()->year }} {{ config('bfern.name') }} &middot; Admin access only
            </p>
        </div>
    </div>
</body>
</html>
