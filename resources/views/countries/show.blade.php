@extends('layouts.app')

@section('content')

    {{-- Country Header Section --}}
<div class="w-full bg-white pt-5 pb-10">
    
    {{-- Container: Strictly 1400px max width --}}
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        
        {{-- Orange Banner --}}
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- 1. Country Image (Blended into the orange) --}}
            {{-- We use 'mix-blend-overlay' and low opacity to keep the orange theme dominant --}}
            <div class="absolute inset-0 z-0 opacity-20 mix-blend-overlay">
                <img src="{{ $country->cover_image ? Storage::url($country->cover_image) : 'https://source.unsplash.com/random/1200x600/?' . $country->name }}"
                     class="w-full h-full object-cover grayscale">
            </div>

            {{-- 2. Decorative Line Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none z-0">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern-country" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-country)" />
                </svg>
            </div>

            {{-- 3. Content --}}
            <div class="relative z-10 py-16 md:py-24 text-center text-white">
                
                {{-- Badge --}}
                <span class="inline-block py-1.5 px-4 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-sm font-bold mb-6 uppercase tracking-wider shadow-sm">
                    Study In
                </span>

                {{-- Title --}}
                <h1 class="text-4xl md:text-6xl font-extrabold mb-6 tracking-tight drop-shadow-md">
                    {{ $country->name }}
                </h1>
                
                {{-- Breadcrumbs --}}
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <a href="{{ route('countries.index') }}" class="hover:underline hover:text-gray-100 transition">Destinations</a>
                    <span>/</span>
                    <span>{{ $country->name }}</span>
                </div>

            </div>
        </div>
    </div>
</div>

    <div class="max-w-[1400px] mx-auto px-4 py-16 grid md:grid-cols-3 gap-12">

        <div class="md:col-span-2 space-y-12">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    About {{ $country->name }}
                </h2>
                <div class="prose max-w-none text-gray-600">
                    {!! $country->details !!}
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-6">Top Universities in {{ $country->name }}</h2>
                <div class="space-y-4">
                    @forelse($country->universities as $uni)
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col md:flex-row items-center gap-6">
                            <div
                                class="w-24 h-24 flex-shrink-0 bg-gray-50 rounded-lg flex items-center justify-center p-2 border">
                                @if($uni->logo)
                                    <img src="{{ Storage::url($uni->logo) }}" class="max-w-full max-h-full">
                                @else
                                    <span class="font-bold text-gray-400 text-xs">{{ $uni->name }}</span>
                                @endif
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-xl font-bold text-gray-900">{{ $uni->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    <span class="mr-3">📍 {{ $uni->city ?? 'Main Campus' }}</span>
                                    @if($uni->ranking)
                                        <span class="text-orange-500">★ Global Rank: #{{ $uni->ranking }}</span>
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('universities.show', $uni->slug) }}"
                                class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary transition whitespace-nowrap">
                                View Courses
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-xl">
                            <p class="text-gray-500">No universities listed for {{ $country->name }} yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-primary p-8 rounded-2xl text-white sticky top-24">
                <h3 class="text-2xl font-bold mb-2">Interested in {{ $country->name }}?</h3>
                <p class="mb-6 opacity-90">Fill out the form below and our expert counselors will contact you.</p>

                <form action="#" class="space-y-4">
                    <input type="text" placeholder="Your Name"
                        class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                    <input type="email" placeholder="Your Email"
                        class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                    <input type="tel" placeholder="Phone Number"
                        class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                    <button
                        class="w-full bg-secondary hover:bg-yellow-500 text-white font-bold py-3 rounded-lg transition shadow-lg mt-2">
                        Get Free Advice
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection