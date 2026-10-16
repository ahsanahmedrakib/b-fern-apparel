@extends('layouts.app')

@section('title', 'Global Presence')

@section('description', 'Offices in Vietnam, Indonesia, Cambodia, Bangladesh, Egypt, Jordan, and Kenya, with a New York showroom at 525 Seventh Avenue and operations in Brooklyn and Edison, New Jersey.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Global Presence',
        'title' => 'Where we operate',
        'description' => 'An international network across Asia, North Africa, the Middle East, and Africa — plus a New York showroom and East Coast operations that keep merchandise moving.',
    ])

    {{-- International offices --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page">
            <div class="max-w-2xl" data-reveal>
                <p class="eyebrow text-navy-600">International Offices</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    Seven offices supporting our global partnerships
                </h2>
                <p class="mt-6 text-base leading-relaxed text-ink-800/90">
                    With offices in Vietnam, Indonesia, Cambodia, Bangladesh, Egypt, Jordan, and Kenya, we maintain an
                    international network that supports our operations and partnerships worldwide.
                </p>
            </div>

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (config('bfern.international_offices') as $office)
                    <article class="card group flex items-center justify-between gap-4 hover:border-navy-600/60">
                        <div>
                            <h3 class="font-display text-2xl font-semibold text-ink-950">{{ $office['country'] }}</h3>
                            <p class="mt-1 text-xs font-semibold uppercase tracking-[0.18em] text-navy-600">{{ $office['region'] }}</p>
                        </div>
                        <span class="grid size-11 shrink-0 place-items-center rounded-full bg-paper-100 text-navy-700 transition group-hover:bg-navy-700/10">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                <circle cx="12" cy="12" r="8.2" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.8c2.6 2.2 4 5 4 8.2s-1.4 6-4 8.2c-2.6-2.2-4-5-4-8.2s1.4-6 4-8.2Zm-8.2 8.2h16.4" />
                            </svg>
                        </span>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- U.S. presence --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-paper-100 weave-pattern lg:py-28">
        <div class="pointer-events-none absolute -right-32 top-0 size-96 rounded-full bg-navy-500/10 blur-3xl" aria-hidden="true"></div>

        <div class="container-page relative">
            <div class="grid gap-10 lg:grid-cols-12 lg:items-end" data-reveal>
                <div class="lg:col-span-8">
                    <p class="eyebrow text-navy-300">United States</p>
                    <h2 class="display mt-5 text-3xl leading-tight text-paper-50 sm:text-4xl">
                        New York showroom &amp; East Coast operations
                    </h2>
                </div>
                <div class="lg:col-span-4">
                    <p class="text-base leading-relaxed text-paper-300/85">
                        Our New York showroom, Brooklyn office, and Edison, New Jersey operations support our
                        day-to-day work, customer relationships, and merchandise handling.
                    </p>
                </div>
            </div>

            {{-- Showroom feature --}}
            <div class="mt-14 overflow-hidden rounded-3xl border border-paper-100/15 bg-paper-100/[0.06]">
                <div class="grid lg:grid-cols-12">
                    <div class="p-8 lg:col-span-7 lg:p-12">
                        <p class="eyebrow text-navy-300">New York Showroom</p>
                        <p class="display mt-5 text-4xl leading-tight text-paper-50 sm:text-5xl">525 Seventh Avenue</p>
                        <p class="mt-5 max-w-lg text-base leading-relaxed text-paper-300/85">
                            Located in the heart of Manhattan's apparel district, our showroom is where buyers review
                            merchandise and meet with our team.
                        </p>
                    </div>
                    <div class="flex items-center border-t border-paper-100/15 p-8 lg:col-span-5 lg:border-l lg:border-t-0 lg:p-12">
                        <a href="{{ route('contact.index') }}" class="btn btn-light w-full sm:w-auto">
                            Arrange a visit
                            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6 grid gap-5 lg:grid-cols-3">
                @foreach (config('bfern.us_locations') as $location)
                    <article class="card-dark border-paper-100/15 bg-paper-100/[0.05]">
                        <p class="eyebrow text-navy-300">{{ $location['type'] }}</p>
                        <h3 class="mt-3 font-display text-2xl font-semibold text-paper-50">{{ $location['city'] }}</h3>
                        @if ($location['address'])
                            <p class="mt-2 text-sm font-semibold text-navy-300">{{ $location['address'] }}</p>
                        @endif
                        <p class="mt-4 text-sm leading-relaxed text-paper-300/80">{{ $location['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.cta', [
        'title' => 'A network that works for your merchandise',
        'description' => 'From overseas offices to our New York showroom, our team is set up to coordinate apparel across markets.',
    ])
@endsection
