@extends('layouts.admin')

@section('title', 'Message from '.$message->name)
@section('heading', 'Message details')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.messages.index') }}" class="link-arrow text-sm">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6-6-6 6-6" />
            </svg>
            All messages
        </a>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Message body --}}
        <article class="rounded-2xl border border-paper-200 bg-paper-50 lg:col-span-2">
            <header class="border-b border-paper-200 p-6">
                <div class="flex flex-wrap items-center gap-3">
                    <h2 class="font-display text-2xl font-semibold text-ink-950">{{ $message->name }}</h2>
                    <span class="rounded-full bg-paper-200 px-3 py-1 text-xs font-medium text-ink-800">{{ $message->subjectLabel() }}</span>
                    @if ($message->isRead())
                        <span class="rounded-full bg-paper-200 px-3 py-1 text-xs font-medium text-ink-800/70">Read</span>
                    @else
                        <span class="rounded-full bg-navy-600/15 px-3 py-1 text-xs font-semibold text-navy-700">Unread</span>
                    @endif
                </div>
                <p class="mt-2 text-sm text-ink-800/70">
                    Received {{ $message->created_at->format('F j, Y \a\t g:i A') }}
                </p>
            </header>

            <div class="p-6">
                <p class="whitespace-pre-line text-base leading-relaxed text-ink-800">{{ $message->message }}</p>
            </div>
        </article>

        {{-- Sender + actions --}}
        <aside class="space-y-6">
            <div class="rounded-2xl border border-paper-200 bg-paper-50 p-6">
                <h2 class="text-xs font-semibold uppercase tracking-[0.18em] text-ink-800/60">Sender</h2>
                <dl class="mt-4 space-y-4 text-sm">
                    <div>
                        <dt class="font-semibold text-ink-900">Name</dt>
                        <dd class="mt-0.5 text-ink-800">{{ $message->name }}</dd>
                    </div>
                    <div>
                        <dt class="font-semibold text-ink-900">Email</dt>
                        <dd class="mt-0.5">
                            <a href="mailto:{{ $message->email }}" class="text-navy-700 hover:text-navy-600">{{ $message->email }}</a>
                        </dd>
                    </div>
                    @if ($message->company)
                        <div>
                            <dt class="font-semibold text-ink-900">Company</dt>
                            <dd class="mt-0.5 text-ink-800">{{ $message->company }}</dd>
                        </div>
                    @endif
                    @if ($message->phone)
                        <div>
                            <dt class="font-semibold text-ink-900">Phone</dt>
                            <dd class="mt-0.5 text-ink-800">{{ $message->phone }}</dd>
                        </div>
                    @endif
                </dl>

                <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subjectLabel()) }}" class="btn btn-primary mt-6 w-full">
                    Reply by email
                </a>
            </div>

            <div class="rounded-2xl border border-paper-200 bg-paper-50 p-6">
                <h2 class="text-xs font-semibold uppercase tracking-[0.18em] text-ink-800/60">Actions</h2>
                <div class="mt-4 space-y-3">
                    <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-full">
                            {{ $message->isRead() ? 'Mark as unread' : 'Mark as read' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message permanently?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn w-full border border-red-200 text-red-700 hover:bg-red-50">
                            Delete message
                        </button>
                    </form>
                </div>
            </div>
        </aside>
    </div>
@endsection
