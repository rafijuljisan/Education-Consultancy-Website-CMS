@extends('layouts.app')

@section('content')

{{-- 
    Wrapper
    - pt-5: Consistent top spacing.
    - pb-10: Consistent bottom spacing.
--}}
<div class="w-full bg-white pt-5 pb-10">
    
    {{-- Container: Strictly 1400px max width --}}
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        
        {{-- Orange Banner --}}
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- Decorative Line Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern-destinations" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-destinations)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                
                {{-- Title --}}
                <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">
                    Study Destinations
                </h1>

                {{-- Description --}}
                <p class="text-lg md:text-xl text-white/90 mb-6 max-w-2xl mx-auto font-medium">
                    Choose where you want to build your future
                </p>
                
                {{-- Breadcrumbs --}}
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <span>Destinations</span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($countries as $country)
        <a href="{{ route('countries.show', $country->slug) }}" class="group block bg-white rounded-2xl shadow-sm hover:shadow-xl transition border overflow-hidden">
            <div class="h-56 overflow-hidden relative">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition z-10"></div>
                <img src="{{ $country->cover_image ? Storage::url($country->cover_image) : 'https://source.unsplash.com/random/400x600/?'.$country->name }}" 
                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
            </div>
            <div class="p-8">
                <h2 class="text-2xl font-bold mb-2 group-hover:text-primary transition flex items-center gap-3">
                    @if($country->flag_image)
                        <img src="{{ Storage::url($country->flag_image) }}" class="w-8 h-8 rounded-full shadow-sm">
                    @endif
                    {{ $country->name }}
                </h2>
                <p class="text-gray-600 mb-6 line-clamp-2">
                    {{ $country->short_description ?? 'Explore top universities and student visa requirements.' }}
                </p>
                <span class="text-primary font-semibold flex items-center">
                    View Universities 
                    <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </span>
            </div>
        </a>
        @endforeach
    </div>
</div>

@endsection