@extends('layouts.app')

@section('content')

{{-- Language Training & Prep Header --}}
<div class="w-full bg-white pt-5 pb-10">
    
    {{-- Container: Strictly 1400px max width --}}
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        
        {{-- Indigo Banner --}}
        <div class="relative w-full bg-gradient-to-r from-indigo-900 to-indigo-700 rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- 1. Background Image (Blended into the indigo) --}}
            {{-- Using a generic study/library image as a placeholder --}}
            <div class="absolute inset-0 z-0 opacity-20 mix-blend-overlay">
                <img src="https://source.unsplash.com/random/1200x600/?books,studying"
                     alt="Background Texture"
                     class="w-full h-full object-cover grayscale">
            </div>

            {{-- 2. Decorative Line Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none z-0">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern-lang" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-lang)" />
                </svg>
            </div>

            {{-- 3. Content --}}
            <div class="relative z-10 py-16 md:py-24 text-center text-white px-4">
                
                {{-- Badge --}}
                <span class="inline-block py-1.5 px-4 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-sm font-bold mb-6 uppercase tracking-wider shadow-sm">
                    Skill Development
                </span>

                {{-- Title --}}
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 tracking-tight drop-shadow-md leading-tight">
                    Language Training & Prep
                </h1>
                
                {{-- Subtitle --}}
                <p class="text-lg md:text-xl text-indigo-100/90 font-medium max-w-2xl mx-auto leading-relaxed">
                    Ace your IELTS, TOEFL, or learn a new language with our expert guidance.
                </p>

            </div>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($courses as $course)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition border border-gray-100 overflow-hidden flex flex-col">
            <div class="h-48 bg-gray-200 relative">
                @if($course->thumbnail)
                    <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-300 font-bold text-2xl">
                        {{ substr($course->title, 0, 3) }}
                    </div>
                @endif
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm text-indigo-700">
                    {{ $course->mode }}
                </div>
            </div>
            
            <div class="p-6 flex-1 flex flex-col">
                <h2 class="text-2xl font-bold mb-2">{{ $course->title }}</h2>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span>⏱ {{ $course->duration }}</span>
                    <span>📅 {{ $course->batch_type }}</span>
                </div>
                <p class="text-gray-600 mb-6 line-clamp-3 flex-1">
                    {{ $course->short_description }}
                </p>
                <a href="{{ route('languages.show', $course->slug) }}" class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection