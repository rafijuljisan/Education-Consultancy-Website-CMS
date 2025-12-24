@extends('layouts.app')

@section('content')

{{-- 
    Wrapper
    1. pt-28: Reduced from 32. Sufficient space if you have a floating menu.
       (If your menu is NOT floating, change this to 'pt-10').
    2. pb-10: Reduced bottom spacing.
--}}
<div class="w-full bg-white pt-05 pb-10"> 
    
    {{-- Container: Strictly 1400px max width --}}
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        
        {{-- Orange Banner --}}
        {{-- py-12 md:py-16: Reduced internal height (was py-20/28) --}}
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- Decorative Line Pattern (Same as before but lighter) --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-3 tracking-tight">
                    About Us
                </h1>
                
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <span>About Us Details</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col">
    @foreach($sections as $section)
        
        @if($section->layout_type === 'image_left')
        <section class="py-20 bg-white border-b border-gray-50">
            <div class="max-w-[1400px] mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-secondary/20 rounded-xl transform -rotate-3 transition duration-500 group-hover:rotate-0"></div>
                        @if($section->image)
                            <img src="{{ Storage::url($section->image) }}" class="relative rounded-xl shadow-lg w-full object-cover transform transition duration-500 group-hover:scale-105">
                        @endif
                    </div>
                    <div>
                        @if($section->subtitle)
                            <span class="text-primary font-bold tracking-wider uppercase text-sm mb-2 block">{{ $section->subtitle }}</span>
                        @endif
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $section->title }}</h2>
                        <div class="prose text-gray-600 text-lg leading-relaxed">
                            {!! $section->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @elseif($section->layout_type === 'image_right')
        <section class="py-20 bg-gray-50 border-b border-gray-100">
            <div class="max-w-[1400px] mx-auto px-4">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div class="order-2 md:order-1">
                        @if($section->subtitle)
                            <span class="text-secondary font-bold tracking-wider uppercase text-sm mb-2 block">{{ $section->subtitle }}</span>
                        @endif
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $section->title }}</h2>
                        <div class="prose text-gray-600 text-lg leading-relaxed">
                            {!! $section->content !!}
                        </div>
                    </div>
                    <div class="order-1 md:order-2 relative group">
                        <div class="absolute -inset-4 bg-primary/20 rounded-xl transform rotate-3 transition duration-500 group-hover:rotate-0"></div>
                        @if($section->image)
                            <img src="{{ Storage::url($section->image) }}" class="relative rounded-xl shadow-lg w-full object-cover transform transition duration-500 group-hover:scale-105">
                        @endif
                    </div>
                </div>
            </div>
        </section>

        @elseif($section->layout_type === 'centered_card')
        <section class="py-24 bg-white relative">
            <div class="max-w-[1400px] mx-auto px-4 max-w-4xl text-center">
                <div class="w-20 h-1 bg-primary mx-auto mb-8 rounded"></div>
                <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $section->title }}</h2>
                <div class="prose prose-lg text-gray-600 mx-auto">
                    {!! $section->content !!}
                </div>
            </div>
        </section>

        @elseif($section->layout_type === 'stats_row')
        <section class="py-16 bg-primary text-white">
            <div class="max-w-[1400px] mx-auto px-4 text-center">
                <h2 class="text-3xl font-bold mb-12">{{ $section->title }}</h2>
                <div class="prose prose-invert prose-xl mx-auto max-w-4xl">
                    {!! $section->content !!}
                </div>
            </div>
        </section>
        
        @endif

    @endforeach
</div>

@endsection