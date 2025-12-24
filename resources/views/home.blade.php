@extends('layouts.app')

@section('content')

    {{-- 1. HERO SECTION (Dynamic Slider with Fallback) --}}
    @if(isset($sliders) && $sliders->count() > 0)
        {{-- If sliders exist in DB, show the Animated Slider --}}
        <x-hero-slider :sliders="$sliders" />
    @else
        {{-- FALLBACK: Show original static design if no sliders are active --}}
        <div class="relative bg-gray-900 min-h-[600px] flex items-center">
            <div class="absolute inset-0 z-0">
                @if(isset($settings) && $settings->hero_image)
                    <img src="{{ Storage::url($settings->hero_image) }}" class="w-full h-full object-cover opacity-40">
                @else
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1600&auto=format&fit=crop" class="w-full h-full object-cover opacity-30">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-transparent to-transparent"></div>
            </div>

            <div class="max-w-[1400px] mx-auto px-4 relative z-10 text-center md:text-left grid md:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <span class="inline-block py-1 px-3 rounded bg-secondary/20 text-secondary border border-secondary text-sm font-bold mb-4 uppercase tracking-wider">
                        #1 Study Abroad Consultancy
                    </span>
                    <h1 class="text-5xl md:text-6xl font-extrabold mb-6 leading-tight">
                        {{ $settings->hero_title ?? 'Shape Your Future Globally' }}
                    </h1>
                    <p class="text-xl text-gray-300 mb-8 max-w-lg">
                        {{ $settings->hero_description ?? 'Expert guidance for university admissions, visas, and scholarships in UK, USA, Canada & Australia.' }}
                    </p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start">
                        <a href="{{ route('countries.index') }}" class="bg-primary hover:bg-blue-600 text-white px-8 py-4 rounded-lg font-bold text-lg transition shadow-lg shadow-blue-900/50">
                            Find Universities
                        </a>
                        <a href="{{ route('contact') }}" class="bg-white hover:bg-gray-100 text-gray-900 px-8 py-4 rounded-lg font-bold text-lg transition flex items-center justify-center gap-2">
                            <span>Free Counseling</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                
                <div class="hidden md:block relative">
                    <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl text-white max-w-sm mx-auto transform rotate-2 hover:rotate-0 transition duration-500">
                        <h3 class="text-2xl font-bold mb-2">Fast Track Your Visa</h3>
                        <p class="text-gray-300 mb-6 text-sm">98% success rate in student visa applications for the last 5 years.</p>
                        <div class="flex items-center gap-4">
                            <div class="flex -space-x-4">
                                <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=1" alt="">
                                <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=2" alt="">
                                <img class="w-10 h-10 rounded-full border-2 border-gray-900" src="https://i.pravatar.cc/100?img=3" alt="">
                            </div>
                            <span class="font-bold text-sm">Join 10,000+ Students</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- 2. STATS SECTION --}}
    <div class="bg-primary text-white py-12 relative z-20">
        <div class="max-w-[1400px] mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-white/20">
            <div>
                <span class="block text-4xl font-bold mb-1">500+</span>
                <span class="text-blue-100 text-sm font-medium uppercase tracking-wide">Universities</span>
            </div>
            <div>
                <span class="block text-4xl font-bold mb-1">10k+</span>
                <span class="text-blue-100 text-sm font-medium uppercase tracking-wide">Students Placed</span>
            </div>
            <div>
                <span class="block text-4xl font-bold mb-1">15+</span>
                <span class="text-blue-100 text-sm font-medium uppercase tracking-wide">Years Experience</span>
            </div>
            <div>
                <span class="block text-4xl font-bold mb-1">100%</span>
                <span class="text-blue-100 text-sm font-medium uppercase tracking-wide">Support</span>
            </div>
        </div>
    </div>

    {{-- 3. SERVICES SECTION --}}
