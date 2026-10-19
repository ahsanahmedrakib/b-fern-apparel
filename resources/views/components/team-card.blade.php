@props(['member'])

<article class="group flex h-full flex-col overflow-hidden rounded-2xl border border-paper-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-navy-500/40 hover:shadow-xl hover:shadow-ink-950/5">
    <div class="relative aspect-4/5 w-full overflow-hidden bg-paper-100">
        <img
            src="{{ $member->photoUrl() }}"
            alt="Portrait of {{ $member->name }}"
            loading="lazy"
            class="size-full object-cover object-top transition duration-500 group-hover:scale-105"
        >
    </div>

    <div class="flex flex-1 flex-col justify-center p-5 text-center">
        <h3 class="font-display text-lg font-semibold text-ink-950">{{ $member->name }}</h3>
        <p class="mt-1.5 text-xs font-semibold uppercase tracking-[0.18em] text-navy-600">{{ $member->position }}</p>
    </div>
</article>
