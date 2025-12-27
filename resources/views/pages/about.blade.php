@extends('layouts.app')

@section('content')

{{-- HERO HEADER --}}
<div class="w-full bg-white pt-5 pb-10"> 
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
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
            <div class="relative z-10 py-16 text-center text-white">
                <h1 class="text-4xl md:text-6xl font-bold mb-4 tracking-tight">About Us</h1>
                <p class="text-white/90 font-medium">Empowering Students to Achieve Their International Education Dreams.</p>
            </div>
        </div>
    </div>
</div>

<div class="flex flex-col">
    @foreach($sections as $section)
        
        {{-- SECTION WRAPPER STYLE --}}
        @php
            $bgClass = match($section->bg_color) {
                'gray' => 'bg-gray-50',
                'blue' => 'bg-[#003B99] text-white',
                'dark' => 'bg-gray-900 text-white',
                default => 'bg-white text-gray-900'
            };
        @endphp

        <section class="py-20 {{ $bgClass }} relative overflow-hidden">
            
            <div class="max-w-[1400px] mx-auto px-4">
                
                {{-- SECTION HEADER (Optional) --}}
                @if(!in_array($section->layout_type, ['image_left', 'image_right']))
                    <div class="text-center max-w-3xl mx-auto mb-16">
                        @if($section->subtitle)
                            <span class="text-[#FF6B35] font-bold tracking-wider uppercase text-sm mb-3 block">{{ $section->subtitle }}</span>
                        @endif
                        <h2 class="text-3xl md:text-5xl font-bold mb-6">{{ $section->title }}</h2>
                        @if($section->content)
                            <div class="prose prose-lg mx-auto {{ $section->bg_color !== 'white' ? 'prose-invert' : '' }}">
                                {!! $section->content !!}
                            </div>
                        @endif
                    </div>
                @endif


                {{-- 1. HISTORY TIMELINE --}}
                @if($section->layout_type === 'history_timeline' && !empty($section->data['timeline']))
                    <div class="relative">
                        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-0.5 bg-gray-200"></div>
                        @foreach($section->data['timeline'] as $event)
                            <div class="relative z-10 mb-12 flex justify-between items-center w-full {{ $loop->even ? 'flex-row-reverse' : '' }}">
                                <div class="w-[45%]"></div>
                                <div class="w-12 h-12 absolute left-1/2 transform -translate-x-1/2 rounded-full bg-[#FF6B35] text-white flex items-center justify-center font-bold shadow-lg border-4 border-white">
                                    {{ substr($event['year'], 2) }}
                                </div>
                                <div class="w-[45%] bg-white p-6 rounded-2xl shadow-lg border border-gray-100 {{ $section->bg_color !== 'white' ? 'text-gray-900' : '' }}">
                                    <span class="text-[#003B99] font-bold text-xl mb-1 block">{{ $event['year'] }}</span>
                                    <h3 class="text-lg font-bold mb-2">{{ $event['title'] }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $event['description'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                {{-- 2. STATS COUNTER --}}
                @elseif($section->layout_type === 'stats_counter' && !empty($section->data['stats']))
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                        @foreach($section->data['stats'] as $stat)
                            <div class="p-6 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20">
                                <h3 class="text-4xl md:text-6xl font-extrabold text-[#FF6B35] mb-2">{{ $stat['number'] }}</h3>
                                <p class="text-lg font-medium opacity-90">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>

                {{-- 3. MISSION / VISION CARDS --}}
                @elseif($section->layout_type === 'mission_vision' && !empty($section->data['cards']))
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($section->data['cards'] as $card)
                            <div class="bg-white p-8 rounded-3xl shadow-lg border border-gray-100 hover:-translate-y-2 transition duration-300">
                                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center text-[#003B99] mb-6">
                                    @if(($card['icon'] ?? '') == 'vision') 👁️ @elseif(($card['icon'] ?? '') == 'goal') 🎯 @else 🚀 @endif
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $card['title'] }}</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $card['description'] }}</p>
                            </div>
                        @endforeach
                    </div>

                {{-- 4. AWARDS GRID --}}
                @elseif($section->layout_type === 'awards_grid' && !empty($section->data['awards']))
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        @foreach($section->data['awards'] as $award)
                            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 text-center flex flex-col items-center justify-center aspect-square hover:shadow-md transition">
                                @if(!empty($award['icon']))
                                    <img src="{{ Storage::url($award['icon']) }}" class="h-20 w-auto object-contain mb-4 grayscale hover:grayscale-0 transition duration-500">
                                @else
                                    <div class="h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4 text-4xl">🏆</div>
                                @endif
                                <h4 class="font-bold text-gray-900 text-sm">{{ $award['title'] }}</h4>
                            </div>
                        @endforeach
                    </div>

                {{-- 5. FAQ ACCORDION --}}
                @elseif($section->layout_type === 'faq_accordion' && !empty($section->data['faqs']))
                    <div class="max-w-3xl mx-auto space-y-4" x-data="{ active: null }">
                        @foreach($section->data['faqs'] as $index => $faq)
                            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100">
                                <button @click="active = active === {{ $index }} ? null : {{ $index }}" class="w-full flex justify-between items-center p-5 text-left font-bold text-gray-900 hover:bg-gray-50 transition">
                                    <span>{{ $faq['question'] }}</span>
                                    <span x-text="active === {{ $index }} ? '−' : '+'" class="text-2xl text-[#FF6B35]"></span>
                                </button>
                                <div x-show="active === {{ $index }}" class="p-5 pt-0 text-gray-600 bg-gray-50 border-t border-gray-100">
                                    {{ $faq['answer'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                {{-- 6. TESTIMONIALS --}}
                @elseif($section->layout_type === 'testimonials' && !empty($section->data['testimonials']))
                    <div class="grid md:grid-cols-2 gap-8">
                        @foreach($section->data['testimonials'] as $review)
                            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 relative">
                                <div class="text-[#FF6B35] text-6xl absolute top-4 right-6 opacity-20 font-serif">"</div>
                                <p class="text-gray-600 text-lg italic mb-6 relative z-10">{{ $review['text'] }}</p>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500">
                                        {{ substr($review['name'], 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $review['name'] }}</h4>
                                        <p class="text-sm text-gray-400">{{ $review['date'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                {{-- 7. STANDARD IMAGE LEFT/RIGHT --}}
                @elseif(in_array($section->layout_type, ['image_left', 'image_right']))
                    <div class="grid md:grid-cols-2 gap-16 items-center">
                        <div class="{{ $section->layout_type === 'image_right' ? 'order-2 md:order-1' : '' }}">
                            @if($section->subtitle)
                                <span class="text-[#FF6B35] font-bold tracking-wider uppercase text-sm mb-2 block">{{ $section->subtitle }}</span>
                            @endif
                            <h2 class="text-4xl font-bold mb-6">{{ $section->title }}</h2>
                            <div class="prose text-lg leading-relaxed {{ $section->bg_color !== 'white' ? 'prose-invert' : 'text-gray-600' }}">
                                {!! $section->content !!}
                            </div>
                        </div>
                        <div class="{{ $section->layout_type === 'image_right' ? 'order-1 md:order-2' : '' }} relative group">
                            @if($section->image)
                                <div class="absolute -inset-4 bg-[#003B99]/10 rounded-3xl transform {{ $section->layout_type === 'image_left' ? '-rotate-3' : 'rotate-3' }} transition duration-500 group-hover:rotate-0"></div>
                                <img src="{{ Storage::url($section->image) }}" class="relative rounded-2xl shadow-2xl w-full object-cover transform transition duration-500 group-hover:scale-[1.02]">
                            @endif
                        </div>
                    </div>

                @endif

            </div>
        </section>

    @endforeach
</div>

@endsection