<section class="py-20 bg-blue-50 overflow-hidden">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            {{-- Left Column: Title, Text, and Side Image --}}
            <div class="lg:col-span-5 relative z-10">
                <div class="mb-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">Our Services</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        We help you explore top study abroad destinations, offering diverse programs and guidance every step of the way to ensure an unforgettable educational journey.
                    </p>
                </div>
                
                {{-- 
                    SIDE IMAGE PLACEHOLDER 
                    Please replace 'img/services-side.png' with your actual image path.
                --}}
                <div class="hidden lg:block relative">
                    {{-- Optional decorative blob/blur effect behind the image --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[400px] h-[400px] bg-blue-200/50 rounded-full blur-3xl -z-10"></div>
                    
                    <img src="{{ asset('img/services-side.png') }}" alt="Student with Globe" class="w-full max-w-md mx-auto object-contain drop-shadow-xl transform hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            {{-- Right Column: Service Cards Grid --}}
            <div class="lg:col-span-7">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($services as $index => $service)
                        {{-- Color Cycling Logic for Icons --}}
                        @php
                            $colors = [
                                ['bg' => 'bg-blue-100', 'text' => 'text-blue-600'],
                                ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
                                ['bg' => 'bg-red-100', 'text' => 'text-red-600'],
                                ['bg' => 'bg-green-100', 'text' => 'text-green-600'],
                                ['bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
                                ['bg' => 'bg-orange-100', 'text' => 'text-orange-600'],
                            ];
                            $color = $colors[$index % count($colors)];
                        @endphp

                        <div class="bg-white p-8 rounded-3xl shadow-sm hover:shadow-md transition-all duration-300 group border border-gray-100/50">
                            {{-- Icon --}}
                            <div class="w-16 h-16 {{ $color['bg'] }} {{ $color['text'] }} rounded-2xl flex items-center justify-center mb-6 transition-transform group-hover:scale-110 duration-300">
                                @if($service->icon)
                                    <img src="{{ Storage::url($service->icon) }}" class="w-8 h-8">
                                @else
                                    {{-- Default Icon --}}
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                @endif
                            </div>
                            
                            {{-- Title & Description --}}
                            <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $service->title }}</h3>
                            <p class="text-gray-600 mb-6 text-sm leading-relaxed line-clamp-3">{{ $service->short_description }}</p>
                            
                            {{-- Read More Link --}}
                            <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center gap-2 text-primary font-bold text-sm group/link">
                                <span class="hover:underline">Read More</span>
                                <svg class="w-4 h-4 transition-transform duration-300 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
{{-- AFFILIATE UNIVERSITIES SCROLLING SECTION --}}
@if($affiliates->isNotEmpty())
<section class="py-10 bg-white border-b border-gray-100 overflow-hidden">
    <div class="container mx-auto px-4 mb-6 text-center">
        <p class="text-sm font-bold text-gray-500 uppercase tracking-widest">Trusted by Top Universities</p>
    </div>

    {{-- Swiper Container --}}
    <div class="swiper affiliateSwiper">
        <div class="swiper-wrapper transition-timing-function-linear">
            @foreach($affiliates as $affiliate)
                <div class="swiper-slide !w-auto px-8 md:px-12 flex items-center justify-center grayscale hover:grayscale-0 transition duration-300 opacity-60 hover:opacity-100">
                    @if($affiliate->url)
                        <a href="{{ $affiliate->url }}" target="_blank" title="{{ $affiliate->name }}">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($affiliate->logo) }}" 
                                 alt="{{ $affiliate->name }}" 
                                 class="h-12 md:h-16 w-auto object-contain max-w-[150px]">
                        </a>
                    @else
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($affiliate->logo) }}" 
                             alt="{{ $affiliate->name }}" 
                             class="h-12 md:h-16 w-auto object-contain max-w-[150px]">
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Inline Script for Continuous Linear Scroll --}}
<style>
    /* Ensures the animation is perfectly linear (no starting/stopping) */
    .swiper-wrapper.transition-timing-function-linear {
        transition-timing-function: linear !important;
    }
</style>

@endif
   {{-- 5. TOP DESTINATIONS (Slider Mode) --}}
