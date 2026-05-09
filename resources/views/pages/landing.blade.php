@extends('layouts.app')

@section('title', 'ProjectPals - Find your people. Build your project.')
@section('meta_description', 'Platform kolaborasi tim berbasis AI untuk menemukan partner proyek yang tepat.')

@section('content')

{{-- ===== INLINE STYLES & FONTS ===== --}}
<style>
  html {
  scroll-behavior: smooth;
  }

  .nav-link {
  position: relative;
  padding-bottom: 4px;
  transition: color 200ms ease;
  }

  .nav-link::after {
  content: "";
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  height: 2px;
  background: var(--color-primary-container);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 250ms ease;
  }

  .nav-link.is-active::after {
  transform: scaleX(1);
  }

  .nav-link.is-active {
  color: var(--color-primary-container);
  }
</style>

{{-- ===== TOP NAV BAR ===== --}}
<nav class="fixed top-0 w-full z-50 backdrop-blur-xl transition-all duration-300"
   style="background-color: rgba(4,19,41,0.80);">
  <div class="flex justify-between items-center px-8 py-4 max-w-full mx-auto font-['Poppins'] tracking-tight">
  {{-- Logo --}}
  <div class="text-2xl font-bold" style="color: var(--color-primary-container);">ProjectPals</div>

  {{-- Nav Links --}}
  <div class="hidden md:flex items-center space-x-8">
  <a href="#about"
    class="nav-link is-active"
    data-nav-link>
  About
  </a>
  <a href="#features"
   class="nav-link"
   data-nav-link
   style="color: var(--color-on-surface-variant);">
  Features
  </a>
  <a href="#testimonial"
   class="nav-link"
   data-nav-link
   style="color: var(--color-on-surface-variant);">
  Testimonial
  </a>
  <a href="#contact"
   class="nav-link"
   data-nav-link
   style="color: var(--color-on-surface-variant);">
  Contact
  </a>
  </div>

  {{-- CTA Buttons --}}
  <div class="flex items-center gap-4">
  <a href="#"
   class="hidden lg:block px-4 py-2 rounded-lg transition-all duration-300"
   style="color: var(--color-on-surface-variant);"
   onmouseover="this.style.color='var(--color-primary-container)'; this.style.backgroundColor='var(--color-surface-container-high)'"
   onmouseout="this.style.color='var(--color-on-surface-variant)'; this.style.backgroundColor='transparent'">
  Profile
  </a>
  <a href="{{ route('login') }}"
   class="px-6 py-2 rounded font-semibold transition-all active:scale-95 hover:opacity-90"
    style="background-color: var(--color-primary-container); color: var(--color-on-primary);">
  Login\
</a>

</div>
  </div>
</nav>

{{-- ===== HERO SECTION ===== --}}
<section class="relative pt-32 pb-20 px-8 overflow-hidden">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-12">

  {{-- Hero Text --}}
  <div class="flex-1 space-y-8 z-10">
  {{-- Badge --}}
  <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full border"
   style="background-color: var(--color-surface-container-high); border-color: rgba(60,73,78,0.20);">
  <span class="w-2 h-2 rounded-full animate-pulse"
    style="background-color: var(--color-tertiary);"></span>
  <span class="text-xs uppercase tracking-widest font-['Manrope']"
    style="color: var(--color-on-surface-variant);">
    Next-Gen Collaboration
  </span>
  </div>

  {{-- Headline --}}
  <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight leading-tight"
  style="color: var(--color-on-surface); line-height: 1.1;">
  Find your people.<br/>
  <span class="text-transparent bg-clip-text"
    style="background-image: linear-gradient(to right, var(--color-primary-container), var(--color-primary));">
    Build your project.
  </span>
  </h1>

  {{-- Sub --}}
  <p class="text-xl font-light leading-relaxed max-w-xl"
   style="color: var(--color-on-surface-variant);">
  Stop searching through endless profiles. Our AI-driven engine maps your skills to the perfect squad.
  High-velocity team building for high-impact ideas.
  </p>

  {{-- CTA Buttons --}}
  <div class="flex flex-col sm:flex-row gap-4 pt-4">
  <a href="{{ route('login') }}"
   class="group px-8 py-4 rounded font-bold text-lg flex items-center justify-center gap-2 transition-all active:scale-95 hover:opacity-90"
    style="background-color: var(--color-primary-container); color: var(--color-on-primary);">
    Get Started
  </a>
  <button class="px-8 py-4 rounded font-bold text-lg transition-all active:scale-95"
    style="background-color: var(--color-surface-container-high); color: var(--color-primary);"
    onmouseover="this.style.backgroundColor='var(--color-surface-container-highest)'"
    onmouseout="this.style.backgroundColor='var(--color-surface-container-high)'">
    View Demo
  </button>
  </div>
  </div>

  {{-- Hero Image Card --}}
  <div class="flex-1 relative">
  <div class="absolute -inset-4 rounded-full blur-[100px]"
   style="background-color: rgba(0,212,255,0.10);"></div>
  <div class="relative rounded-xl overflow-hidden border shadow-2xl"
   style="background-color: var(--color-surface-container); border-color: rgba(60,73,78,0.10);">
  <img src="{{ asset('images/logo.png') }}" alt="Team collaborating"
     class="w-full h-auto object-cover mix-blend-luminosity hover:mix-blend-normal transition-all duration-700"
     style="opacity: 0.80;">                    
  <div class="absolute inset-0"
     style="background: linear-gradient(to top, var(--color-surface), transparent, transparent);"></div>
  </div>
  </div>
  </div>
