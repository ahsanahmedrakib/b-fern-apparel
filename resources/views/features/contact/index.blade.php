@extends('layouts.app')

@section('title', 'Contact Us')

@section('description', 'Contact B.Fern Apparel about apparel liquidation, sourcing, and brand partnerships. New York showroom at 525 Seventh Avenue.')

@section('content')
    @include('partials.page-hero', [
        'eyebrow' => 'Contact',
        'title' => 'Let\'s talk apparel',
        'description' => 'Whether you are sourcing merchandise or looking to move inventory, share a few details and our team will follow up.',
    ])

    <section class="bg-paper-50 py-20 lg:py-28">
        <div class="container-page grid gap-12 lg:grid-cols-12 lg:gap-16">
            {{-- Form --}}
            <div class="lg:col-span-7" data-reveal>
                @if (session('status'))
                    <div class="mb-8 flex items-start gap-3 rounded-2xl border border-navy-600/30 bg-navy-700/10 p-5 text-sm text-ink-900" role="status">
                        <span class="mt-0.5 grid size-5 shrink-0 place-items-center rounded-full bg-navy-700 text-paper-50">
                            <svg class="size-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m5 12.5 4.5 4.5L19 7" />
                            </svg>
                        </span>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <h2 class="display text-3xl text-ink-950 sm:text-4xl">Send us a message</h2>
                <p class="mt-4 text-base leading-relaxed text-ink-800/90">
                    Fields marked with an asterisk are required. We typically respond within one business day.
                </p>

                <form
                    method="POST"
                    action="{{ route('contact.store') }}"
                    data-contact-form
                    novalidate
                    class="mt-10 space-y-6"
                >
                    @csrf

                    {{-- Honeypot: hidden from users, catches bots --}}
                    <div class="absolute -left-[9999px] top-0" aria-hidden="true">
                        <label for="website">Leave this field empty</label>
                        <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <x-field
                            name="name"
                            label="Full name"
                            rules="required|max:255"
                            required
                            autocomplete="name"
                        />

                        <x-field
                            name="email"
                            label="Email"
                            type="email"
                            rules="required|email"
                            required
                            autocomplete="email"
                        />

                        <x-field
                            name="company"
                            label="Company"
                            rules="max:255"
                            autocomplete="organization"
                        />

                        <x-field
                            name="phone"
                            label="Phone"
                            type="tel"
                            rules="max:50"
                            autocomplete="tel"
                        />
                    </div>

                    <x-field
                        name="subject"
                        label="How can we help?"
                        type="select"
                        rules="required"
                        required
                        select-placeholder="Select a topic"
                        :options="$subjects"
                    />

                    <x-field
                        name="message"
                        label="Message"
                        type="textarea"
                        rules="required|min:20|max:5000"
                        required
                        placeholder="Tell us about the merchandise, categories, or partnership you have in mind."
                    />

                    <div class="flex flex-wrap items-center gap-4">
                        <button type="submit" class="btn btn-primary group">
                            Send Message
                            <svg class="size-4 transition-transform duration-200 group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6" />
                            </svg>
                        </button>
                        <p class="text-xs text-ink-800/70">Your details are only used to respond to your inquiry.</p>
                    </div>
                </form>
            </div>

            {{-- Contact details --}}
            <aside class="lg:col-span-5" data-reveal>
                <div class="rounded-3xl border border-paper-200 bg-paper-100/70 p-8">
                    <h2 class="eyebrow text-navy-600">New York Showroom</h2>
                    <p class="display mt-4 text-2xl text-ink-950">{{ config('bfern.contact.showroom_address') }}</p>

                    <dl class="mt-8 space-y-5 text-sm">
                        <div>
                            <dt class="font-semibold text-ink-900">Email</dt>
                            <dd class="mt-1">
                                <a href="mailto:{{ config('bfern.contact.email') }}" class="text-navy-700 transition hover:text-navy-600">
                                    {{ config('bfern.contact.email') }}
                                </a>
                            </dd>
                        </div>

                        @if (config('bfern.contact.phone'))
                            <div>
                                <dt class="font-semibold text-ink-900">Phone</dt>
                                <dd class="mt-1 text-ink-800/90">{{ config('bfern.contact.phone') }}</dd>
                            </div>
                        @endif

                        <div>
                            <dt class="font-semibold text-ink-900">U.S. Locations</dt>
                            <dd class="mt-2 space-y-2 text-ink-800/90">
                                @foreach (config('bfern.us_locations') as $location)
                                    <p>
                                        <span class="font-medium text-ink-900">{{ $location['city'] }}</span>
                                        &middot; {{ $location['type'] }}
                                        @if ($location['address'])
                                            <span class="block text-ink-800/70">{{ $location['address'] }}</span>
                                        @endif
                                    </p>
                                @endforeach
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="mt-6 rounded-3xl border border-paper-200 bg-white p-8">
                    <h2 class="eyebrow text-navy-600">International Offices</h2>
                    <ul class="mt-5 flex flex-wrap gap-2">
                        @foreach (config('bfern.international_offices') as $office)
                            <li class="rounded-full border border-paper-300 px-3.5 py-1.5 text-xs font-medium text-ink-800 transition hover:border-navy-500/40">
                                {{ $office['country'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>
        </div>
    </section>
@endsection