<section class="py-20 bg-white">
    <div class="max-w-[1400px] mx-auto px-4">
        
        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Discover Your Ideal <br> Study Destination</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                We work collaboratively with students to provide tailored solutions for their study abroad needs.
            </p>
        </div>

        {{-- Swiper Container --}}
        <div class="relative px-4 md:px-8">
            <div class="swiper destinations-slider !pb-16"> {{-- Added padding bottom for arrows --}}
                <div class="swiper-wrapper">
                    @foreach($countries as $country)
                    <div class="swiper-slide h-auto">
                        {{-- Destination Card --}}
                        <div class="bg-white border border-gray-100 rounded-[2rem] overflow-hidden hover:shadow-xl transition-all duration-300 h-full flex flex-col group">
                            
                            {{-- Image Container --}}
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ $country->cover_image ? Storage::url($country->cover_image) : 'https://source.unsplash.com/random/600x400/?'.$country->name }}" 
                                     alt="{{ $country->name }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                                
                                {{-- Overlay (Optional) --}}
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                            </div>

                            {{-- Content Body --}}
                            <div class="p-6 flex flex-col flex-grow bg-gray-50/50 group-hover:bg-white transition-colors">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $country->name }}</h3>
                                
                                <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                                    Studying in {{ $country->name }} is an experience. Here's why {{ $country->name }} isn't just a place to study, but a place to grow.
                                </p>
                                
                                <a href="{{ route('countries.show', $country->slug) }}" class="inline-flex items-center text-primary font-bold text-sm hover:underline mt-auto group/btn">
                                    Read More 
                                    <svg class="w-4 h-4 ml-1 transform transition-transform group-hover/btn:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                {{-- Pagination (Dots) --}}
                <div class="swiper-pagination destination-pagination"></div>
            </div>

            {{-- Custom Navigation Arrows (Centered Below) --}}
            <div class="flex justify-center items-center gap-4 mt-4">
                <div class="destination-prev w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white hover:border-primary cursor-pointer transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                
                {{-- Slide Count (Optional: 1 / 4) --}}
                <div class="text-sm font-medium text-gray-400 tracking-widest">
                    <span class="current-slide-num text-gray-900">1</span> / <span class="total-slides-num">{{ count($countries) }}</span>
                </div>

                <div class="destination-next w-12 h-12 rounded-full border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-primary hover:text-white hover:border-primary cursor-pointer transition-all shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </div>
            </div>

        </div>
    </div>
</section>

    {{-- 5. FEATURED PROGRAMS --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Featured Programs</h2>
                <p class="text-gray-500 mt-2">Popular courses with high career potential</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($featured_courses as $course)
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300 flex flex-col">
                    <div class="h-32 bg-gray-200 relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-blue-800 opacity-90"></div>
                        <div class="absolute bottom-4 left-4 flex items-center gap-3">
                            <div class="w-12 h-12 bg-white rounded-lg p-1 shadow-md">
                                @if($course->university && $course->university->logo)
                                    <img src="{{ Storage::url($course->university->logo) }}" class="w-full h-full object-contain">
                                @else
                                    <span class="w-full h-full flex items-center justify-center font-bold text-gray-400 text-xs">LOGO</span>
                                @endif
                            </div>
                            <div class="text-white">
                                <p class="text-xs opacity-75 uppercase tracking-wider">{{ $course->university->country->name ?? 'International' }}</p>
                                <p class="font-bold text-sm leading-tight">{{ $course->university->name ?? 'University' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded uppercase">{{ $course->level }}</span>
                        </div>
                        <h3 class="text-lg font-bold mb-2 line-clamp-2 hover:text-primary transition">
                            <a href="{{ route('universities.show', $course->university->slug ?? '#') }}">{{ $course->title }}</a>
                        </h3>
                        
                        <div class="mt-auto pt-6 border-t border-gray-100 flex items-center justify-between">
                            <div>
                                <span class="block text-xs text-gray-400">Tuition Fee</span>
                                <span class="font-bold text-primary">{{ $course->currency }} {{ number_format($course->tuition_fee) }}</span>
                            </div>
                            <a href="{{ route('contact') }}?subject={{ $course->title }}" class="text-sm font-semibold text-gray-600 hover:text-primary">
                                Inquire &rarr;
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- LATEST BLOGS SECTION --}}
@if(isset($latest_blogs) && $latest_blogs->count() > 0)
<section class="py-20 bg-[#003B99] relative overflow-hidden text-white">
    
    {{-- Background Wave Pattern --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 1440 800" fill="none">
            <path d="M-100 800C200 700 400 200 800 400C1200 600 1400 100 1540 0" stroke="url(#grad1)" stroke-width="2" stroke-dasharray="10 10"/>
            <defs>
                <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="0%">
                    <stop offset="0%" style="stop-color:#4F46E5;stop-opacity:1" />
                    <stop offset="100%" style="stop-color:#EC4899;stop-opacity:1" />
                </linearGradient>
            </defs>
        </svg>
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-900/30 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <div class="max-w-[1400px] mx-auto">
            
            {{-- HEADER ROW --}}
            <div class="grid lg:grid-cols-12 gap-12 mb-12 items-center">
                <div class="lg:col-span-5">
                    <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-8">
                        Insights, Inspiration,<br>
                        <span class="text-gray-400">and Innovation.</span>
                    </h2>
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 bg-yellow-400 text-gray-900 font-bold px-8 py-3 rounded-full hover:bg-yellow-500 transition shadow-lg transform hover:scale-105">
                        More Articles
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>

                {{-- FEATURED POST (First Item) --}}
                <div class="lg:col-span-7">
                    @php $featured = $latest_blogs->first(); @endphp
                    @if($featured)
                    <div class="bg-[#003B99] border border-white/5 rounded-3xl p-6 md:p-8 hover:border-white/20 transition duration-500 group relative overflow-hidden">
                        {{-- Hover Glow Effect --}}
                        <div class="absolute top-0 right-0 w-32 h-32 bg-yellow-400/10 rounded-full blur-2xl -mr-16 -mt-16 transition group-hover:bg-yellow-400/20"></div>

                        <div class="flex items-center justify-between mb-6 text-sm text-gray-400 relative z-10">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-700 border border-white/10">
                                    <img src="{{ optional($featured->author)->avatar ? Storage::url($featured->author->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(optional($featured->author)->name ?? 'Admin') }}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="font-semibold text-white leading-none">{{ optional($featured->author)->name ?? 'Admin' }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Author</p>
                                </div>
                            </div>
                            <span class="bg-white/5 px-3 py-1 rounded-full">{{ $featured->created_at->format('M d, Y') }}</span>
                        </div>

                        <div class="rounded-2xl overflow-hidden mb-6 h-64 md:h-80 w-full relative">
                            <img src="{{ Storage::url($featured->image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#003B99] via-transparent to-transparent opacity-60"></div>
                        </div>

                        <h3 class="text-2xl md:text-3xl font-bold mb-4 group-hover:text-yellow-400 transition leading-tight">
                            <a href="{{ route('blog.show', $featured->slug) }}">
                                {{ $featured->title }}
                            </a>
                        </h3>
                        
                        <p class="text-gray-400 mb-6 line-clamp-2">{{ Str::limit(strip_tags($featured->content), 120) }}</p>

                        <a href="{{ route('blog.show', $featured->slug) }}" class="inline-flex items-center text-yellow-400 font-bold hover:text-yellow-300 transition tracking-wide">
                            READ MORE <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            {{-- REMAINING POSTS GRID --}}
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($latest_blogs->skip(1) as $blog)
                <div class="bg-[#003B99] border border-white/5 rounded-3xl p-6 hover:border-white/20 transition duration-500 group flex flex-col h-full">
                    
                    {{-- Image --}}
                    <div class="rounded-xl overflow-hidden mb-5 h-48 w-full relative">
                        <img src="{{ Storage::url($blog->image) }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                        <div class="absolute top-3 right-3 bg-black/50 backdrop-blur-sm px-3 py-1 rounded-lg text-xs font-bold text-white">
                            {{ $blog->created_at->format('M d') }}
                        </div>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-xl font-bold mb-3 line-clamp-2 group-hover:text-yellow-400 transition leading-snug">
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            {{ $blog->title }}
                        </a>
                    </h3>

                    {{-- Author --}}
                    <div class="mt-auto pt-4 border-t border-white/5 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <div class="w-6 h-6 rounded-full overflow-hidden bg-gray-700">
                                <img src="{{ optional($blog->author)->avatar ? Storage::url($blog->author->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(optional($blog->author)->name ?? 'Admin') }}" class="w-full h-full object-cover">
                            </div>
                            <span class="text-xs font-semibold text-gray-400">{{ optional($blog->author)->name ?? 'Admin' }}</span>
                        </div>
                        
                        <a href="{{ route('blog.show', $blog->slug) }}" class="w-8 h-8 rounded-full bg-white/5 flex items-center justify-center text-yellow-400 hover:bg-yellow-400 hover:text-[#003B99] transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </div>
</section>
@endif

    {{-- 6. TESTIMONIALS --}}
    <section class="py-20 bg-white">
        <div class="max-w-[1400px] mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16">What Students Say</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($testimonials as $testi)
                <div class="bg-gray-50 p-8 rounded-2xl relative">
                    <div class="absolute -top-4 -left-4 w-10 h-10 bg-secondary text-white flex items-center justify-center rounded-full text-xl font-serif">
                        "
                    </div>
                    
                    <p class="text-gray-600 italic mb-6 leading-relaxed">"{{ $testi->content }}"</p>
                    
                    <div class="flex items-center gap-4 border-t border-gray-200 pt-6">
                        <div class="w-12 h-12 bg-gray-300 rounded-full overflow-hidden">
                            @if($testi->avatar)
                                <img src="{{ Storage::url($testi->avatar) }}" class="w-full h-full object-cover">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ $testi->name }}&background=random" class="w-full h-full">
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $testi->name }}</h4>
                            <span class="text-xs text-primary font-bold">{{ $testi->designation }}</span>
                        </div>
                        <div class="ml-auto flex text-yellow-400 text-sm">
                            @for($i=0; $i < $testi->rating; $i++) ★ @endfor
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
{{-- 
    9. GLOBAL SCRIPT 
    Initializes ALL sliders in one place to avoid conflicts.
--}}
@if(!isset($sliders) || $sliders->count() === 0)
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // 1. Affiliate Ticker
        const affiliateSwiper = new Swiper(".affiliateSwiper", {
            slidesPerView: "auto",
            spaceBetween: 0,
            loop: true,
            speed: 5000, 
            allowTouchMove: false,
            autoplay: { delay: 0, disableOnInteraction: false },
        });

        // 2. Destinations Slider
        const destinationSwiper = new Swiper(".destinations-slider", {
            slidesPerView: 1,
            spaceBetween: 24,
            loop: true,
            observer: true,
            observeParents: true,
            autoplay: { delay: 4000, disableOnInteraction: false, pauseOnMouseEnter: true },
            navigation: { nextEl: ".destination-next", prevEl: ".destination-prev" },
            pagination: { el: ".destination-pagination", clickable: true, dynamicBullets: true },
            breakpoints: {
                640: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 24 },
                1024: { slidesPerView: 4, spaceBetween: 24 },
            },
            on: {
                slideChange: function () {
                    const currentEl = document.querySelector('.current-slide-num');
                    if(currentEl) currentEl.innerText = this.realIndex + 1;
                }
            }
        });

        // 3. Testimonial Slider
        const testimonialSwiper = new Swiper(".testimonial-slider", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            observer: true,
            observeParents: true,
            autoplay: { delay: 5000, disableOnInteraction: false, pauseOnMouseEnter: true },
            pagination: { el: ".testimonial-pagination", clickable: true },
            breakpoints: {
                640: { slidesPerView: 1, spaceBetween: 20 },
                768: { slidesPerView: 2, spaceBetween: 30 },
                1024: { slidesPerView: 3, spaceBetween: 30 },
            },
        });
    });
</script>
@endsection