</section>

{{-- ===== FEATURES SECTION (Bento Grid) ===== --}}
<section class="py-24 px-8" id="features" style="background-color: var(--color-surface-container-low);">
  <div class="max-w-7xl mx-auto space-y-16">

  {{-- Section Header --}}
  <div class="flex flex-col md:flex-row justify-between items-end gap-6">
  <div class="max-w-2xl">
  <h2 class="text-sm font-['Manrope'] uppercase tracking-[0.3em] mb-4"
    style="color: var(--color-tertiary);">Core Ecosystem</h2>
  <h3 class="text-4xl md:text-5xl font-bold"
    style="color: var(--color-on-surface); font-family: 'Plus Jakarta Sans', sans-serif;">
    Precision-engineered for the modern founder.
  </h3>
  </div>
  <p class="max-w-xs text-right" style="color: var(--color-on-surface-variant);">
  Optimized workflows from the first 'hello' to the final launch.
  </p>
  </div>

  {{-- Bento Grid --}}
  <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

  {{-- Feature 1: Smart Matching (wide) --}}
  <div class="md:col-span-8 rounded-xl p-8 group relative overflow-hidden transition-colors"
   style="background-color: var(--color-surface-container-high);"
   onmouseover="this.style.backgroundColor='var(--color-surface-container-highest)'"
   onmouseout="this.style.backgroundColor='var(--color-surface-container-high)'">
  <div class="relative z-10 space-y-4">
    <span class="material-symbols-outlined text-4xl"
    style="color: var(--color-primary-container); font-size: 2.25rem;">psychology</span>
    <h4 class="text-2xl font-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Smart Matching</h4>
    <p class="max-w-md leading-relaxed" style="color: var(--color-on-surface-variant);">
    Our proprietary algorithm goes beyond keyword matching. We analyze behavioral archetypes,
    time-zone compatibility, and tech-stack synergy to find your project's soulmate.
    </p>
  </div>
  <div class="absolute right-0 bottom-0 w-1/2 h-full opacity-10 group-hover:opacity-20 transition-opacity">
    <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJPdq9aVryFbXs3_cJRjBwDWWpOoBGTeqk20UHO5SI_0JCTjbw1pCELHjSrXkru9oxjFJNL5Lhs187LoG4L49N0aEqBJfzZwqI4ZRW9FEAg5kmmTuMSfs1qIbZLG6G0kVpJITsexblkJ8JWorSsKGdG2A3HMQjLHnxCZNLhIHMEHrb61A8cGZSmN0AFPaSYiErDT_Epfs2InYqS9-cHkhYdcEACn6GsfAxNBRYlR8DvuDmyQn14EiBagRo6GFlj-QMNP216D4_AAc"
     alt="Neural network"
     class="w-full h-full object-cover" />
  </div>
  </div>

  {{-- Feature 2: Team Building --}}
  <div class="md:col-span-4 rounded-xl p-8 transition-colors"
   style="background-color: var(--color-surface-container-high);"
   onmouseover="this.style.backgroundColor='var(--color-surface-container-highest)'"
   onmouseout="this.style.backgroundColor='var(--color-surface-container-high)'">
  <div class="space-y-4">
    <span class="material-symbols-outlined text-4xl"
    style="color: var(--color-tertiary); font-size: 2.25rem;">groups</span>
    <h4 class="text-2xl font-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Team Building</h4>
    <p class="leading-relaxed" style="color: var(--color-on-surface-variant);">
    Rapidly assemble squads with built-in roles and responsibilities.
    From Lead Dev to UX Visionary.
    </p>
  </div>
  </div>

  {{-- Feature 3: Project Lifecycle --}}
  <div class="md:col-span-4 rounded-xl p-8 transition-colors"
   style="background-color: var(--color-surface-container-high);"
   onmouseover="this.style.backgroundColor='var(--color-surface-container-highest)'"
   onmouseout="this.style.backgroundColor='var(--color-surface-container-high)'">
  <div class="space-y-4">
    <span class="material-symbols-outlined text-4xl"
    style="color: var(--color-primary); font-size: 2.25rem;">dynamic_feed</span>
    <h4 class="text-2xl font-bold" style="font-family: 'Plus Jakarta Sans', sans-serif;">Project Lifecycle</h4>
    <p class="leading-relaxed" style="color: var(--color-on-surface-variant);">
    Integrated kanban and milestone tracking designed specifically for early-stage project momentum.
    </p>
  </div>
  </div>

  {{-- Feature 4: Kinetic Deep (visual / avatars) --}}
  <div class="md:col-span-8 rounded-xl p-8 flex items-center justify-between border"
   style="background: linear-gradient(to bottom right, rgba(168,232,255,0.10), rgba(80,255,48,0.10));
    border-color: rgba(60,73,78,0.10);">
  <div class="space-y-2">
    <h4 class="text-3xl font-bold" style="color: var(--color-on-surface); font-family: 'Plus Jakarta Sans', sans-serif;">
    The Kinetic Deep
    </h4>
    <p class="italic" style="color: var(--color-on-surface-variant);">Efficiency in every pixel.</p>
  </div>
  <div class="flex -space-x-4">
    @foreach ([
    'https://lh3.googleusercontent.com/aida-public/AB6AXuDP8wxKTDQxBbZTyAsQCm4oyGZDugdHztTwEfaxj4CWqQVy53cOqn6D2A3wUQOUkfcuHmudViyoPxBBmXANBarZPCgZREv6TOHxs8dJOtRHabizD_9I1UL5LoCVBCt1jOlEjNKMMWYniMgf7K8Q1b1oZe8GeW-PYY6ky30LKxnWpqLZlblYVns9tyDM9uh_Rzv5grnMx1AG64DrrCeXkxESRcMB3QgFTnbTX0nyPVZyEiezyahpamHsltDUjU9JxmA2fZc3rUutNIk',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuDbnVhJb33WuGAfPDCWWHfCmwySwOLGVZtUhg2ZzRSCHUxbHKUXQogWyvsQIX9rD3v9Ew_J2KIlumxHq1_ZMH4Dytc1xSHO3vX_Yt2iAQOGtLitJf9LLTgi7ThhPn1qjtru0KFE8INllfobvE-UbQTqjxPWUrS8-5xikS5I-ydkmDuLUnoyLNY1kNZIekYf7nBubq2Hba-65EoFZ_whOMwhZeaSaBYlA-OXZp9fCllWbDIaQFq1gSP4gGVJl_uiBI6I9R_gs5YiLRo',
    'https://lh3.googleusercontent.com/aida-public/AB6AXuAuyOccya2kNv8I-EjRRZHZjSbisdXZ8-DS8PtUrcKkXld21DXe-Iq_1QH2f9pN1NBHMQ3s3gF1hBKasQ5CJU7j3ENdYZgIwCzXlLhFl6-_bxMAMbuAAo9tOj5juEHxGqOgW4k5H-I0D0SsbprhQVtZ4WG6Cp7TRwXGThyynKPKv4GKRGeU1Z6d6k9wKeo5H2XGMoV7B5P3UbWeJeJ4wrSEx7M4X1nNZnMsAkeQe3J65Ph9gVhMPoXxAzaP2RNqUG5BX_z8ZqWIJu8'
    ] as $avatar)
    <img src="{{ $avatar }}"
     alt="User"
     class="w-12 h-12 rounded-full border-2"
     style="border-color: var(--color-surface);" />
    @endforeach
    <div class="w-12 h-12 rounded-full border-2 flex items-center justify-center text-xs font-bold"
     style="border-color: var(--color-surface);
    background-color: var(--color-surface-container-highest);
    color: var(--color-tertiary);">
    +42
    </div>
  </div>
  </div>

  </div>
  </div>
</section>

{{-- ===== ABOUT SECTION ===== --}}
<section class="py-24 px-8 overflow-hidden" id="about">
  <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-20 items-center">

  {{-- Image --}}
  <div class="flex-1 order-2 md:order-1">
  <div class="relative">
  <div class="absolute -top-10 -left-10 w-32 h-32 rounded-full blur-3xl"
     style="background-color: rgba(168,232,255,0.20);"></div>
  <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJTc8ssZskvKTowneKvCRiiFu4r_NDhf4Yv9tq6C0bjwmMyQRC-FJaUVJ2erEKCkf2dGagyD9a_IZ113JiTF5F5LfUgL86ZMjR2gaKf6_7xdHC-cyr8lLAwF33rxS416-R_NEpIIB8-9_AqtCBJt8K1oF7IBMyhtGOVHXwYl73LqiO5pWIowDI6ZCDPyZlZeF584vIKTie37wsqpL1JqhHcYiYIK4Mm2rARG0m0Q5_F5mWRn4Q9DFBn-DAgVKXYjm6heL4-29Aei8"
     alt="Office setup"
     class="rounded-xl border shadow-2xl grayscale hover:grayscale-0 transition-all duration-1000"
     style="border-color: rgba(60,73,78,0.10);" />
  </div>
  </div>

  {{-- Text --}}
  <div class="flex-1 space-y-8 order-1 md:order-2">
  <h2 class="text-4xl md:text-5xl font-bold leading-tight"
  style="font-family: 'Plus Jakarta Sans', sans-serif; color: var(--color-on-surface);">
  Built by builders,<br/>
  for the <span style="color: var(--color-tertiary);">future makers</span>.
  </h2>
  <p class="text-lg leading-relaxed" style="color: var(--color-on-surface-variant);">
  ProjectPals was born in a dorm room out of a simple frustration: great ideas dying because they
  couldn't find the right hands to build them. We've eliminated the friction of networking and
  replaced it with data-driven synergy.
  </p>
  <div class="grid grid-cols-2 gap-8">
  <div>
    <p class="text-3xl font-bold" style="color: var(--color-primary-container);">12k+</p>
    <p class="text-sm uppercase tracking-widest" style="color: var(--color-on-surface-variant);">Active Pals</p>
  </div>
  <div>
    <p class="text-3xl font-bold" style="color: var(--color-tertiary);">850+</p>
    <p class="text-sm uppercase tracking-widest" style="color: var(--color-on-surface-variant);">Launched Apps</p>
  </div>
  </div>
  </div>
  </div>
</section>

{{-- ===== TESTIMONIAL SECTION ===== --}}
<section class="py-24 px-8" id="testimonial" style="background-color: var(--color-surface-container);">
  <div class="max-w-5xl mx-auto text-center space-y-12">
  <span class="material-symbols-outlined"
  style="font-size: 4rem; color: rgba(168,232,255,0.20);">format_quote</span>
  <blockquote class="text-3xl md:text-4xl font-semibold italic leading-tight"
    style="color: var(--color-on-surface); font-family: 'Plus Jakarta Sans', sans-serif;">
  "Within 48 hours of joining ProjectPals, I found a CTO and a Lead Designer who shared my obsession
  with generative AI. We launched our MVP three weeks later. This is the speed of light for startups."
  </blockquote>
  <div class="flex flex-col items-center gap-4">
  <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBbeoYKg36w3Cb3eAzYRap8NDRu2GCzs-4MDG07Zosst5CIvq-BHCMPnZnN8QKpJb1W5Xz2znx38e9aKAjL-LMYZLr0u8iUf_zGWnHVZZpESiMvw8bG8cMCeERn9-ZfGcOHPoOxSvM_Crc4Se_yQH1_CH23qVfTCKX4cyBsva1tN9PkOu2TPuyth42o2rA7xu-Lq4KnBPQgyppAyPw9HvU09Sxq6_2d2tr39Ew41S3O_8lI3HcjLKOBviuqQZCnYlnIKgpmHXyl9mI"
   alt="Marcus Thorne"
   class="w-16 h-16 rounded-full border-2 p-0.5"
   style="border-color: var(--color-primary-container);" />
  <div>
  <p class="font-bold text-lg" style="font-family: 'Plus Jakarta Sans', sans-serif;">Marcus Thorne</p>
  <p class="text-sm uppercase tracking-widest" style="color: var(--color-on-surface-variant);">
    Founder, NovaFlux Systems
  </p>
  </div>
  </div>
  </div>
</section>

{{-- ===== CONTACT SECTION ===== --}}
<section class="py-24 px-8" id="contact">
  <div class="max-w-7xl mx-auto rounded-2xl overflow-hidden grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x"
   style="background-color: var(--color-surface-container-high); border-color: rgba(60,73,78,0.10);">

  {{-- Contact Info --}}
  <div class="p-10 sm:p-12 lg:p-16 space-y-8"
   style="background-color: var(--color-surface-container-highest);">
  <h2 class="text-4xl font-bold"
  style="font-family: 'Plus Jakarta Sans', sans-serif; color: var(--color-on-surface);">
  Ready to start?<br/>
  <span style="color: var(--color-primary-container);">Reach out to us.</span>
  </h2>
  <p class="leading-relaxed" style="color: var(--color-on-surface-variant);">
  Have questions about our enterprise plans or custom matching solutions? Our team is standing by
  to help you scale your vision.
  </p>
  <div class="space-y-6">
  {{-- Email --}}
  <div class="flex items-center gap-4 group">
    <div class="w-12 h-12 rounded flex items-center justify-center transition-colors"
     style="background-color: var(--color-surface-container);"
     onmouseover="this.style.backgroundColor='var(--color-primary-container)'; this.querySelector('span').style.color='var(--color-on-primary)'"
     onmouseout="this.style.backgroundColor='var(--color-surface-container)'; this.querySelector('span').style.color='var(--color-on-surface)'">
    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-on-surface);">
    <path d="M4 6h16a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
    <path d="M22 8 12 13 2 8" />
    </svg>
    </div>
    <p class="font-medium" style="color: var(--color-on-surface);">hello@projectpals.tech</p>
  </div>
  {{-- Location --}}
  <div class="flex items-center gap-4 group">
    <div class="w-12 h-12 rounded flex items-center justify-center transition-colors"
     style="background-color: var(--color-surface-container);"
     onmouseover="this.style.backgroundColor='var(--color-tertiary)'; this.querySelector('span').style.color='var(--color-on-tertiary)'"
     onmouseout="this.style.backgroundColor='var(--color-surface-container)'; this.querySelector('span').style.color='var(--color-on-surface)'">
    <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-on-surface);">
    <path d="M12 22s7-7 7-12a7 7 0 1 0-14 0c0 5 7 12 7 12z" />
    <circle cx="12" cy="10" r="3" />
    </svg>
    </div>
    <p class="font-medium" style="color: var(--color-on-surface);">Silicon Alley, NY / Remote First</p>
  </div>
  </div>
  </div>

  {{-- Contact Form --}}
  <div class="p-10 sm:p-12 lg:p-16" style="background-color: var(--color-surface-container);">
  <form method="POST" action="{{ route('contact.send') }}" class="space-y-8">
  @csrf

  <div class="space-y-2">
    <label class="text-xs uppercase tracking-widest font-['Manrope']"
     style="color: var(--color-on-surface-variant);">
    Your Name
    </label>
    <input type="text"
     name="name"
     placeholder="John Doe"
     value="{{ old('name') }}"
     class="w-full border-0 border-b-2 focus:ring-0 transition-all px-0 py-3"
     style="background-color: var(--color-surface-container-low);
      border-color: var(--color-outline-variant);
      color: var(--color-on-surface);"
     onfocus="this.style.borderColor='var(--color-primary-container)'"
     onblur="this.style.borderColor='var(--color-outline-variant)'" />
    @error('name')
    <p class="text-xs mt-1" style="color: var(--color-error);">{{ $message }}</p>
    @enderror
  </div>

  <div class="space-y-2">
    <label class="text-xs uppercase tracking-widest font-['Manrope']"
     style="color: var(--color-on-surface-variant);">
    Work Email
    </label>
    <input type="email"
     name="email"
     placeholder="john@company.com"
     value="{{ old('email') }}"
     class="w-full border-0 border-b-2 focus:ring-0 transition-all px-0 py-3"
     style="background-color: var(--color-surface-container-low);
      border-color: var(--color-outline-variant);
      color: var(--color-on-surface);"
     onfocus="this.style.borderColor='var(--color-primary-container)'"
     onblur="this.style.borderColor='var(--color-outline-variant)'" />
    @error('email')
    <p class="text-xs mt-1" style="color: var(--color-error);">{{ $message }}</p>
    @enderror
  </div>

  <div class="space-y-2">
    <label class="text-xs uppercase tracking-widest font-['Manrope']"
     style="color: var(--color-on-surface-variant);">
    What are you building?
    </label>
    <textarea name="message"
    rows="4"
    placeholder="Tell us about your project vision..."
    class="w-full border-0 border-b-2 focus:ring-0 transition-all px-0 py-3 resize-none"
    style="background-color: var(--color-surface-container-low);
       border-color: var(--color-outline-variant);
       color: var(--color-on-surface);"
    onfocus="this.style.borderColor='var(--color-primary-container)'"
    onblur="this.style.borderColor='var(--color-outline-variant)'">{{ old('message') }}</textarea>
    @error('message')
    <p class="text-xs mt-1" style="color: var(--color-error);">{{ $message }}</p>
    @enderror
  </div>

  @if(session('success'))
    <div class="px-4 py-3 rounded text-sm"
     style="background-color: rgba(80,255,48,0.10); color: var(--color-tertiary); border: 1px solid rgba(80,255,48,0.30);">
    {{ session('success') }}
    </div>
  @endif

  <button type="submit"
    class="w-full py-4 rounded font-bold transition-all active:scale-95 hover:opacity-90"
    style="background-color: var(--color-primary-container); color: var(--color-on-primary);">
    Send Message
  </button>
  </form>
  </div>
  </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer class="w-full border-t" style="background-color: #041329; border-color: rgba(28,42,65,0.30);">
  <div class="flex flex-col md:flex-row justify-between items-center px-12 py-10 w-full font-['Poppins'] text-sm">

  {{-- Brand --}}
  <div class="flex flex-col gap-2 mb-8 md:mb-0">
  <div class="text-lg font-bold" style="color: var(--color-primary-container);">ProjectPals</div>
  <p style="color: var(--color-on-surface-variant);">© {{ date('Y') }} ProjectPals. The Kinetic Deep.</p>
  </div>

  {{-- Links --}}
  <div class="flex flex-wrap justify-center gap-8">
  @foreach ([
  'Privacy Policy' => '#',
  'Terms of Service' => '#',
  'Github'          => '#',
  'Support'         => '#',
  ] as $label => $href)
  <a href="{{ $href }}"
   class="transition-colors"
   style="color: var(--color-on-surface-variant);"
   onmouseover="this.style.color='var(--color-primary-container)'"
   onmouseout="this.style.color='var(--color-on-surface-variant)'">
  {{ $label }}
  </a>
  @endforeach
  </div>

  {{-- Social Icons --}}
  <div class="mt-8 md:mt-0 flex gap-4">
  <a href="#"
   class="w-10 h-10 rounded flex items-center justify-center transition-colors"
   style="background-color: var(--color-surface-container-high);"
   onmouseover="this.style.backgroundColor='var(--color-surface-container-highest)'"
   onmouseout="this.style.backgroundColor='var(--color-surface-container-high)'">
  <svg viewBox="0 0 24 24" aria-hidden="true" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="color: var(--color-primary);">
    <circle cx="18" cy="5" r="3" />
    <circle cx="6" cy="12" r="3" />
    <circle cx="18" cy="19" r="3" />
    <path d="M8.6 13.5 15.4 17.5" />
    <path d="M15.4 6.5 8.6 10.5" />
  </svg>
  </a>
  </div>
  </div>
