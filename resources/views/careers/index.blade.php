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
                        <pattern id="grid-pattern-careers" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-careers)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                
                {{-- Title --}}
                <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">
                    Join Our Team
                </h1>

                {{-- Description --}}
                <p class="text-lg md:text-xl text-white/90 mb-6 max-w-2xl mx-auto font-medium">
                    Build the future of international education with us.
                </p>
                
                {{-- Breadcrumbs --}}
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <span>Careers</span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16 max-w-5xl">
    <div class="grid gap-6">
        @forelse($jobs as $job)
        <a href="{{ route('careers.show', $job->slug) }}" class="group block bg-white p-8 rounded-xl border border-gray-100 shadow-sm hover:shadow-lg transition flex flex-col md:flex-row md:items-center justify-between gap-6 {{ $job->is_filled ? 'opacity-60 grayscale' : '' }}">
            
            <div>
                <h2 class="text-2xl font-bold text-gray-900 group-hover:text-primary transition flex items-center gap-3">
                    {{ $job->title }}
                    @if($job->is_filled)
                        <span class="bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded border">Position Filled</span>
                    @endif
                </h2>
                <div class="flex items-center gap-4 text-sm text-gray-500 mt-2">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $job->location }}
                    </span>
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ $job->type }}
                    </span>
                </div>
            </div>

            <div class="flex-shrink-0">
                <span class="inline-flex items-center font-bold {{ $job->is_filled ? 'text-gray-400' : 'text-primary' }}">
                    {{ $job->is_filled ? 'View Details' : 'Apply Now' }} &rarr;
                </span>
            </div>
        </a>
        @empty
        <div class="text-center py-12 bg-gray-50 rounded-xl">
            <h3 class="text-xl font-bold text-gray-600">No Openings Currently</h3>
            <p class="text-gray-500">Please check back later.</p>
        </div>
        @endforelse
    </div>
</div>

@endsection