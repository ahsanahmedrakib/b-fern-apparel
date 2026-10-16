@php
    $adminLinks = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin.dashboard'],
        ['label' => 'Messages', 'route' => 'admin.messages.index', 'pattern' => 'admin.messages.*'],
    ];
@endphp

<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — {{ config('bfern.name') }}</title>

    @if (file_exists(public_path('favicon.ico')))
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full bg-paper-100 font-sans text-ink-900 antialiased">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="hidden w-64 shrink-0 flex-col bg-ink-950 lg:flex">
            <div class="border-b border-paper-100/10 p-6">
                <x-brand variant="light" />
            </div>

            <nav class="flex-1 space-y-1 p-4" aria-label="Admin">
                @foreach ($adminLinks as $link)
                    <a
                        href="{{ route($link['route']) }}"
                        @class([
                            'flex items-center justify-between rounded-xl px-4 py-3 text-sm font-medium transition',
                            'bg-paper-100/10 text-paper-50' => request()->routeIs($link['pattern']),
                            'text-paper-300/80 hover:bg-paper-100/5 hover:text-paper-50' => ! request()->routeIs($link['pattern']),
                        ])
                    >
                        <span>{{ $link['label'] }}</span>
                        @if ($link['route'] === 'admin.messages.index' && $unreadMessages > 0)
                            <span class="inline-flex min-w-6 items-center justify-center rounded-full bg-navy-500 px-1.5 py-0.5 text-xs font-semibold text-white">
                                {{ $unreadMessages }}
                            </span>
                        @endif
                    </a>
                @endforeach
            </nav>

            <div class="border-t border-paper-100/10 p-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 rounded-xl px-4 py-3 text-sm text-paper-300/80 transition hover:bg-paper-100/5 hover:text-paper-50" target="_blank" rel="noopener">
                    View website
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M9 7h8v8" />
                    </svg>
                </a>
            </div>
        </aside>

        {{-- Main --}}
        <div class="flex min-w-0 flex-1 flex-col">
            <header class="sticky top-0 z-30 border-b border-paper-200 bg-paper-50/90 backdrop-blur">
                <div class="flex h-16 items-center justify-between gap-4 px-6 lg:px-10">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-navy-600">Admin</p>
                        <h1 class="font-display text-lg font-semibold text-ink-950">@yield('heading', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="hidden text-sm text-ink-800/80 sm:block">{{ auth()->user()->email }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-secondary px-4 py-2 text-xs">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Mobile nav --}}
                <nav class="flex gap-2 overflow-x-auto border-t border-paper-200 px-6 py-3 lg:hidden" aria-label="Admin mobile">
                    @foreach ($adminLinks as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            @class([
                                'shrink-0 rounded-full px-4 py-2 text-sm font-medium transition',
                                'bg-ink-950 text-paper-50' => request()->routeIs($link['pattern']),
                                'text-ink-800 hover:bg-paper-200' => ! request()->routeIs($link['pattern']),
                            ])
                        >
                            {{ $link['label'] }}
                            @if ($link['route'] === 'admin.messages.index' && $unreadMessages > 0)
                                <span class="ml-1 text-xs text-navy-300">({{ $unreadMessages }})</span>
                            @endif
                        </a>
                    @endforeach
                </nav>
            </header>

            <main class="flex-1 px-6 py-8 lg:px-10 lg:py-10">
                @if (session('status'))
                    <div class="mb-6 rounded-2xl border border-navy-600/25 bg-navy-600/10 px-5 py-4 text-sm text-ink-900" role="status">
                        {{ session('status') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
