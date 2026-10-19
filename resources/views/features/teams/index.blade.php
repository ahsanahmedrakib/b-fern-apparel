@extends('layouts.app')

@section('title', 'Our Team')

@section('description', 'Meet the team behind B.Fern Apparel — experienced professionals supporting sourcing, quality control, and the movement of apparel merchandise worldwide.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Our People',
        'title' => 'Meet the team',
        'description' => 'Behind every shipment is a team that knows the apparel market — coordinating sourcing, quality control, and logistics across our international network.',
    ])

    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page">
            @if ($teamMembers->isEmpty())
                <div class="rounded-3xl border border-dashed border-paper-300 bg-white p-12 text-center">
                    <p class="font-display text-xl text-ink-950">Our team profiles are coming soon.</p>
                    <p class="mt-2 text-sm text-ink-800/70">Please check back shortly.</p>
                </div>
            @else
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                    @foreach ($teamMembers as $member)
                        <div data-reveal>
                            <x-team-card :member="$member" />
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @include('partials.cta', [
        'title' => 'Work with our team',
        'description' => 'Talk to the people who handle apparel sourcing, liquidation, and authorized brand purchasing every day.',
    ])
@endsection
