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
                        <pattern id="grid-pattern-services" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-services)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                
                {{-- Title --}}
                <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">
                    Our Services
                </h1>

                {{-- Description --}}
                <p class="text-lg md:text-xl text-white/90 mb-6 max-w-2xl mx-auto font-medium">
                    Comprehensive support for your study abroad journey
                </p>
                
                {{-- Breadcrumbs --}}
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <span>Services</span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($services as $service)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition border border-gray-100 p-8 group">
            <div class="w-16 h-16 bg-blue-50 rounded-xl flex items-center justify-center mb-6 group-hover:bg-primary transition duration-300">
                @if($service->icon)
                    <img src="{{ Storage::url($service->icon) }}" class="w-8 h-8">
                @else
                    <svg class="w-8 h-8 text-primary group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @endif
            </div>
            
            <h2 class="text-2xl font-bold mb-3 group-hover:text-primary transition">
                {{ $service->title }}
            </h2>
            
            <p class="text-gray-600 mb-6 line-clamp-3">
                {{ $service->short_description }}
            </p>
            
            <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center font-semibold text-primary hover:underline">
                Read More 
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>
        @endforeach
    </div>
</div>

@endsection