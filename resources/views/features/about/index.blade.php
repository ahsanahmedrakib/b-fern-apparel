@extends('layouts.app')

@section('title', 'About Us')

@section('description', 'For more than 20 years, B.Fern Apparel has connected leading brands with buyers in the apparel market — one of the largest apparel liquidators in the United States.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Our Story',
        'title' => 'Built on trusted partnerships',
        'description' => 'For more than 20 years, B.Fern Apparel has connected leading brands with buyers in the apparel market — a reputation earned through experience, authorized relationships, and an international operating network.',
    ])

    {{-- Story --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page grid gap-12 lg:grid-cols-12 lg:gap-16" data-reveal>
            <div class="lg:col-span-5">
                <p class="eyebrow text-navy-600">Who We Are</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    One of the largest apparel liquidators in the United States
                </h2>
            </div>

            <div class="space-y-5 text-base leading-relaxed text-ink-800/90 lg:col-span-7">
                <p class="text-lg text-ink-900">
                    Over more than 20 years, we have built a reputation as one of the largest apparel liquidators in
                    the United States, supported by deep industry experience, long-standing relationships, and a
                    strong international presence.
                </p>
                <p>
                    Our business is built on trusted partnerships. We work with 50 brands under agreements
                    authorizing us to purchase their merchandise overseas. Brand release letters accompany these
                    transactions, providing the necessary authorization for the goods we handle.
                </p>
                <p>
                    These relationships reflect our experience in managing apparel opportunities responsibly and
                    coordinating the movement of merchandise across international markets.
                </p>
                <p>
                    We work across men's, women's, and children's apparel, including both knit and woven garments. Our
                    broad product experience allows us to serve a diverse range of market segments and customer needs.
                </p>
            </div>
        </div>
    </section>

    {{-- Authorized relationships highlight --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-paper-100 weave-pattern lg:py-24">
        <div class="pointer-events-none absolute -right-24 top-0 size-96 rounded-full bg-navy-600/20 blur-3xl" aria-hidden="true"></div>

        <div class="container-page relative grid gap-12 lg:grid-cols-12 lg:items-center" data-reveal>
            <div class="lg:col-span-4">
                <p class="font-display text-7xl font-semibold text-navy-300 sm:text-8xl">{{ config('bfern.brands_count') }}</p>
                <p class="mt-3 text-sm font-semibold uppercase tracking-[0.2em] text-paper-300/75">Brands under agreement</p>
            </div>

            <div class="lg:col-span-8">
                <h2 class="display text-3xl leading-tight text-paper-50 sm:text-4xl">
                    Authorized to purchase overseas — backed by brand release letters
                </h2>
                <p class="mt-6 text-base leading-relaxed text-paper-300/85">
                    We work with 50 brands under agreements authorizing us to purchase their merchandise overseas.
                    Every transaction is accompanied by brand release letters, providing the necessary authorization
                    for the goods we handle. It is a disciplined, transparent approach to apparel liquidation — and the
                    reason brands and buyers return to us year after year.
                </p>
            </div>
        </div>
    </section>

    {{-- Product coverage --}}
    <section class="border-y border-paper-200 bg-paper-100/60 py-20 lg:py-24">
        <div class="container-page grid gap-12 lg:grid-cols-12 lg:gap-16" data-reveal>
            <div class="lg:col-span-5">
                <p class="eyebrow text-navy-600">Product Experience</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    Broad coverage across categories and constructions
                </h2>
                <p class="mt-6 text-base leading-relaxed text-ink-800/90">
                    Our product range spans men's, women's, and children's apparel, in both knit and woven
                    constructions — giving us the flexibility to serve a wide range of market segments.
                </p>
            </div>

            <div class="flex flex-wrap content-start gap-3 lg:col-span-7">
                @foreach (config('bfern.product_categories') as $category)
                    <span class="rounded-full border border-paper-300 bg-white px-5 py-2.5 text-sm font-semibold text-ink-800">
                        {{ $category }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page">
            <div class="max-w-2xl" data-reveal>
                <p class="eyebrow text-navy-600">How We Work</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    Professionalism, reliability, and care
                </h2>
            </div>

            <div class="mt-14 grid gap-5 lg:grid-cols-3">
                @php
                    $values = [
                        ['title' => 'Professionalism', 'body' => 'Two decades of industry knowledge applied to every opportunity we take on, from first conversation to final delivery.'],
                        ['title' => 'Reliability', 'body' => 'Long-standing brand relationships and a global network that keeps merchandise moving as coordinated.'],
                        ['title' => 'Care', 'body' => 'Responsible management of authorized goods, honoring the agreements and expectations behind every transaction.'],
                    ];
                @endphp

                @foreach ($values as $value)
                    <article class="card hover:border-navy-600/60">
                        <h3 class="font-display text-2xl font-semibold text-ink-950">{{ $value['title'] }}</h3>
                        <p class="mt-4 text-sm leading-relaxed text-ink-800/85">{{ $value['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Boilerplate --}}
    <section class="bg-paper-100/60 pb-20 lg:pb-28">
        <div class="container-page">
            <blockquote class="rounded-3xl border-l-4 border-navy-500 bg-white p-8 lg:p-12">
                <p class="display text-xl leading-relaxed text-ink-900 lg:text-2xl">
                    &ldquo;{{ config('bfern.boilerplate') }}&rdquo;
                </p>
            </blockquote>
        </div>
    </section>

    @include('partials.cta', [
        'title' => 'Work with an experienced apparel partner',
        'description' => 'Talk to our team about sourcing, liquidation, or building an authorized brand relationship.',
    ])
@endsection
