@extends('layouts.auth')

@section('title', 'Sign in')

@section('content')
    <div class="rounded-3xl border border-paper-200 bg-paper-50 p-8 shadow-2xl shadow-ink-950/30">
        <h1 class="display text-2xl text-ink-950">Admin sign in</h1>
        <p class="mt-2 text-sm text-ink-800/80">Sign in to review website inquiries.</p>

        <form method="POST" action="{{ route('admin.login.store') }}" class="mt-8 space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold text-ink-900">Email address</label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="username"
                    @class(['field mt-2', 'field-error' => $errors->has('email')])
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-semibold text-ink-900">Password</label>
                <div class="relative mt-2">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        autocomplete="current-password"
                        @class(['field pr-12', 'field-error' => $errors->has('password')])
                    >
                    <button
                        type="button"
                        data-password-toggle="password"
                        class="absolute inset-y-0 right-0 grid w-11 place-items-center rounded-r-xl text-ink-800/60 transition hover:text-ink-900"
                        aria-label="Show password"
                        aria-pressed="false"
                    >
                        <svg data-password-icon="show" class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12S5.5 5.25 12 5.25 21.75 12 21.75 12 18.5 18.75 12 18.75 2.25 12 2.25 12Z" />
                            <circle cx="12" cy="12" r="3" />
                        </svg>
                        <svg data-password-icon="hide" class="hidden size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3 3 18 18M10.5 6.1A9.8 9.8 0 0 1 12 6c6.5 0 9.75 6 9.75 6a17.7 17.7 0 0 1-3.1 3.9M6.4 6.4C3.5 8.3 2.25 12 2.25 12S5.5 18 12 18a9.7 9.7 0 0 0 4.1-.9M9.9 9.9a3 3 0 0 0 4.2 4.2" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <label class="flex items-center gap-2 text-sm text-ink-800">
                <input type="hidden" name="remember" value="0">
                <input type="checkbox" name="remember" value="1" class="size-4 rounded border-paper-300 text-navy-700 focus:ring-navy-600" @checked(old('remember'))>
                Remember me
            </label>

            <button type="submit" class="btn btn-primary w-full">
                Sign in
            </button>
        </form>
    </div>
@endsection
