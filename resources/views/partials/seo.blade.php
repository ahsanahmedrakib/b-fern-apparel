@php
    $title = trim($__env->yieldContent('title'));
    $pageTitle = $title !== '' ? $title.' — '.config('bfern.name') : config('bfern.name').' — '.config('bfern.tagline');
    $description = trim($__env->yieldContent('description')) ?: config('bfern.short_description');
    $shareImage = collect(['social-share.jpg', 'social-share.png', 'logo.png'])
        ->first(fn ($file) => file_exists(public_path($file)));
@endphp

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ $pageTitle }}</title>
<meta name="description" content="{{ $description }}">
<link rel="canonical" href="{{ url()->current() }}">

<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ config('bfern.name') }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:url" content="{{ url()->current() }}">
@if ($shareImage)
    <meta property="og:image" content="{{ asset($shareImage) }}">
@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $description }}">
@if ($shareImage)
    <meta name="twitter:image" content="{{ asset($shareImage) }}">
@endif

@if (file_exists(public_path('favicon.svg')))
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
@endif
@if (file_exists(public_path('favicon.ico')))
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
@endif
@if (file_exists(public_path('favicon.png')))
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
@endif
<link rel="apple-touch-icon" href="{{ asset('logo.png') }}">
