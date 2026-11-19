@extends('layouts.app')

@section('title', 'Apparel Liquidation and Brand Partnerships')

@section('description', config('bfern.short_description'))

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-ink-950 text-paper-100 weave-pattern">
        <div class="pointer-events-none absolute -right-40 -top-40 size-128 rounded-full bg-navy-600/25 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -bottom-52 -left-24 size-112 rounded-full bg-navy-500/10 blur-3xl" aria-hidden="true"></div>

        <div class="container-page relative grid items-center gap-16 py-20 lg:grid-cols-12 lg:py-28">
            <div class="lg:col-span-7" data-reveal>
                <p class="eyebrow text-navy-300">Established Apparel Liquidators &middot; 20+ Years</p>

                <h1 class="display mt-6 text-4xl leading-[1.05] text-paper-50 sm:text-5xl lg:text-[3.75rem]">
                    A Leading Name in<br class="hidden sm:block">
                    Apparel Liquidation
                </h1>

                <p class="mt-7 max-w-xl text-lg leading-relaxed text-paper-300/85">
                    For more than two decades, B.Fern Apparel has connected leading brands with buyers in the apparel
                    market — supported by authorized brand relationships, deep industry experience, and an
                    international operating network.
                </p>

                <div class="mt-9 flex flex-wrap gap-3">
                    <a href="{{ route('contact.index') }}" class="btn btn-light">
                        Partner With Us
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </a>
                    <a href="{{ route('services') }}" class="btn btn-outline-light">Explore What We Do</a>
                </div>
            </div>

            <div class="lg:col-span-5">
                <figure class="relative overflow-hidden rounded-3xl border border-paper-100/15 shadow-2xl shadow-ink-950/40" data-reveal="right">
                    <img
                        src="{{ asset('images/site/showroom-interior.jpg') }}"
                        alt="Apparel showroom with garments hanging on display rails at B.Fern Apparel"
                        class="aspect-4/3 w-full object-cover"
                        fetchpriority="high"
                    >
                    <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink-950/85 via-ink-950/30 to-transparent px-6 pb-5 pt-16 text-xs font-semibold uppercase tracking-[0.18em] text-paper-200">
                        New York Showroom &middot; 525 Seventh Avenue
                    </figcaption>
                </figure>

                <div class="mt-4 grid grid-cols-2 gap-4">
                    @foreach (config('bfern.stats') as $stat)
                        <div class="card-dark border-paper-100/15 bg-paper-100/6 backdrop-blur" data-reveal="up">
                            <p class="font-display text-4xl font-semibold text-paper-50">{{ $stat['value'] }}</p>
                            <p class="mt-2 text-sm leading-snug text-paper-300/80">{{ $stat['label'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Category strip --}}
        <div class="relative border-t border-paper-100/10">
            <div class="container-page flex flex-wrap items-center gap-x-8 gap-y-3 py-5">
                @foreach (config('bfern.product_categories') as $category)
                    <span class="inline-flex items-center gap-3 text-xs font-semibold uppercase tracking-[0.2em] text-paper-300/70" data-reveal="up">
                        <span class="size-1 rounded-full bg-navy-300" aria-hidden="true"></span>
                        {{ $category }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About preview --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page grid items-center gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-6" data-reveal="left">
                <div class="grid grid-cols-2 gap-4">
                    <figure class="col-span-2 overflow-hidden rounded-3xl">
                        <img
                            src="{{ asset('images/site/boutique-racks.jpg') }}"
                            alt="Curated apparel on display rails in the B.Fern Apparel showroom"
                            class="aspect-16/10 w-full object-cover"
                            loading="lazy"
                        >
                    </figure>
                    <figure class="overflow-hidden rounded-2xl">
                        <img
                            src="{{ asset('images/site/clothing-racks.jpg') }}"
                            alt="Colorful garments arranged on racks"
                            class="aspect-square w-full object-cover"
                            loading="lazy"
                        >
                    </figure>
                    <figure class="overflow-hidden rounded-2xl">
                        <img
                            src="{{ asset('images/site/warehouse-team.jpg') }}"
                            alt="Warehouse team preparing apparel shipments"
                            class="aspect-square w-full object-cover"
                            loading="lazy"
                        >
                    </figure>
                </div>
            </div>

            <div class="lg:col-span-6" data-reveal="right">
                <p class="eyebrow text-navy-600">Who We Are</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    Two decades of trusted partnerships in apparel
                </h2>

                <div class="mt-6 space-y-5 text-base leading-relaxed text-ink-800/90">
                    <p>
                        Over more than 20 years, we have built a reputation as one of the largest apparel liquidators
                        in the United States, supported by deep industry experience, long-standing relationships, and a
                        strong international presence.
                    </p>
                    <p>
                        We work with 50 brands under agreements authorizing us to purchase their merchandise overseas.
                        Brand release letters accompany these transactions, providing the necessary authorization for
                        the goods we handle.
                    </p>
                    <p>
                        Across men's, women's, and children's apparel — both knit and woven — our broad product
                        experience allows us to serve a diverse range of market segments and customer needs.
                    </p>
                </div>

                <a href="{{ route('about') }}" class="link-arrow mt-8">
                    Read our story
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    {{-- What we do --}}
    <section class="border-y border-paper-200 bg-paper-100/60 py-20 lg:py-28">
        <div class="container-page">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <p class="eyebrow text-navy-600">What We Do</p>
                    <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                        Responsible, authorized movement of apparel merchandise
                    </h2>
                </div>
                <a href="{{ route('services') }}" class="link-arrow shrink-0">
                    View all services
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>

            <div class="mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $services = [
                        [
                            'title' => 'Authorized Purchasing',
                            'body' => 'We purchase merchandise overseas for 50 brands under formal agreements, with brand release letters accompanying every transaction.',
                            'icon' => 'badge',
                            'image' => 'images/site/textile-factory.jpg',
                            'alt' => 'Garment production line preparing apparel for authorized overseas purchasing',
                        ],
                        [
                            'title' => 'Apparel Liquidation',
                            'body' => 'Two decades of connecting leading brands with buyers, moving closeouts and excess inventory with professionalism and care.',
                            'icon' => 'boxes',
                            'image' => 'images/site/warehouse-team.jpg',
                            'alt' => 'Warehouse team carrying boxes of apparel ready for liquidation',
                        ],
                        [
                            'title' => 'Full Category Coverage',
                            'body' => 'Men\'s, women\'s, and children\'s apparel across a diverse range of market segments and customer needs.',
                            'icon' => 'shirt',
                            'image' => 'images/site/clothing-racks.jpg',
                            'alt' => 'Assorted men\'s, women\'s, and children\'s apparel on rails',
                        ],
                        [
                            'title' => 'Knit & Woven Expertise',
                            'body' => 'Broad product experience in knit and woven garments, giving us the range to serve varied programs.',
                            'icon' => 'thread',
                            'image' => 'images/site/coat-rack.jpg',
                            'alt' => 'Close-up of knit and woven garments on wooden hangers',
                        ],
                    ];
                @endphp

                @foreach ($services as $service)
                    <article class="group flex flex-col overflow-hidden rounded-2xl border border-paper-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-navy-600/60 hover:shadow-lg hover:shadow-ink-950/5" data-reveal="up">
                        <div class="relative aspect-16/10 overflow-hidden bg-paper-100">
                            <img
                                src="{{ asset($service['image']) }}"
                                alt="{{ $service['alt'] }}"
                                class="size-full object-cover transition duration-500 group-hover:scale-105"
                                loading="lazy"
                            >
                            <span class="absolute -bottom-5 left-6 grid size-11 place-items-center rounded-full bg-white text-navy-700 shadow-md shadow-ink-950/10">
                                @if ($service['icon'] === 'badge')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.5 11 14.5 15 10m-3-7 6.5 3v5.2c0 4-2.8 7-6.5 8.3-3.7-1.3-6.5-4.3-6.5-8.3V6L12 3Z" />
                                    </svg>
                                @elseif ($service['icon'] === 'boxes')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.5 7.5 12 3l8.5 4.5v9L12 21l-8.5-4.5v-9Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.5 7.5 12 12l8.5-4.5M12 12v9" />
                                    </svg>
                                @elseif ($service['icon'] === 'shirt')
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 3.5 12 6l3-2.5 4 2.5v4l-2 .8V20H7V10.8L5 10V6l4-2.5Z" />
                                    </svg>
                                @else
                                    <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                                        <circle cx="12" cy="12" r="8.2" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3.8c2.6 2.2 4 5 4 8.2s-1.4 6-4 8.2c-2.6-2.2-4-5-4-8.2s1.4-6 4-8.2Zm-8.2 8.2h16.4" />
                                    </svg>
                                @endif
                            </span>
                        </div>

                        <div class="flex flex-1 flex-col p-6 pt-9">
                            <h3 class="font-display text-xl font-semibold text-ink-950">{{ $service['title'] }}</h3>
                            <p class="mt-3 text-sm leading-relaxed text-ink-800/85">{{ $service['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Global network --}}
    <section class="relative overflow-hidden bg-ink-950 py-20 text-paper-100 weave-pattern lg:py-28">
        <div class="pointer-events-none absolute -left-32 top-1/3 size-96 rounded-full bg-navy-600/20 blur-3xl" aria-hidden="true"></div>

        <div class="container-page relative grid gap-14 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-5" data-reveal="left">
                <p class="eyebrow text-navy-300">Global Presence</p>
                <h2 class="display mt-5 text-3xl leading-tight text-paper-50 sm:text-4xl">
                    An international network that supports every transaction
                </h2>
                <p class="mt-6 text-base leading-relaxed text-paper-300/85">
                    With offices across Asia, North Africa, the Middle East, and Africa, we maintain an international
                    network that supports our operations and partnerships worldwide.
                </p>
                <a href="{{ route('locations') }}" class="link-arrow mt-8 text-navy-300 hover:text-navy-400">
                    See where we operate
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>

            <div class="lg:col-span-7">
                <ul class="grid grid-cols-2 gap-3 sm:grid-cols-3">
                    @foreach (config('bfern.international_offices') as $office)
                        <li class="rounded-2xl border border-paper-100/15 bg-paper-100/5 px-5 py-4" data-reveal="up">
                            <p class="font-display text-lg font-semibold text-paper-50">{{ $office['country'] }}</p>
                            <p class="mt-1 text-xs font-medium uppercase tracking-[0.16em] text-navy-300">{{ $office['region'] }}</p>
                        </li>
                    @endforeach
                    <li class="flex flex-col justify-center rounded-2xl border border-dashed border-navy-300/40 px-5 py-4" data-reveal="up">
                        <p class="font-display text-lg font-semibold text-navy-300">7 offices</p>
                        <p class="mt-1 text-xs font-medium uppercase tracking-[0.16em] text-paper-300/70">Worldwide</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    {{-- U.S. presence --}}
    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page">
            <div class="max-w-2xl" data-reveal>
                <p class="eyebrow text-navy-600">United States</p>
                <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                    A New York showroom and operational hubs on the East Coast
                </h2>
            </div>

            @php
                $locationImages = [
                    ['image' => 'images/site/showroom-interior.jpg', 'alt' => 'Bright apparel showroom interior with garment rails'],
                    ['image' => 'images/site/new-york-skyline.jpg', 'alt' => 'Midtown Manhattan skyline near the B.Fern Apparel office'],
                    ['image' => 'images/site/warehouse-aisle.jpg', 'alt' => 'Organized warehouse aisles holding apparel inventory'],
                ];
            @endphp

            <div class="mt-14 grid gap-5 lg:grid-cols-3">
                @foreach (config('bfern.us_locations') as $index => $location)
                    <article class="group flex flex-col overflow-hidden rounded-2xl border border-paper-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-navy-600/60 hover:shadow-xl hover:shadow-ink-950/5" data-reveal="up">
                        <div class="aspect-16/10 overflow-hidden bg-paper-100">
                            <img
                                src="{{ asset($locationImages[$index]['image']) }}"
                                alt="{{ $locationImages[$index]['alt'] }}"
                                class="size-full object-cover transition duration-500 group-hover:scale-105"
                                loading="lazy"
                            >
                        </div>
                        <div class="flex flex-1 flex-col p-6">
                            <p class="eyebrow text-navy-600">{{ $location['type'] }}</p>
                            <h3 class="mt-3 font-display text-2xl font-semibold text-ink-950">{{ $location['city'] }}</h3>
                            @if ($location['address'])
                                <p class="mt-2 text-sm font-semibold text-navy-700">{{ $location['address'] }}</p>
                            @endif
                            <p class="mt-4 text-sm leading-relaxed text-ink-800/85">{{ $location['description'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Inside the operation --}}
    <section class="border-y border-paper-200 bg-paper-100/60 py-20 lg:py-28">
        <div class="container-page">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <p class="eyebrow text-navy-600">Inside Our Operation</p>
                    <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                        From the showroom floor to the warehouse
                    </h2>
                </div>
                <a href="{{ route('locations') }}" class="link-arrow shrink-0">
                    Explore our locations
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>

            @php
                $gallery = [
                    ['image' => 'images/site/team-meeting.jpg', 'title' => 'Our team', 'caption' => 'Coordinating programs across markets'],
                    ['image' => 'images/site/textile-factory.jpg', 'title' => 'Overseas production', 'caption' => 'Working directly with manufacturing partners'],
                    ['image' => 'images/site/warehouse-aisle.jpg', 'title' => 'Warehouse operations', 'caption' => 'Organized handling and fulfillment'],
                    ['image' => 'images/site/showroom-interior.jpg', 'title' => 'New York showroom', 'caption' => '525 Seventh Avenue, Manhattan'],
                ];
            @endphp

            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($gallery as $shot)
                    <figure class="group relative overflow-hidden rounded-2xl border border-paper-200 bg-ink-950" data-reveal="up">
                        <img
                            src="{{ asset($shot['image']) }}"
                            alt="{{ $shot['title'] }} — {{ $shot['caption'] }}"
                            class="aspect-4/5 w-full object-cover opacity-90 transition duration-500 group-hover:scale-105 group-hover:opacity-100"
                            loading="lazy"
                        >
                        <figcaption class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink-950/90 via-ink-950/35 to-transparent p-5 pt-16">
                            <p class="font-display text-lg font-semibold text-paper-50">{{ $shot['title'] }}</p>
                            <p class="mt-1 text-xs font-medium uppercase tracking-[0.16em] text-paper-300/80">{{ $shot['caption'] }}</p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    @include('features.teams.swiper', ['teamMembers' => $teamMembers])

    @include('partials.cta', [
        'title' => 'Ready to move apparel merchandise?',
        'description' => 'Connect with a team that has spent more than two decades matching leading brands with the right buyers.',
    ])
@endsection
