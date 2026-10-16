@props([
    'name',
    'label',
    'type' => 'text',
    'rules' => null,
    'required' => false,
    'value' => null,
    'placeholder' => null,
    'autocomplete' => null,
    'rows' => 6,
    'options' => [],
    'selectPlaceholder' => null,
])

@php
    $isRequired = $required || ($rules !== null && str_contains($rules, 'required'));
    $hasError = $errors->has($name);
    $errorId = $name.'-error';
    $fieldValue = old($name, $value);
    $fieldClasses = $hasError ? 'field mt-2 field-error' : 'field mt-2';
@endphp

<div data-field>
    <label for="{{ $name }}" class="block text-sm font-semibold text-ink-900">
        {{ $label }}@if ($isRequired)<span class="text-red-600" aria-hidden="true"> *</span>@endif
    </label>

    @if ($type === 'textarea')
        <textarea
            name="{{ $name }}"
            id="{{ $name }}"
            rows="{{ $rows }}"
            data-rules="{{ $rules }}"
            data-label="{{ $label }}"
            aria-describedby="{{ $errorId }}"
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @class([$fieldClasses, 'resize-y'])
        >{{ $fieldValue }}</textarea>
    @elseif ($type === 'select')
        <select
            name="{{ $name }}"
            id="{{ $name }}"
            data-rules="{{ $rules }}"
            data-label="{{ $label }}"
            aria-describedby="{{ $errorId }}"
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            class="{{ $fieldClasses }}"
        >
            @if ($selectPlaceholder)
                <option value="" disabled @selected($fieldValue === null || $fieldValue === '')>{{ $selectPlaceholder }}</option>
            @endif
            @foreach ($options as $optionValue => $optionLabel)
                <option value="{{ $optionValue }}" @selected((string) $fieldValue === (string) $optionValue)>{{ $optionLabel }}</option>
            @endforeach
        </select>
    @else
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $fieldValue }}"
            data-rules="{{ $rules }}"
            data-label="{{ $label }}"
            aria-describedby="{{ $errorId }}"
            aria-invalid="{{ $hasError ? 'true' : 'false' }}"
            @if ($placeholder) placeholder="{{ $placeholder }}" @endif
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            class="{{ $fieldClasses }}"
        >
    @endif

    <div class="mt-2 flex items-center justify-between gap-3">
        <p
            id="{{ $errorId }}"
            data-error-for="{{ $name }}"
            @class(['text-sm text-red-600', 'hidden' => ! $hasError])
            role="alert"
        >{{ $errors->first($name) }}</p>

        <span data-valid-for="{{ $name }}" class="hidden shrink-0 text-navy-600" aria-hidden="true">
            <svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12.5 4.5 4.5L19 7" />
            </svg>
        </span>
    </div>
</div>
