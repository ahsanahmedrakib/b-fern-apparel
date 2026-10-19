@extends('layouts.admin')

@section('title', 'Add team member')
@section('heading', 'Add team member')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.team.index') }}" class="link-arrow text-sm">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m6 6-6-6 6-6" />
            </svg>
            All team members
        </a>
    </div>

    @include('features.admin.team._form', ['teamMember' => $teamMember])
@endsection
