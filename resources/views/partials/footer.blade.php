@php
    $year = now()->year;
    $links = [
        ['label' => 'About Us', 'route' => 'about'],
        ['label' => 'What We Do', 'route' => 'services'],
        ['label' => 'Global Presence', 'route' => 'locations'],
        ['label' => 'Our Team', 'route' => 'team'],
        ['label' => 'Contact', 'route' => 'contact.index'],
    ];
@endphp

<footer class="bg-ink-950 text-paper-300">
    <div class="container-page grid gap-12 py-8 lg:grid-cols-12">
        <div class="lg:col-span-5">
            <x-brand variant="light" />
            <p class="mt-6 max-w-md text-sm leading-relaxed text-paper-300/80">
                {{ config('bfern.boilerplate') }}
            </p>

            @if (config('bfern.social.linkedin'))
                <a href="{{ config('bfern.social.linkedin') }}"
                    class="mt-6 inline-flex items-center gap-2 text-sm font-semibold text-navy-300 transition hover:text-navy-400"
                    rel="noopener noreferrer" target="_blank">
                    LinkedIn
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 17 17 7M9 7h8v8" />
                    </svg>
                </a>
            @endif
        </div>

        <div class="lg:col-span-3">
            <h2 class="eyebrow text-navy-300">Explore</h2>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach ($links as $link)
                    <li>
                        <a href="{{ route($link['route']) }}" class="text-paper-300/85 transition hover:text-paper-50">
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="lg:col-span-4">
            <h2 class="eyebrow text-navy-300">U.S. Presence</h2>
            <ul class="mt-5 space-y-4 text-sm">
                @foreach (config('bfern.us_locations') as $location)
                    <li class="flex gap-3">
                        <svg class="mt-0.5 size-4 shrink-0 text-navy-400" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21s-6.5-5.4-6.5-10a6.5 6.5 0 1 1 13 0c0 4.6-6.5 10-6.5 10Z" />
                            <circle cx="12" cy="11" r="2.2" />
                        </svg>
                        <span class="text-paper-300/85">
                            <span class="font-semibold text-paper-100">{{ $location['city'] }}</span>
                            <span class="text-paper-300/70"> — {{ $location['type'] }}</span>
                            @if ($location['address'])
                                <span class="mt-0.5 block text-paper-300/60">{{ $location['address'] }}</span>
                            @endif
                        </span>
                    </li>
                @endforeach
            </ul>

            <a href="mailto:{{ config('bfern.contact.email') }}"
                class="mt-6 inline-block text-sm font-semibold text-navy-300 transition hover:text-navy-400">
                {{ config('bfern.contact.email') }}
            </a>
        </div>
    </div>

    <div class="border-t border-paper-100/10">
        <div
            class="container-page flex flex-col gap-3 py-6 text-xs text-paper-300/60 sm:flex-row sm:items-center sm:justify-between">
            <p>&copy; {{ $year }} {{ config('bfern.name') }}. All rights reserved.</p>
            <p>Apparel liquidation &middot; Authorized brand purchasing &middot; International operations</p>
        </div>
    </div>
</footer>
