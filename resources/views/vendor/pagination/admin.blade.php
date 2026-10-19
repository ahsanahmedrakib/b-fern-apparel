@if ($paginator->total() > 0)
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex min-w-9 items-center justify-center rounded-lg border border-paper-200 px-3 py-1.5 text-sm font-medium text-paper-400" aria-disabled="true">
                Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="inline-flex min-w-9 items-center justify-center rounded-lg border border-paper-300 px-3 py-1.5 text-sm font-medium text-ink-800 transition hover:border-ink-950/40">
                Prev
            </a>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="inline-flex min-w-9 items-center justify-center px-2 py-1.5 text-sm text-ink-800/60">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" class="inline-flex min-w-9 items-center justify-center rounded-lg border border-transparent bg-navy-700 px-3 py-1.5 text-sm font-semibold text-paper-50">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="inline-flex min-w-9 items-center justify-center rounded-lg border border-paper-300 px-3 py-1.5 text-sm font-medium text-ink-800 transition hover:border-ink-950/40">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="inline-flex min-w-9 items-center justify-center rounded-lg border border-paper-300 px-3 py-1.5 text-sm font-medium text-ink-800 transition hover:border-ink-950/40">
                Next
            </a>
        @else
            <span class="inline-flex min-w-9 items-center justify-center rounded-lg border border-paper-200 px-3 py-1.5 text-sm font-medium text-paper-400" aria-disabled="true">
                Next
            </span>
        @endif
    </nav>
@endif
