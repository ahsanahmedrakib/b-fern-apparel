@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('content')
    <div class="grid gap-5 sm:grid-cols-3">
        @php
            $cards = [
                ['label' => 'Total messages', 'value' => $total],
                ['label' => 'Unread', 'value' => $unread, 'highlight' => $unread > 0],
                ['label' => 'Last 7 days', 'value' => $thisWeek],
            ];
        @endphp

        @foreach ($cards as $card)
            <div @class([
                'rounded-2xl border bg-paper-50 p-6',
                'border-navy-600/30' => $card['highlight'] ?? false,
                'border-paper-200' => ! ($card['highlight'] ?? false),
            ])>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-ink-800/60">{{ $card['label'] }}</p>
                <p class="mt-3 font-display text-4xl font-semibold text-ink-950">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-6 lg:grid-cols-5">
        {{-- Subject breakdown --}}
        <section class="rounded-2xl border border-paper-200 bg-paper-50 p-6 lg:col-span-2">
            <h2 class="font-display text-lg font-semibold text-ink-950">By topic</h2>

            @if ($total === 0)
                <p class="mt-4 text-sm text-ink-800/70">No inquiries yet.</p>
            @else
                <ul class="mt-5 space-y-4">
                    @foreach (config('bfern.contact.subjects') as $key => $label)
                        @php
                            $count = $bySubject[$key] ?? 0;
                            $percent = $total > 0 ? round($count / $total * 100) : 0;
                        @endphp
                        <li>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-ink-800">{{ $label }}</span>
                                <span class="font-semibold text-ink-950">{{ $count }}</span>
                            </div>
                            <div class="mt-2 h-1.5 overflow-hidden rounded-full bg-paper-200">
                                <div class="h-full rounded-full bg-navy-600" style="width: {{ $percent }}%"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>

        {{-- Recent --}}
        <section class="rounded-2xl border border-paper-200 bg-paper-50 p-6 lg:col-span-3">
            <div class="flex items-center justify-between">
                <h2 class="font-display text-lg font-semibold text-ink-950">Recent messages</h2>
                <a href="{{ route('admin.messages.index') }}" class="link-arrow text-sm">View all</a>
            </div>

            @if ($recent->isEmpty())
                <p class="mt-4 text-sm text-ink-800/70">Nothing here yet. New inquiries will appear as they arrive.</p>
            @else
                <ul class="mt-4 divide-y divide-paper-200">
                    @foreach ($recent as $message)
                        <li>
                            <a href="{{ route('admin.messages.show', $message) }}" class="flex items-center gap-4 py-3 transition hover:opacity-80">
                                <span @class([
                                    'size-2 shrink-0 rounded-full',
                                    'bg-navy-500' => ! $message->isRead(),
                                    'bg-paper-300' => $message->isRead(),
                                ]) aria-hidden="true"></span>
                                <span class="min-w-0 flex-1">
                                    <span @class([
                                        'block truncate text-sm',
                                        'font-semibold text-ink-950' => ! $message->isRead(),
                                        'font-medium text-ink-800' => $message->isRead(),
                                    ])>{{ $message->name }}</span>
                                    <span class="block truncate text-xs text-ink-800/70">{{ $message->subjectLabel() }}</span>
                                </span>
                                <span class="shrink-0 text-xs text-ink-800/60">{{ $message->created_at->diffForHumans() }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </section>
    </div>
@endsection
