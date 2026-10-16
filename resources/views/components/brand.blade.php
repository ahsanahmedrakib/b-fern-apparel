@props(['variant' => 'dark'])

@php
    $logoFiles = ['images/logo.svg', 'images/logo.png', 'logo.svg', 'logo.png'];
    $logo = collect($logoFiles)->first(fn ($file) => file_exists(public_path($file)));
@endphp

<a href="{{ route('home') }}" {{ $attributes->merge(['class' => 'inline-flex items-center', 'aria-label' => config('bfern.name').' home']) }}>
    @if ($logo)
        @if ($variant === 'light')
            {{-- Logo artwork is dark, so sit it on a light chip over dark sections --}}
            <span class="inline-flex items-center rounded-2xl bg-paper-50 px-4 py-3">
                <img src="{{ asset($logo) }}" alt="{{ config('bfern.name') }}" class="h-9 w-auto lg:h-10">
            </span>
        @else
            <img src="{{ asset($logo) }}" alt="{{ config('bfern.name') }}" class="h-12 w-auto lg:h-14">
        @endif
    @else
        <span class="inline-flex items-center gap-2.5">
            <span @class([
                'grid size-10 place-items-center rounded-full font-display text-sm font-semibold tracking-tight',
                'bg-navy-700 text-paper-50' => $variant === 'dark',
                'bg-paper-100 text-ink-950' => $variant === 'light',
            ])>BF</span>
            <span class="leading-none">
                <span @class([
                    'block font-display text-lg font-semibold tracking-tight',
                    'text-ink-950' => $variant === 'dark',
                    'text-paper-50' => $variant === 'light',
                ])>B.Fern</span>
                <span @class([
                    'mt-1 block text-[0.6rem] font-semibold uppercase tracking-[0.3em]',
                    'text-navy-600' => $variant === 'dark',
                    'text-navy-300' => $variant === 'light',
                ])>Apparel</span>
            </span>
        </span>
    @endif
</a>
