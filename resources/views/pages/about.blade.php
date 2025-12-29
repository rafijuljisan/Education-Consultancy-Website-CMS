@extends('layouts.app')

@section('content')

{{-- 1. MODERN HERO HEADER --}}
<div class="relative w-full h-[60vh] min-h-[500px] flex items-center justify-center overflow-hidden bg-slate-900">
    {{-- Background Effect --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 to-slate-900/90 mix-blend-multiply"></div>
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=2070&auto=format&fit=crop" class="w-full h-full object-cover opacity-40" alt="Global Education">
    </div>
    
    {{-- Decorative Blobs --}}
    <div class="absolute top-0 left-0 w-64 h-64 bg-orange-500 rounded-full mix-blend-screen filter blur-[100px] opacity-20 animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full mix-blend-screen filter blur-[100px] opacity-20"></div>

    <div class="relative z-10 container max-w-[1400px] mx-auto px-6 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-orange-400 text-sm font-semibold tracking-wider uppercase mb-6 backdrop-blur-sm">
            About Open Window
        </span>
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight tracking-tight">
            Bridging Borders, <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-300">Building Futures.</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
            Empowering students to navigate the complex world of international education with clarity, confidence, and expert guidance.
        </p>
    </div>
    
    {{-- Scroll Indicator --}}
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce text-white/50">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
    </div>
</div>

<div class="flex flex-col">
    @foreach($sections as $section)
        
        {{-- SECTION STYLING LOGIC --}}
        @php
            $isDark = in_array($section->bg_color, ['blue', 'dark']);
            $bgColorClass = match($section->bg_color) {
                'gray' => 'bg-slate-50',
                'blue' => 'bg-slate-900',
                'dark' => 'bg-slate-900',
                default => 'bg-white'
            };
            $textColorClass = $isDark ? 'text-white' : 'text-slate-800';
            $mutedTextClass = $isDark ? 'text-slate-400' : 'text-slate-500';
        @endphp

        <section class="py-24 {{ $bgColorClass }} relative overflow-hidden group" id="section-{{ $section->id }}">
            
            <div class="container max-w-[1400px] mx-auto px-4 md:px-6 relative z-10">
                
                {{-- SECTION HEADER (Skipped for Image Left/Right to integrate it better) --}}
                @if(!in_array($section->layout_type, ['image_left', 'image_right']))
                    <div class="text-center max-w-3xl mx-auto mb-20">
                        @if($section->subtitle)
                            <span class="text-orange-500 font-bold tracking-widest uppercase text-xs mb-3 block">
                                {{ $section->subtitle }}
                            </span>
                        @endif
                        <h2 class="text-3xl md:text-5xl font-bold mb-6 {{ $textColorClass }}">
                            {{ $section->title }}
                        </h2>
                        @if($section->content)
                            <div class="prose prose-lg mx-auto leading-relaxed {{ $isDark ? 'prose-invert' : 'text-slate-600' }}">
                                {!! $section->content !!}
                            </div>
                        @endif
                        <div class="w-24 h-1 bg-orange-500 mx-auto mt-8 rounded-full"></div>
                    </div>
                @endif


                {{-- 1. HISTORY TIMELINE (Vertical Modern) --}}
                @if($section->layout_type === 'history_timeline' && !empty($section->data['timeline']))
                    <div class="relative max-w-5xl mx-auto">
                        {{-- Center Line --}}
                        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-slate-200 via-orange-200 to-slate-200 md:transform md:-translate-x-1/2"></div>
                        
                        @foreach($section->data['timeline'] as $event)
                            <div class="relative mb-16 md:mb-24 flex flex-col md:flex-row items-center justify-between w-full group">
                                
                                {{-- Content Left (or Right for alternating) --}}
                                <div class="w-full md:w-5/12 pl-12 md:pl-0 {{ $loop->even ? 'md:text-right md:pr-12' : 'md:order-last md:pl-12' }}">
                                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-xl transition duration-500 relative">
                                        {{-- Arrow --}}
                                        <div class="hidden md:block absolute top-1/2 transform -translate-y-1/2 w-4 h-4 bg-white border-l border-b border-slate-100 rotate-45 {{ $loop->even ? '-right-2.5 border-r-0 border-t-0' : '-left-2.5 border-l border-b' }}"></div>
                                        
                                        <span class="text-6xl font-bold text-slate-100 absolute -top-8 {{ $loop->even ? 'right-4' : 'left-4' }} -z-10 select-none">
                                            {{ $event['year'] }}
                                        </span>
                                        <h3 class="text-xl font-bold text-slate-900 mb-2 relative z-10">{{ $event['title'] }}</h3>
                                        <p class="text-slate-600 text-sm relative z-10">{{ $event['description'] }}</p>
                                    </div>
                                </div>

                                {{-- Dot on Line --}}
                                <div class="absolute left-4 md:left-1/2 transform -translate-x-1/2 w-8 h-8 rounded-full bg-white border-4 border-orange-500 z-20 flex items-center justify-center shadow-lg group-hover:scale-125 transition duration-300">
                                    <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                </div>

                                {{-- Spacer for Alignment --}}
                                <div class="w-full md:w-5/12 hidden md:block"></div>
                            </div>
                        @endforeach
                    </div>


                {{-- 2. STATS COUNTER (Grid with Cards) --}}
                @elseif($section->layout_type === 'stats_counter' && !empty($section->data['stats']))
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                        @foreach($section->data['stats'] as $stat)
                            <div class="relative p-8 rounded-3xl {{ $isDark ? 'bg-white/5 border border-white/10' : 'bg-white shadow-xl shadow-slate-200/50' }} text-center group hover:-translate-y-2 transition duration-500">
                                <div class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-400 mb-3">
                                    {{ $stat['number'] }}
                                </div>
                                <p class="text-sm font-bold uppercase tracking-wider {{ $mutedTextClass }}">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>


                {{-- 3. MISSION / VISION CARDS (Feature Grid) --}}
                @elseif($section->layout_type === 'mission_vision' && !empty($section->data['cards']))
                    <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                        @foreach($section->data['cards'] as $card)
                            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:border-orange-100 transition duration-500 group relative overflow-hidden">
                                {{-- Background Decor --}}
                                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-bl-full -mr-8 -mt-8 transition group-hover:scale-110"></div>
                                
                                <div class="relative z-10">
                                    <div class="w-14 h-14 bg-blue-600 text-white rounded-2xl flex items-center justify-center mb-6 shadow-lg shadow-blue-200 group-hover:rotate-6 transition duration-300">
                                        @if(($card['icon'] ?? '') == 'vision') 
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        @elseif(($card['icon'] ?? '') == 'goal') 
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        @else 
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                        @endif
                                    </div>
                                    <h3 class="text-2xl font-bold text-slate-900 mb-4">{{ $card['title'] }}</h3>
                                    <p class="text-slate-600 leading-relaxed">{{ $card['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>


                {{-- 4. FAQ ACCORDION (Minimalist) --}}
                @elseif($section->layout_type === 'faq_accordion' && !empty($section->data['faqs']))
                    <div class="max-w-3xl mx-auto" x-data="{ active: null }">
                        @foreach($section->data['faqs'] as $index => $faq)
                            <div class="mb-4 bg-white rounded-2xl border border-slate-200 overflow-hidden">
                                <button @click="active = active === {{ $index }} ? null : {{ $index }}" 
                                    class="w-full flex justify-between items-center p-6 text-left focus:outline-none bg-white hover:bg-slate-50 transition">
                                    <span class="font-bold text-lg text-slate-800">{{ $faq['question'] }}</span>
                                    <span class="ml-4 flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-full bg-orange-100 text-orange-600 transition-transform duration-300" :class="{'rotate-180': active === {{ $index }}}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </span>
                                </button>
                                <div x-show="active === {{ $index }}" x-collapse class="border-t border-slate-100">
                                    <div class="p-6 text-slate-600 leading-relaxed bg-slate-50/50">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                {{-- 5. TESTIMONIALS (Grid with Quote Styling) --}}
                @elseif($section->layout_type === 'testimonials' && !empty($section->data['testimonials']))
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($section->data['testimonials'] as $review)
                            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative mt-8">
                                {{-- Avatar Placeholder --}}
                                <div class="absolute -top-6 left-8">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-lg">
                                        {{ substr($review['name'], 0, 1) }}
                                    </div>
                                </div>
                                
                                <div class="mt-4">
                                    <div class="flex text-orange-400 mb-4">
                                        ★★★★★
                                    </div>
                                    <p class="text-slate-700 italic mb-6 leading-relaxed">"{{ $review['text'] }}"</p>
                                    <div class="border-t border-slate-100 pt-4">
                                        <h4 class="font-bold text-slate-900">{{ $review['name'] }}</h4>
                                        <p class="text-xs text-slate-400 uppercase tracking-wide mt-1">{{ $review['location'] ?? 'Student' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


                {{-- 6. STANDARD IMAGE LEFT/RIGHT (Asymmetrical) --}}
                @elseif(in_array($section->layout_type, ['image_left', 'image_right']))
                    <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                        
                        {{-- Text Column --}}
                        <div class="{{ $section->layout_type === 'image_right' ? 'lg:order-1' : 'lg:order-2' }}">
                            <div class="inline-block p-2 px-4 rounded-lg bg-orange-50 text-orange-600 font-bold text-xs uppercase tracking-wider mb-6">
                                {{ $section->subtitle ?? 'Our Expertise' }}
                            </div>
                            <h2 class="text-3xl md:text-5xl font-bold mb-6 {{ $textColorClass }}">
                                {{ $section->title }}
                            </h2>
                            <div class="prose prose-lg leading-relaxed {{ $isDark ? 'prose-invert' : 'text-slate-600' }}">
                                {!! $section->content !!}
                            </div>
                            
                            {{-- CTA Button if needed --}}
                            <div class="mt-8">
                                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-bold leading-6 text-white transition duration-150 ease-in-out bg-blue-600 border border-transparent rounded-full hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue active:bg-blue-700">
                                    Get Started
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>

                        {{-- Image Column --}}
                        <div class="{{ $section->layout_type === 'image_right' ? 'lg:order-2' : 'lg:order-1' }} relative">
                            @if($section->image)
                                <div class="relative rounded-3xl overflow-hidden shadow-2xl group">
                                    <img src="{{ Storage::url($section->image) }}" class="w-full h-auto object-cover transform transition duration-700 group-hover:scale-105">
                                    
                                    {{-- Overlay Content --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex items-end p-8">
                                        <p class="text-white font-medium">Empowering students worldwide.</p>
                                    </div>
                                </div>
                                
                                {{-- Decorative floating element --}}
                                <div class="absolute -bottom-6 -right-6 w-24 h-24 bg-orange-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
                                <div class="absolute -top-6 -left-6 w-32 h-32 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse" style="animation-delay: 1s"></div>
                            @endif
                        </div>
                    </div>

                @endif

            </div>
        </section>

    @endforeach
</div>

{{-- AlpineJS for Interactions (Ensure Alpine is loaded in layout) --}}
<script src="//unpkg.com/alpinejs" defer></script>

@endsection