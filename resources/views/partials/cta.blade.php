@php
    $ctaTitle = $title ?? 'Let\'s talk merchandise';
    $ctaDescription = $description ?? 'Whether you are sourcing apparel or looking to move inventory, our team is ready to help.';
    $ctaButton = $button ?? 'Contact Our Team';
@endphp

<section class="relative overflow-hidden bg-navy-700 text-paper-50">
    <div class="pointer-events-none absolute -right-24 -top-24 size-80 rounded-full bg-paper-50/10 blur-3xl" aria-hidden="true"></div>

    <div class="container-page relative flex flex-col items-start gap-8 py-16 lg:flex-row lg:items-center lg:justify-between lg:py-20" data-reveal>
        <div class="max-w-2xl">
            <h2 class="display text-3xl text-white sm:text-4xl">{{ $ctaTitle }}</h2>
            <p class="mt-4 text-base leading-relaxed text-paper-100/85">{{ $ctaDescription }}</p>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('contact.index') }}" class="btn btn-light group">
                {{ $ctaButton }}
                <svg class="size-4 transition-transform duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                </svg>
            </a>
            <a href="{{ route('services') }}" class="btn btn-outline-light">What We Do</a>
        </div>
    </div>
</section>
