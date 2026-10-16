@php
    $eyebrow = $eyebrow ?? null;
    $title = $title ?? '';
    $description = $description ?? null;
@endphp

<section class="relative overflow-hidden bg-ink-950 text-paper-100 weave-pattern">
    <div class="pointer-events-none absolute -right-24 -top-32 size-96 rounded-full bg-navy-600/20 blur-3xl" aria-hidden="true"></div>
    <div class="pointer-events-none absolute -bottom-40 left-1/4 size-80 rounded-full bg-navy-500/10 blur-3xl" aria-hidden="true"></div>

    <div class="container-page relative py-20 lg:py-28">
        <div class="max-w-3xl fade-up">
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
    </div>
</section>
