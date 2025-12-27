@extends('layouts.app')

@section('content')

    {{-- 1. HERO HEADER --}}
    {{-- Course Hero Section --}}
    <div class="w-full bg-white pt-5 pb-10">

        {{-- Container --}}
        <div class="max-w-[1400px] mx-auto px-4 md:px-6">

            {{-- Orange Gradient Banner --}}
            <div
                class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-2xl">

                {{-- 1. Dynamic Background Image (Blended) --}}
                <div class="absolute inset-0 z-0 opacity-10 mix-blend-multiply">
                    @if($course->thumbnail)
                        <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover grayscale blur-sm">
                    @else
                        <img src="https://source.unsplash.com/random/1200x600/?education,learning"
                            class="w-full h-full object-cover grayscale">
                    @endif
                </div>

                {{-- 2. Decorative Pattern --}}
                <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                    <svg class="w-full h-full" viewBox="0 0 400 400" preserveAspectRatio="none">
                        <defs>
                            <pattern id="grid-pattern-course" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid-pattern-course)" />
                    </svg>
                </div>

                {{-- 3. Main Grid Content --}}
                <div class="relative z-10 grid lg:grid-cols-2 gap-12 items-center px-6 py-16 md:px-12 md:py-20">

                    {{-- Left Column: Text Info --}}
                    <div class="text-white">
                        {{-- Badge --}}
                        <div
                            class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-sm font-bold mb-6 shadow-sm">
                            <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                            <span class="uppercase tracking-wider">Language Training</span>
                        </div>

                        {{-- Title --}}
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 leading-tight drop-shadow-md">
                            {{ $course->title }}
                        </h1>

                        {{-- Meta Data (Duration / Mode) --}}
                        <div class="flex flex-wrap gap-4 mb-8">
                            <div
                                class="flex items-center gap-2 bg-black/20 rounded-lg px-4 py-2 backdrop-blur-sm border border-white/10">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-bold text-sm">{{ $course->duration ?? '8 Weeks' }}</span>
                            </div>
                            <div
                                class="flex items-center gap-2 bg-black/20 rounded-lg px-4 py-2 backdrop-blur-sm border border-white/10">
                                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                                <span class="font-bold text-sm">{{ $course->mode ?? 'Online / Offline' }}</span>
                            </div>
                        </div>

                        {{-- Description --}}
                        <p class="text-lg text-white/90 mb-10 max-w-xl leading-relaxed font-medium">
                            {{ $course->short_description }}
                        </p>

                        {{-- CTA Buttons --}}
                        <div class="flex flex-wrap gap-4">
                            <a href="#enroll"
                                class="bg-white text-[#FF6B35] hover:bg-gray-100 font-bold py-3.5 px-8 rounded-full transition-all shadow-[0_10px_20px_rgba(0,0,0,0.2)] transform hover:-translate-y-1 flex items-center gap-2">
                                Enroll Now
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </a>
                            <a href="#curriculum"
                                class="bg-transparent border-2 border-white/30 hover:bg-white/10 text-white font-bold py-3.5 px-8 rounded-full transition-all flex items-center gap-2">
                                View Syllabus
                            </a>
                        </div>
                    </div>

                    {{-- Right Column: Course Visuals --}}
                    <div class="hidden lg:block relative group perspective-1000">

                        {{-- Decorative Blob --}}
                        <div
                            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] bg-white/20 blur-3xl rounded-full -z-10">
                        </div>

                        {{-- Main Image Card --}}
                        <div
                            class="relative z-10 transform transition-transform duration-500 group-hover:scale-[1.02] group-hover:rotate-1">
                            @if($course->thumbnail)
                                <img src="{{ Storage::url($course->thumbnail) }}" alt="{{ $course->title }}"
                                    class="w-full h-auto rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] border-[6px] border-white/20 backdrop-blur-sm object-cover aspect-video">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-3xl flex items-center justify-center text-gray-400">
                                    No Image</div>
                            @endif

                            {{-- Floating Badge: Certificate (Only show if enabled in admin) --}}
                            @if($course->certificate_available)
                                <div
                                    class="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-xl flex items-center gap-4 animate-bounce-slow">
                                    <div
                                        class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500 font-bold uppercase">Certificate</p>
                                        <p class="text-gray-900 font-bold">Included</p>
                                    </div>
                                </div>
                            @endif

                            {{-- Floating Badge: Next Batch (Only show if date is set) --}}
                            @if($course->start_date)
                                <div
                                    class="absolute -top-6 -right-6 bg-[#003b99] text-white p-4 rounded-2xl shadow-xl text-center transform rotate-3">
                                    <p class="text-xs opacity-80 uppercase font-bold">Next Batch</p>
                                    <p class="font-bold text-lg">{{ $course->start_date->format('d M') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-4 py-16">

        {{-- 2. WHY LEARN (Benefits) --}}
        @if($course->benefits)
            <section class="mb-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900">Why Learn {{ $course->title }}?</h2>
                    <p class="text-gray-500 mt-2">Open doors to new opportunities</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($course->benefits as $benefit)
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                            <div
                                class="w-12 h-12 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 mb-4 text-xl">
                                ✓
                            </div>
                            <h3 class="font-bold text-lg mb-2">{{ $benefit['title'] }}</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">{{ $benefit['description'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        {{-- 3. COURSE VARIANTS (Crash vs Mid-Term) --}}
        @if($course->variants)
            <section class="mb-20 bg-gray-50 -mx-4 px-4 py-16">
                <div class="max-w-[1400px] mx-auto">
                    <h2 class="text-3xl font-bold text-gray-900 text-center mb-12">Our Language Courses</h2>
                    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                        @foreach($course->variants as $variant)
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-t-4 border-indigo-600 flex flex-col">
                                <div class="p-8 flex-1">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $variant['name'] }}</h3>
                                        <span
                                            class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-bold">{{ $variant['duration'] }}</span>
                                    </div>
                                    <div class="prose prose-indigo text-gray-600 mb-6">
                                        {!! $variant['details'] !!}
                                    </div>
                                </div>
                                <div class="p-6 bg-gray-50 border-t border-gray-100">
                                    <a href="#enroll"
                                        class="block w-full text-center bg-white border-2 border-indigo-600 text-indigo-600 font-bold py-3 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                        Select This Course
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <div class="grid lg:grid-cols-3 gap-12">
            <div class="lg:col-span-2 space-y-16">

                {{-- 4. OUR COMMITMENT (Features) --}}
                @if($course->features)
                    <section>
                        <h3 class="text-2xl font-bold mb-6">Our Commitment to Your Success</h3>
                        <div class="space-y-6">
                            @foreach($course->features as $feature)
                                <div class="flex gap-4">
                                    <div
                                        class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center text-green-600 font-bold mt-1">
                                        ✓</div>
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $feature['title'] }}</h4>
                                        <p class="text-gray-600">{{ $feature['description'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- 5. TESTIMONIALS --}}
                @if($course->course_testimonials)
                    <section>
                        <h3 class="text-2xl font-bold mb-6">Student Success Stories</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach($course->course_testimonials as $testi)
                                <div class="bg-gray-50 p-6 rounded-xl border border-gray-100">
                                    <p class="text-gray-600 italic mb-4">"{{ $testi['quote'] }}"</p>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 bg-indigo-200 rounded-full flex items-center justify-center font-bold text-indigo-700">
                                            {{ substr($testi['name'], 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900">{{ $testi['name'] }}</div>
                                            <div class="text-xs text-gray-500">{{ $testi['designation'] }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                {{-- 6. FAQS --}}
                @if($course->faqs)
                    <section>
                        <h3 class="text-2xl font-bold mb-6">Frequently Asked Questions</h3>
                        <div class="space-y-4" x-data="{ active: null }">
                            @foreach($course->faqs as $key => $faq)
                                <div class="border border-gray-200 rounded-xl overflow-hidden">
                                    <button @click="active = active === {{ $key }} ? null : {{ $key }}"
                                        class="w-full flex justify-between items-center p-4 bg-white text-left font-bold text-gray-800 hover:bg-gray-50">
                                        <span>{{ $faq['question'] }}</span>
                                        <svg :class="{'rotate-180': active === {{ $key }}}"
                                            class="w-5 h-5 text-gray-400 transition-transform" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <div x-show="active === {{ $key }}"
                                        class="p-4 bg-gray-50 text-gray-600 border-t border-gray-100">
                                        {{ $faq['answer'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>

            {{-- SIDEBAR: ENROLL FORM --}}
            <div class="lg:col-span-1">
                <div id="enroll" class="bg-white p-6 rounded-2xl shadow-xl border border-indigo-100 sticky top-24">
                    <h3 class="text-xl font-bold mb-2">Ready to Start?</h3>
                    <p class="text-gray-500 mb-6 text-sm">Enroll in our {{ $course->title }} today.</p>

                    <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="type" value="Enroll: {{ $course->title }}">

                        @if(session('success'))
                            <div class="bg-green-100 text-green-700 p-3 rounded text-sm mb-4">{{ session('success') }}</div>
                        @endif

                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Full Name</label>
                            <input type="text" name="name" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Phone Number</label>
                            <input type="tel" name="phone" required
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Preferred Batch</label>
                            <select name="message"
                                class="w-full px-4 py-3 rounded-lg bg-gray-50 border border-gray-200 focus:border-indigo-500 outline-none">
                                <option value="Crash Course (4 Weeks)">Crash Course (4 Weeks)</option>
                                <option value="Comprehensive (12 Weeks)">Comprehensive (12 Weeks)</option>
                            </select>
                        </div>

                        <button type="submit"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-indigo-200">
                            Secure My Spot
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4">No payment required today.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection