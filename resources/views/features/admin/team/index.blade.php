@extends('layouts.admin')

@section('title', 'Team')
@section('heading', 'Team members')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-ink-800/70">
            {{ $teamMembers->total() }} {{ Str::plural('member', $teamMembers->total()) }} shown on the website.
        </p>

        <a href="{{ route('admin.team.create') }}" class="btn btn-primary px-5 py-2.5 text-sm">Add team member</a>
    </div>

    <div class="mt-4 overflow-hidden rounded-2xl border border-paper-200 bg-paper-50">
        @forelse ($teamMembers as $member)
            <article class="flex flex-col gap-4 border-b border-paper-200 p-5 last:border-b-0 sm:flex-row sm:items-center">
                <img src="{{ $member->photoUrl() }}" alt="{{ $member->name }}" class="size-16 shrink-0 rounded-xl object-cover object-top">

                <div class="min-w-0 flex-1">
                    <h2 class="font-display text-lg font-semibold text-ink-950">{{ $member->name }}</h2>
                    <p class="mt-0.5 text-xs font-semibold uppercase tracking-[0.16em] text-navy-600">{{ $member->position }}</p>
                </div>

                <div class="flex shrink-0 items-center gap-2">
                    <a href="{{ route('admin.team.edit', $member) }}" class="rounded-lg border border-paper-300 px-3 py-1.5 text-xs font-medium text-ink-800 transition hover:border-ink-950/40">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Remove this team member from the website?');">
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
                <p class="font-display text-lg text-ink-950">No team members yet</p>
                <p class="mt-2 text-sm text-ink-800/70">Add your first team member to feature them on the site.</p>
            </div>
        @endforelse
    </div>

    @if ($teamMembers->hasPages())
        <div class="mt-6">
            {{ $teamMembers->links() }}
        </div>
    @endif
@endsection
