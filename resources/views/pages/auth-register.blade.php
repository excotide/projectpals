@extends('layouts.app')

@section('title', 'Register - ProjectPals')
@section('meta_description', 'Daftar akun ProjectPals untuk mulai kolaborasi.')

@section('content')
<style>
	.auth-bg {
		position: absolute;
		inset: -120px;
		background:
			radial-gradient(circle at 12% 15%, rgba(0,212,255,0.2), transparent 45%),
			radial-gradient(circle at 80% 15%, rgba(80,255,48,0.12), transparent 40%),
			radial-gradient(circle at 50% 90%, rgba(168,232,255,0.12), transparent 55%);
		filter: blur(2px);
		pointer-events: none;
	}

	.auth-card {
		background-color: rgba(17,32,54,0.92);
		border-color: rgba(60,73,78,0.2);
		backdrop-filter: blur(10px);
	}
</style>

<section class="relative min-h-screen px-6 py-16 overflow-hidden">
	<div class="auth-bg"></div>
	<div class="relative mx-auto grid max-w-6xl gap-10 lg:grid-cols-2">
		<div class="space-y-6">
			<a href="{{ route('landing') }}" class="text-sm font-medium hover:underline" style="color: var(--color-primary);">&larr; Kembali ke Landing</a>
			<div class="space-y-4">
				<div class="inline-flex items-center gap-2 rounded-full border px-3 py-1" style="background-color: var(--color-surface-container-high); border-color: rgba(60,73,78,0.2);">
					<span class="h-2 w-2 rounded-full animate-pulse" style="background-color: var(--color-tertiary);"></span>
					<span class="text-xs uppercase tracking-[0.3em]" style="color: var(--color-on-surface-variant);">Create Account</span>
				</div>
				<h1 class="text-4xl md:text-5xl font-bold" style="color: var(--color-on-surface);">Let us know your handle.</h1>
				<p class="max-w-md text-base" style="color: var(--color-on-surface-variant);">
					Buat akun untuk mulai membangun room dan tim kolaborasi.
				</p>
			</div>
			<div class="rounded-2xl border p-6" style="border-color: rgba(60,73,78,0.2); background: linear-gradient(140deg, rgba(168,232,255,0.1), rgba(80,255,48,0.08));">
				<p class="text-sm uppercase tracking-[0.3em]" style="color: var(--color-primary-container);">Note</p>
				<p class="mt-2 text-sm" style="color: var(--color-on-surface-variant);">
					Username hanya boleh huruf, angka, underscore, atau dash.
				</p>
			</div>
		</div>

		<div class="auth-card rounded-2xl border p-6 md:p-8">
			<h2 class="text-2xl font-semibold" style="color: var(--color-on-surface);">Register</h2>
			<p class="mt-2 text-sm" style="color: var(--color-on-surface-variant);">Isi data untuk membuat akun baru.</p>

			@if ($errors->any())
				<div class="mt-4 rounded-lg border px-4 py-3 text-sm" style="border-color: rgba(255,180,171,0.4); background-color: rgba(147,0,10,0.35); color: var(--color-error);">
					{{ $errors->first() }}
				</div>
			@endif

			<form method="POST" action="{{ route('auth.register') }}" class="mt-6 space-y-4">
				@csrf
				<div>
					<label for="name" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Nama</label>
					<input id="name" name="name" type="text" value="{{ old('name') }}" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="Nama lengkap" />
				</div>
				<div>
					<label for="username" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Username</label>
					<input id="username" name="username" type="text" value="{{ old('username') }}" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="projectpal" />
				</div>
				<div>
					<label for="email" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Email</label>
					<input id="email" name="email" type="email" value="{{ old('email') }}" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="nama@email.com" />
				</div>
				<div>
					<label for="password" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Password</label>
					<input id="password" name="password" type="password" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="Minimal 8 karakter" />
				</div>
				<div>
					<label for="password_confirmation" class="mb-1 block text-sm font-medium" style="color: var(--color-on-surface-variant);">Konfirmasi Password</label>
					<input id="password_confirmation" name="password_confirmation" type="password" required class="w-full rounded-md border px-3 py-2" style="background-color: var(--color-surface-container-high); border-color: var(--color-outline-variant); color: var(--color-on-surface);" placeholder="Ulangi password" />
				</div>
				<div class="flex items-center justify-between text-sm">
					<a href="{{ route('login') }}" class="hover:underline" style="color: var(--color-primary-container);">Sudah punya akun?</a>
				</div>
				<button type="submit" class="w-full rounded-md px-4 py-2 font-semibold" style="background-color: var(--color-primary-container); color: var(--color-on-primary);">Register</button>
			</form>
		</div>
	</div>
</section>
@endsection
