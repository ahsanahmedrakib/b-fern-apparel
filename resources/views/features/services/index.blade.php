@extends('layouts.app')

@section('title', 'What We Do')

@section('description', 'Apparel liquidation, authorized overseas purchasing, and full-category coverage in men\'s, women\'s, and children\'s knit and woven garments.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'What We Do',
        'title' => 'Apparel liquidation, done responsibly',
        'description' => 'For more than 20 years we have connected leading brands with buyers — purchasing merchandise overseas under authorization, and coordinating its movement across international markets.',
    ])

    {{-- Core services --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page space-y-16 lg:space-y-24" data-reveal>
            <article class="grid gap-10 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-5">
                    <span class="eyebrow text-navy-600">01 &middot; Liquidation</span>
                    <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                        Connecting leading brands with buyers
                    </h2>
                </div>
                <div class="lg:col-span-7">
                    <p class="text-lg leading-relaxed text-ink-800/90">
                        As one of the largest apparel liquidators in the United States, we help brands move closeouts,
                        excess inventory, and overstock to the right buyers — quickly, quietly, and with the
                        professionalism the apparel market expects.
                    </p>
                    <ul class="mt-8 grid gap-4 sm:grid-cols-2">
                        @foreach (['Closeouts & overstock', 'Seasonal excess inventory', 'Department store & retail goods', 'Program-based merchandise'] as $item)
                            <li class="flex items-start gap-3 text-sm text-ink-800/90">
                                <span class="mt-1 grid size-5 shrink-0 place-items-center rounded-full bg-navy-700/10 text-navy-700">
                                    <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m5 12.5 4.5 4.5L19 7" />
                                    </svg>
                                </span>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </article>

            <article class="grid gap-10 lg:grid-cols-12 lg:gap-16">
                <div class="lg:col-span-5">
                    <span class="eyebrow text-navy-600">02 &middot; Authorized Purchasing</span>
                    <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                        Purchasing overseas for {{ config('bfern.brands_count') }} brands
                    </h2>
                </div>
                <div class="lg:col-span-7">
                    <p class="text-lg leading-relaxed text-ink-800/90">
                        We purchase merchandise overseas for 50 brands under formal agreements. Brand release letters
                        accompany these transactions, providing the necessary authorization for the goods we handle and
                        reflecting the trust brands place in our process.
                    </p>
                    <div class="mt-8 rounded-2xl border border-paper-200 bg-paper-100/70 p-6">
                        <p class="text-sm font-semibold uppercase tracking-[0.18em] text-navy-600">Authorization</p>
                        <p class="mt-3 text-sm leading-relaxed text-ink-800/90">
                            Every transaction is documented. Brand release letters travel with the merchandise, so
                            buyers and partners always know the goods they receive are properly authorized.
                        </p>
                    </div>
                </div>
            </article>
        </div>
    </section>

    {{-- Product categories --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-paper-100 weave-pattern lg:py-28">
        <div class="pointer-events-none absolute -left-24 top-10 size-96 rounded-full bg-navy-600/20 blur-3xl" aria-hidden="true"></div>

        <div class="container-page relative" data-reveal>
            <div class="max-w-2xl">
                <p class="eyebrow text-navy-300">Product Coverage</p>
                <h2 class="display mt-5 text-3xl leading-tight text-paper-50 sm:text-4xl">
                    Men's, women's, and children's — knit and woven
                </h2>
                <p class="mt-6 text-base leading-relaxed text-paper-300/85">
                    Our broad product experience allows us to serve a diverse range of market segments and customer
                    needs across both knit and woven constructions.
                </p>
            </div>

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $groups = [
                        ['title' => 'Men\'s Apparel', 'body' => 'Knit and woven programs across tops, bottoms, and outerwear.'],
                        ['title' => 'Women\'s Apparel', 'body' => 'Broad assortments spanning knit and woven categories.'],
                        ['title' => 'Children\'s Apparel', 'body' => 'Kidswear programs covering everyday and seasonal goods.'],
                        ['title' => 'Knit Garments', 'body' => 'Jersey, fleece, and knit constructions across categories.'],
                        ['title' => 'Woven Garments', 'body' => 'Wovens including bottoms, shirting, and structured pieces.'],
                    ];
                @endphp

                @foreach ($groups as $group)
                    <article class="card-dark border-paper-100/15 bg-paper-100/[0.05] hover:border-navy-300/40">
                        <h3 class="font-display text-xl font-semibold text-paper-50">{{ $group['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-paper-300/80">{{ $group['body'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Process --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page">
            <div class="max-w-2xl" data-reveal>
                <p class="eyebrow text-navy-600">Our Approach</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    How we coordinate each opportunity
                </h2>
            </div>

            <ol class="mt-14 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $steps = [
                        ['title' => 'Brand authorization', 'body' => 'We work within formal agreements, with brand release letters documenting each transaction.'],
                        ['title' => 'Overseas purchasing', 'body' => 'Merchandise is purchased overseas through our established brand relationships.'],
                        ['title' => 'Global coordination', 'body' => 'Our international offices coordinate the movement of goods across markets.'],
                        ['title' => 'Buyer fulfillment', 'body' => 'Authorized goods reach the right buyers, handled with professionalism and care.'],
                    ];
                @endphp

                @foreach ($steps as $index => $step)
                    <li class="border-t-2 border-paper-300 pt-6">
                        <span class="font-display text-sm font-semibold text-navy-600">Step {{ $index + 1 }}</span>
                        <h3 class="mt-3 font-display text-xl font-semibold text-ink-950">{{ $step['title'] }}</h3>
                        <p class="mt-3 text-sm leading-relaxed text-ink-800/85">{{ $step['body'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    @include('partials.cta', [
        'title' => 'Have apparel programs to move?',
        'description' => 'Tell us about your merchandise and we will follow up with the right next step.',
    ])
@endsection
