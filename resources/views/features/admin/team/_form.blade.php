@php
    $isEditing = $teamMember->exists;
@endphp

<form method="POST" action="{{ $isEditing ? route('admin.team.update', $teamMember) : route('admin.team.store') }}" enctype="multipart/form-data" class="max-w-2xl space-y-6 rounded-2xl border border-paper-200 bg-paper-50 p-6">
    @csrf
    @if ($isEditing)
        @method('PUT')
    @endif

    <div>
        <label for="name" class="block text-sm font-semibold text-ink-900">Name <span class="text-red-600" aria-hidden="true">*</span></label>
        <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $teamMember->name) }}"
            class="field mt-2 @error('name') field-error @enderror"
            required
        >
        @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="position" class="block text-sm font-semibold text-ink-900">Position <span class="text-red-600" aria-hidden="true">*</span></label>
        <input
            type="text"
            name="position"
            id="position"
            value="{{ old('position', $teamMember->position ?: 'QC Staffs') }}"
            class="field mt-2 @error('position') field-error @enderror"
            required
        >
        @error('position')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="photo" class="block text-sm font-semibold text-ink-900">
            Photo @if (! $isEditing)<span class="text-red-600" aria-hidden="true">*</span>@endif
        </label>

        @if ($isEditing)
            <div class="mt-3 flex items-center gap-4">
                <img src="{{ $teamMember->photoUrl() }}" alt="{{ $teamMember->name }}" class="size-16 rounded-xl object-cover object-top">
                <p class="text-xs text-ink-800/70">Current photo. Upload a new file to replace it.</p>
            </div>
        @endif

        <input
            type="file"
            name="photo"
            id="photo"
            accept="image/jpeg,image/png,image/webp"
            class="mt-3 block w-full text-sm text-ink-800 file:mr-4 file:rounded-full file:border-0 file:bg-navy-700 file:px-4 file:py-2 file:text-xs file:font-semibold file:text-paper-50 hover:file:bg-navy-600"
            @if (! $isEditing) required @endif
        >
        <p class="mt-2 text-xs text-ink-800/70">JPG, PNG, or WebP. Maximum 4 MB.</p>
        @error('photo')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex flex-wrap items-center gap-3">
        <button type="submit" class="btn btn-primary">{{ $isEditing ? 'Save changes' : 'Add team member' }}</button>
        <a href="{{ route('admin.team.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>
