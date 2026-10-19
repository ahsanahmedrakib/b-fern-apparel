<?php
    $member = $member ?? null;
    $preview = $preview ?? false;
?>

<div>
    <label for="{{ $preview ? 'edit-name' : 'create-name' }}" class="block text-sm font-semibold text-ink-900">
        Name <span class="text-red-600" aria-hidden="true">*</span>
    </label>
    <input
        type="text"
        name="name"
        id="{{ $preview ? 'edit-name' : 'create-name' }}"
        value="{{ old('name', $member?->name) }}"
        class="field mt-2 @error('name') field-error @enderror"
        data-autofocus
        required
    >
    @error('name')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="{{ $preview ? 'edit-position' : 'create-position' }}" class="block text-sm font-semibold text-ink-900">
        Position <span class="text-red-600" aria-hidden="true">*</span>
    </label>
    <input
        type="text"
        name="position"
        id="{{ $preview ? 'edit-position' : 'create-position' }}"
        value="{{ old('position', $member?->position ?: 'QC Staffs') }}"
        class="field mt-2 @error('position') field-error @enderror"
        required
    >
    @error('position')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="{{ $preview ? 'edit-photo' : 'create-photo' }}" class="block text-sm font-semibold text-ink-900">
        Photo @unless ($preview)<span class="text-red-600" aria-hidden="true">*</span>@endunless
    </label>

    @if ($preview)
        <div data-photo-preview-wrap @class(['mt-3 flex items-center gap-4', 'hidden' => ! $member])>
            <img data-photo-preview src="{{ $member?->photoUrl() }}" alt="" class="size-16 rounded-xl object-cover object-top">
            <p class="text-xs text-ink-800/70">Current photo. Upload a new file to replace it.</p>
        </div>
    @endif

    <input
        type="file"
        name="photo"
        id="{{ $preview ? 'edit-photo' : 'create-photo' }}"
        accept="image/jpeg,image/png,image/webp"
        class="mt-3 block w-full text-sm text-ink-800 file:mr-4 file:rounded-full file:border-0 file:bg-navy-700 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-paper-50 hover:file:bg-navy-600"
        @unless ($preview) required @endunless
    >
    <p class="mt-2 text-xs text-ink-800/70">JPG, PNG, or WebP. Maximum 4 MB.</p>
    @error('photo')
        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
