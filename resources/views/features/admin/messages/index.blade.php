@extends('layouts.admin')

@section('title', 'Messages')
@section('heading', 'Contact messages')

@section('content')
    {{-- Filters --}}
    <form method="GET" action="{{ route('admin.messages.index') }}" class="flex flex-col gap-3 rounded-2xl border border-paper-200 bg-paper-50 p-4 lg:flex-row lg:items-center">
        <div class="flex-1">
            <label for="search" class="sr-only">Search messages</label>
            <input
                type="search"
                name="search"
                id="search"
                value="{{ $filters['search'] }}"
                placeholder="Search name, email, company, or message…"
                class="field"
            >
        </div>

        <div class="flex flex-wrap items-center gap-3">
            <label for="subject" class="sr-only">Filter by topic</label>
            <select name="subject" id="subject" class="field lg:w-52">
                <option value="">All topics</option>
                @foreach ($subjects as $key => $label)
                    <option value="{{ $key }}" @selected($filters['subject'] === $key)>{{ $label }}</option>
                @endforeach
            </select>

            <label class="inline-flex items-center gap-2 text-sm text-ink-800">
                <input type="hidden" name="unread_only" value="0">
                <input type="checkbox" name="unread_only" value="1" class="size-4 rounded border-paper-300 text-navy-700 focus:ring-navy-600" @checked($filters['unread_only'])>
                Unread only
            </label>

            <button type="submit" class="btn btn-primary px-5 py-2.5 text-sm">Filter</button>

            @if ($filters['search'] || $filters['subject'] || $filters['unread_only'])
                <a href="{{ route('admin.messages.index') }}" class="text-sm font-medium text-ink-800/70 hover:text-ink-950">Clear</a>
            @endif
        </div>
    </form>

    <p class="mt-4 text-sm text-ink-800/70">
        {{ $messages->total() }} {{ Str::plural('message', $messages->total()) }}
        @if ($unreadMessages > 0)
            &middot; <span class="font-semibold text-navy-700">{{ $unreadMessages }} unread</span>
        @endif
    </p>

    {{-- List --}}
    <div class="mt-4 overflow-hidden rounded-2xl border border-paper-200 bg-paper-50">
        @forelse ($messages as $message)
            <article @class([
                'flex flex-col gap-4 border-b border-paper-200 p-5 last:border-b-0 sm:flex-row sm:items-start',
                'bg-navy-600/[0.04]' => ! $message->isRead(),
            ])>
                <span @class([
                    'mt-1.5 hidden size-2.5 shrink-0 rounded-full sm:block',
                    'bg-navy-500' => ! $message->isRead(),
                    'bg-paper-300' => $message->isRead(),
                ]) aria-hidden="true"></span>

                <div class="min-w-0 flex-1">
                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1">
                        <a href="{{ route('admin.messages.show', $message) }}" @class([
                            'text-base',
                            'font-semibold text-ink-950' => ! $message->isRead(),
                            'font-medium text-ink-900' => $message->isRead(),
                        ])>{{ $message->name }}</a>

                        <span class="rounded-full bg-paper-200 px-2.5 py-0.5 text-xs font-medium text-ink-800">{{ $message->subjectLabel() }}</span>

                        <span class="text-xs text-ink-800/60">{{ $message->created_at->format('M j, Y · g:i A') }}</span>
                    </div>

                    <p class="mt-1 truncate text-sm text-ink-800/80">
                        {{ $message->email }}
                        @if ($message->company)
                            &middot; {{ $message->company }}
                        @endif
                    </p>

                    <p class="mt-2 line-clamp-2 text-sm text-ink-800/70">{{ $message->message }}</p>
                </div>

                <div class="flex shrink-0 items-center gap-2">
                    <a href="{{ route('admin.messages.show', $message) }}" class="rounded-lg border border-paper-300 px-3 py-1.5 text-xs font-medium text-ink-800 transition hover:border-ink-950/40">
                        View
                    </a>

                    <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                        @csrf
                        <button type="submit" class="rounded-lg border border-paper-300 px-3 py-1.5 text-xs font-medium text-ink-800 transition hover:border-ink-950/40">
                            {{ $message->isRead() ? 'Mark unread' : 'Mark read' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message permanently?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-medium text-red-700 transition hover:bg-red-50">
                            Delete
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="p-10 text-center">
                <p class="font-display text-lg text-ink-950">No messages found</p>
                <p class="mt-2 text-sm text-ink-800/70">
                    @if ($filters['search'] || $filters['subject'] || $filters['unread_only'])
                        Try clearing your filters.
                    @else
                        New website inquiries will appear here.
                    @endif
                </p>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $messages->links('vendor.pagination.admin') }}
    </div>
@endsection