</footer>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', () => {
  const navLinks = Array.from(document.querySelectorAll('[data-nav-link]'));
  const linkTargets = navLinks
  .map((link) => {
  const targetId = link.getAttribute('href')?.replace('#', '');
  if (!targetId) return null;
  const section = document.getElementById(targetId);
  return section ? { link, section } : null;
  })
  .filter(Boolean);

  const setActiveLink = (activeLink) => {
  navLinks.forEach((item) => item.classList.remove('is-active'));
  if (activeLink) {
  activeLink.classList.add('is-active');
  }
  };

  navLinks.forEach((link) => {
  link.addEventListener('click', (event) => {
  setActiveLink(event.currentTarget);
  });
  });

  if ('IntersectionObserver' in window && linkTargets.length) {
  const observer = new IntersectionObserver(
  (entries) => {
    const visible = entries
    .filter((entry) => entry.isIntersecting)
    .sort((a, b) => b.intersectionRatio - a.intersectionRatio)[0];

    if (!visible) return;

    const match = linkTargets.find((item) => item.section === visible.target);
    if (match) {
    setActiveLink(match.link);
    }
  },
  {
    rootMargin: '-40% 0px -55% 0px',
    threshold: [0.15, 0.4, 0.7],
  }
  );

  linkTargets.forEach(({ section }) => observer.observe(section));
  }
  });
</script>
@endpush
