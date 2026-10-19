@extends('layouts.admin')

@section('title', 'Team')
@section('heading', 'Team members')

@php
    $openModal = $errors->any() ? ($editingMember ? 'edit' : 'create') : null;
@endphp

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-4">
        <p class="text-sm text-ink-800/70">
            {{ $teamMembers->total() }} {{ Str::plural('member', $teamMembers->total()) }} shown on the website.
        </p>

        <button type="button" data-team-create class="btn btn-primary px-5 py-2.5 text-sm">Add team member</button>
    </div>

    <div class="mt-4 overflow-hidden rounded-2xl border border-paper-200 bg-paper-50">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[640px] text-left text-sm">
                <thead class="border-b border-paper-200 bg-paper-100/60 text-xs uppercase tracking-[0.14em] text-ink-800/70">
                    <tr>
                        <th scope="col" class="px-5 py-3 font-semibold">Member</th>
                        <th scope="col" class="px-5 py-3 font-semibold">Position</th>
                        <th scope="col" class="px-5 py-3 font-semibold">Added</th>
                        <th scope="col" class="px-5 py-3 text-right font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-paper-200">
                    @forelse ($teamMembers as $member)
                        <tr>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $member->photoUrl() }}" alt="" class="size-10 shrink-0 rounded-lg object-cover object-top">
                                    <span class="font-medium text-ink-950">{{ $member->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="rounded-full bg-paper-200 px-2.5 py-0.5 text-xs font-medium text-ink-800">{{ $member->position }}</span>
                            </td>
                            <td class="px-5 py-4 text-ink-800/70">{{ $member->created_at->format('M j, Y') }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button
                                        type="button"
                                        data-team-edit
                                        data-id="{{ $member->id }}"
                                        data-name="{{ $member->name }}"
                                        data-position="{{ $member->position }}"
                                        data-photo="{{ $member->photoUrl() }}"
                                        data-update-url="{{ route('admin.team.update', $member) }}"
                                        class="rounded-lg border border-paper-300 px-3 py-1.5 text-xs font-medium text-ink-800 transition hover:border-ink-950/40"
                                    >
                                        Edit
                                    </button>

                                    <form method="POST" action="{{ route('admin.team.destroy', $member) }}" onsubmit="return confirm('Remove this team member from the website?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-medium text-red-700 transition hover:bg-red-50">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-10 text-center">
                                <p class="font-display text-lg text-ink-950">No team members yet</p>
                                <p class="mt-2 text-sm text-ink-800/70">Add your first team member to feature them on the site.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $teamMembers->links('vendor.pagination.admin') }}
    </div>

    {{-- Create modal --}}
    <div
        id="team-create-modal"
        data-modal
        data-auto-open="{{ $openModal === 'create' ? 'true' : 'false' }}"
        class="fixed inset-0 z-50 hidden items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="team-create-title"
    >
        <div class="absolute inset-0 bg-ink-950/60" data-modal-close></div>

        <div class="relative z-10 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl border border-paper-200 bg-paper-50 p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 id="team-create-title" class="font-display text-xl font-semibold text-ink-950">Add team member</h2>
                    <p class="mt-1 text-sm text-ink-800/70">They will appear on the team section and team page.</p>
                </div>
                <button type="button" data-modal-close class="grid size-8 shrink-0 place-items-center rounded-full border border-paper-300 text-ink-800 transition hover:bg-paper-200" aria-label="Close">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                    </svg>
                </button>
            </div>

            <form method="POST" action="{{ route('admin.team.store') }}" enctype="multipart/form-data" class="mt-6 space-y-5">
                @csrf
                @include('features.admin.team._fields', ['member' => null, 'preview' => false])

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <button type="submit" class="btn btn-primary">Add team member</button>
                    <button type="button" data-modal-close class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit modal --}}
    <div
        id="team-edit-modal"
        data-modal
        data-auto-open="{{ $openModal === 'edit' ? 'true' : 'false' }}"
        class="fixed inset-0 z-50 hidden items-center justify-center p-4"
        role="dialog"
        aria-modal="true"
        aria-labelledby="team-edit-title"
    >
        <div class="absolute inset-0 bg-ink-950/60" data-modal-close></div>

        <div class="relative z-10 max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-2xl border border-paper-200 bg-paper-50 p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 id="team-edit-title" class="font-display text-xl font-semibold text-ink-950">Edit team member</h2>
                    <p class="mt-1 text-sm text-ink-800/70">Update their details or replace the photo.</p>
                </div>
                <button type="button" data-modal-close class="grid size-8 shrink-0 place-items-center rounded-full border border-paper-300 text-ink-800 transition hover:bg-paper-200" aria-label="Close">
                    <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6l12 12M18 6 6 18" />
                    </svg>
                </button>
            </div>

            <form
                method="POST"
                action="{{ $editingMember ? route('admin.team.update', $editingMember) : '#' }}"
                enctype="multipart/form-data"
                class="mt-6 space-y-5"
            >
                @csrf
                @method('PUT')
                <input type="hidden" name="team_member_id" value="{{ old('team_member_id', $editingMember?->id) }}">

                @include('features.admin.team._fields', ['member' => $editingMember, 'preview' => true])

                <div class="flex flex-wrap items-center gap-3 pt-1">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" data-modal-close class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
@endsection
