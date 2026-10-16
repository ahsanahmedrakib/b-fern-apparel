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
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    autocomplete="current-password"
                    @class(['field mt-2', 'field-error' => $errors->has('password')])
                >
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
