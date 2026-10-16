@php
    $links = [
        ['label' => 'About', 'route' => 'about'],
        ['label' => 'What We Do', 'route' => 'services'],
        ['label' => 'Global Presence', 'route' => 'locations'],
        ['label' => 'Contact', 'route' => 'contact.index'],
    ];
@endphp

<header id="site-header" class="sticky top-0 z-50 border-b border-paper-200/80 bg-paper-50/85 backdrop-blur">
    <div class="container-page flex h-18 items-center justify-between gap-6">
        <x-brand />

        <nav class="hidden items-center gap-8 lg:flex" aria-label="Primary">
            @foreach ($links as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @class([
                        'nav-link',
                        'text-navy-700' => request()->routeIs($link['route']),
                        'text-ink-700 hover:text-navy-700' => ! request()->routeIs($link['route']),
                    ])
                    @if (request()->routeIs($link['route'])) aria-current="page" @endif
                >
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="flex items-center gap-3">
            <a href="{{ route('contact.index') }}" class="btn btn-primary group hidden py-2.5 lg:inline-flex">
                Partner With Us
                <svg class="size-4 transition-transform duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>

            <button
                type="button"
                id="mobile-nav-toggle"
                class="inline-flex size-10 items-center justify-center rounded-full border border-paper-300 text-ink-900 transition hover:bg-paper-100 lg:hidden"
                aria-expanded="false"
                aria-controls="mobile-nav-panel"
                aria-label="Open menu"
            >
                <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-nav-panel" class="hidden border-t border-paper-200 bg-paper-50 lg:hidden">
        <nav class="container-page flex flex-col gap-1 py-4" aria-label="Mobile">
            @foreach ($links as $link)
                <a
                    href="{{ route($link['route']) }}"
                    @class([
                        'rounded-xl px-4 py-3 text-base font-medium transition',
                        'bg-paper-100 text-navy-700' => request()->routeIs($link['route']),
                        'text-ink-800 hover:bg-paper-100' => ! request()->routeIs($link['route']),
                    ])
                >
                    {{ $link['label'] }}
                </a>
            @endforeach

            <a href="{{ route('contact.index') }}" class="btn btn-primary mt-3">
                Partner With Us
            </a>
        </nav>
    </div>
</header>
