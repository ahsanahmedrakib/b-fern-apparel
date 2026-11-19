@php
    $eyebrow = $eyebrow ?? null;
    $title = $title ?? '';
    $description = $description ?? null;
    $image = $image ?? null;
    $imageAlt = $imageAlt ?? $title;
@endphp

<section class="relative overflow-hidden bg-ink-950 text-paper-100 weave-pattern">
    <div class="pointer-events-none absolute -right-24 -top-32 size-96 rounded-full bg-navy-600/20 blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-40 left-1/4 size-80 rounded-full bg-navy-500/10 blur-3xl" aria-hidden="true"></div>

    <div class="container-page relative py-20 lg:py-28">
        <div @class(['grid items-center gap-12', 'lg:grid-cols-12 lg:gap-16' => $image])>
            <div @class(['max-w-3xl', 'lg:col-span-7' => $image]) data-reveal>
                @if ($eyebrow)
                    <p class="eyebrow text-navy-300">{{ $eyebrow }}</p>
                @endif

                <h1 class="display mt-5 text-4xl leading-[1.05] text-paper-50 sm:text-5xl lg:text-6xl">
                    {{ $title }}
                </h1>

                @if ($description)
                    <p class="mt-6 max-w-2xl text-lg leading-relaxed text-paper-300/85">
                        {{ $description }}
                    </p>
                @endif
            </div>

            @if ($image)
                <div class="lg:col-span-5" data-reveal="right">
                    <div class="relative overflow-hidden rounded-3xl border border-paper-100/15 shadow-2xl shadow-ink-950/40">
                        <img
                            src="{{ asset($image) }}"
                            alt="{{ $imageAlt }}"
                            class="aspect-4/3 w-full object-cover"
                            fetchpriority="high"
                        >
                        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-ink-950/40 via-transparent to-transparent" aria-hidden="true"></div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
