@if ($teamMembers->isNotEmpty())
    <section class="border-y border-paper-200 bg-paper-100/60 py-20 lg:py-28">
        <div class="container-page">
            <div class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between" data-reveal>
                <div class="max-w-2xl">
                    <p class="eyebrow text-navy-600">Our People</p>
                    <h2 class="display mt-5 text-3xl leading-tight text-ink-950 sm:text-4xl">
                        The team behind every shipment
                    </h2>
                </div>

                <a href="{{ route('team') }}" class="link-arrow shrink-0">
                    Meet the full team
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                    </svg>
                </a>
            </div>

            <div class="mt-12" data-team-swiper>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        @foreach ($teamMembers as $member)
                            <div class="swiper-slide h-auto">
                                <x-team-card :member="$member" />
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mt-8 flex items-center justify-center gap-5">
                    <button
                        type="button"
                        data-team-prev
                        class="grid size-10 shrink-0 place-items-center rounded-full border border-paper-300 text-ink-800 transition hover:border-navy-500/50 hover:text-navy-700 disabled:pointer-events-none disabled:opacity-40"
                        aria-label="Previous team members"
                    >
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6-6-6 6-6" />
                        </svg>
                    </button>

                    <div data-team-pagination class="flex min-w-0 flex-1 items-center justify-center gap-2"></div>

                    <button
                        type="button"
                        data-team-next
                        class="grid size-10 shrink-0 place-items-center rounded-full border border-paper-300 text-ink-800 transition hover:border-navy-500/50 hover:text-navy-700 disabled:pointer-events-none disabled:opacity-40"
                        aria-label="Next team members"
                    >
                        <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endif
