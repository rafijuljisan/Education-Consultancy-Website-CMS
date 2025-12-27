@extends('layouts.app')

@section('content')

    {{-- 1. HERO SECTION --}}
    <div class="relative bg-gray-900 h-[500px] flex items-center">
        @if($permit->image)
            <img src="{{ Storage::url($permit->image) }}" class="absolute inset-0 w-full h-full object-cover opacity-30">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 to-transparent"></div>

        <div class="container max-w-[1400px] mx-auto px-4 relative z-10 pt-20 text-center">
            <span
                class="inline-block py-1 px-3 rounded bg-blue-600/30 border border-blue-400/30 text-blue-300 text-sm font-bold mb-4 uppercase tracking-wider">
                Work in {{ $permit->country }}
            </span>
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">{{ $permit->title }}</h1>
            <p class="text-gray-300 text-lg max-w-2xl mx-auto mb-8">
                {{ Str::limit(strip_tags($permit->description), 150) }}
            </p>

            {{-- Stats --}}
            <div class="inline-flex flex-wrap justify-center gap-6 md:gap-12 border-t border-white/10 pt-8 mt-4">
                <div class="text-center">
                    <span class="block text-gray-400 text-xs uppercase tracking-wide">Avg. Salary</span>
                    <span class="text-xl md:text-2xl font-bold text-yellow-400">{{ $permit->salary_range ?? 'N/A' }}</span>
                </div>
                <div class="text-center">
                    <span class="block text-gray-400 text-xs uppercase tracking-wide">Processing Time</span>
                    <span class="text-xl md:text-2xl font-bold text-white">{{ $permit->processing_time ?? 'N/A' }}</span>
                </div>
                <div class="text-center">
                    <span class="block text-gray-400 text-xs uppercase tracking-wide">Visa Validity</span>
                    <span class="text-xl md:text-2xl font-bold text-white">{{ $permit->visa_type ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container max-w-[1400px] mx-auto px-4 py-16">
        <div class="grid lg:grid-cols-12 gap-12">

            {{-- LEFT COLUMN (Content) --}}
            <div class="lg:col-span-8 space-y-16">

                {{-- Overview & Types --}}
                <section class="prose prose-lg max-w-none text-gray-600">
                    <h2 class="text-3xl font-bold text-gray-900 mb-6">Unlock Your Career</h2>
                    {!! $permit->description !!}
                </section>
                {{-- NEW SECTION 1: Types of Work Permits --}}
                @if($permit->permit_types)
                    <section>
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Types of Work Permits</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach($permit->permit_types as $type)
                                <div
                                    class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-primary/50 transition">
                                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-primary mb-4">
                                        {{-- Dynamic Icon based on index (just for visual variety) --}}
                                        @if($loop->even)
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .884.5 2 2 2h4.667M10 6V4">
                                                </path>
                                            </svg>
                                        @endif
                                    </div>
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $type['title'] }}</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">
                                        {{ $type['description'] }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- NEW SECTION 2: In-Demand Sectors --}}
                @if($permit->sectors)
                    <section class="mt-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">In-Demand Sectors</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($permit->sectors as $sector)
                                <div
                                    class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-transparent hover:border-gray-200 hover:bg-white hover:shadow-sm transition group">
                                    <div class="w-2 h-2 rounded-full bg-green-500 group-hover:scale-125 transition"></div>
                                    <span class="font-semibold text-gray-700">{{ $sector['name'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
                {{-- Requirements Box --}}
                @if($permit->requirements)
                    <section class="bg-gray-50 rounded-3xl p-8 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </span>
                            Requirements & Documents
                        </h3>
                        <div class="prose prose-blue max-w-none">
                            {!! $permit->requirements !!}
                        </div>
                    </section>
                @endif

                {{-- Process Timeline (How to Apply) --}}
                @if($permit->process_steps)
                    <section>
                        <h3 class="text-3xl font-bold text-gray-900 mb-8">How to Apply with Us</h3>
                        <div
                            class="relative space-y-8 before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-slate-300 before:to-transparent">
                            @foreach($permit->process_steps as $index => $step)
                                <div
                                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    {{-- Icon Dot --}}
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-slate-300 group-[.is-active]:bg-primary text-slate-500 group-[.is-active]:text-white shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2">
                                        <span class="font-bold">{{ $loop->iteration }}</span>
                                    </div>

                                    {{-- Content Card --}}
                                    <div
                                        class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-6 bg-white rounded-2xl border border-slate-100 shadow-sm">
                                        <h4 class="font-bold text-lg text-gray-900 mb-1">{{ $step['title'] }}</h4>
                                        <p class="text-gray-500 text-sm">{{ $step['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- Beauty Gallery --}}
                @if($permit->gallery)
                    <section>
                        <h3 class="text-3xl font-bold text-gray-900 mb-8">Experience {{ $permit->country }}</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($permit->gallery as $img)
                                <div class="aspect-square rounded-2xl overflow-hidden group">
                                    <img src="{{ Storage::url($img) }}"
                                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- FAQ Accordion --}}
                @if($permit->faqs)
                    <section>
                        <h3 class="text-3xl font-bold text-gray-900 mb-8">Frequently Asked Questions</h3>
                        <div class="space-y-4" x-data="{ active: null }">
                            @foreach($permit->faqs as $key => $faq)
                                <div class="border border-gray-200 rounded-xl overflow-hidden">
                                    <button @click="active = active === {{ $key }} ? null : {{ $key }}"
                                        class="w-full flex justify-between items-center p-5 bg-white text-left font-bold text-gray-800 hover:bg-gray-50 transition">
                                        <span>{{ $faq['question'] }}</span>
                                        <svg :class="{'rotate-180': active === {{ $key }}}"
                                            class="w-5 h-5 transition-transform duration-300 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="active === {{ $key }}" x-collapse
                                        class="p-5 bg-gray-50 text-gray-600 border-t border-gray-100">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>

            {{-- RIGHT COLUMN (Sticky CTA) --}}
            <div class="lg:col-span-4">
                <div class="sticky top-32 space-y-6">

                    {{-- Apply Box --}}
                    <div
                        class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 text-center relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-purple-600"></div>

                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Ready to Start?</h3>
                        <p class="text-gray-500 mb-8 text-sm">Our expert team provides end-to-end guidance for your
                            {{ $permit->country }} work permit.</p>

                        <button onclick="toggleAppointmentModal()"
                            class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-lg transition transform hover:-translate-y-1 mb-4 flex items-center justify-center gap-2">
                            Apply Now
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>

                        <div class="flex items-center justify-center gap-2 text-sm font-medium text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                            <span>Call: {{ $settings->contact_phone ?? '+880 123456' }}</span>
                        </div>
                    </div>

                    {{-- Other Opportunities --}}
                    @if(isset($others) && $others->count() > 0)
                        <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                            <h4 class="font-bold text-gray-900 mb-4">Other Countries</h4>
                            <ul class="space-y-3">
                                @foreach($others as $other)
                                    <li>
                                        <a href="{{ route('work-permit.show', $other->slug) }}"
                                            class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-primary/30 hover:shadow-md transition group">
                                            <div class="flex items-center gap-3">
                                                @if($other->image)
                                                    <div class="w-8 h-8 rounded-full overflow-hidden bg-gray-200">
                                                        <img src="{{ Storage::url($other->image) }}" class="w-full h-full object-cover">
                                                    </div>
                                                @endif
                                                <span
                                                    class="text-sm font-semibold text-gray-700 group-hover:text-primary">{{ $other->country }}</span>
                                            </div>
                                            <svg class="w-4 h-4 text-gray-300 group-hover:text-primary transition" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>

@endsection