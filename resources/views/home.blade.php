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
                    
                    <img src="{{ asset('storage/about/student-with-glob.png') }}" alt="Student with Globe" class="w-full max-w-md mx-auto object-contain drop-shadow-xl transform hover:scale-105 transition-transform duration-500">
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
    {{-- LATEST BLOGS SECTION - REDESIGNED --}}
@if(isset($latest_blogs) && $latest_blogs->count() > 0)
<section class="py-20 bg-[#003B99] relative overflow-hidden">
    
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        {{-- Floating Circles --}}
        <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400/10 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-400/10 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute top-1/2 left-1/3 w-64 h-64 bg-yellow-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 opacity-[0.02]" style="background-image: radial-gradient(circle, #000 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>

    <div class="container mx-auto px-4 md:px-6 relative z-10">
        <div class="max-w-[1400px] mx-auto">
            
            {{-- SECTION HEADER --}}
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white text-sm font-bold rounded-full mb-4 shadow-lg animate-bounce-subtle">
                    LATEST INSIGHTS
                </span>
                <h2 class="text-4xl md:text-6xl font-black mb-6 text-white leading-tight">
                    Stories That Inspire<br>Your Journey
                </h2>
                <p class="text-lg text-white/80 max-w-2xl mx-auto">
                    Explore expert insights, success stories, and trending topics in international education
                </p>
            </div>

            {{-- FEATURED POST (HERO STYLE) --}}
            @php $featured = $latest_blogs->first(); @endphp
            @if($featured)
            <div class="mb-16">
                <a href="{{ route('blog.show', $featured->slug) }}" class="group block">
                    <div class="grid lg:grid-cols-2 gap-8 bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border-4 border-transparent hover:border-blue-500/20 transition-all duration-500 hover:shadow-blue-500/20 hover:-translate-y-2">
                        
                        {{-- Image Side --}}
                        <div class="relative h-[400px] lg:h-full overflow-hidden">
                            <img src="{{ asset('storage/' . ($featured->thumbnail ?? $featured->image)) }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 group-hover:rotate-2 transition duration-700">
                            
                            {{-- Overlay Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            
                            {{-- Featured Badge --}}
                            <div class="absolute top-6 left-6 flex items-center gap-2 bg-yellow-400 text-gray-900 px-4 py-2 rounded-full font-bold text-sm shadow-xl animate-pulse-slow">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                Featured
                            </div>

                            {{-- Date Badge --}}
                            <div class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full text-sm font-bold text-gray-900 shadow-lg">
                                {{ $featured->created_at->format('M d, Y') }}
                            </div>
                        </div>

                        {{-- Content Side --}}
                        <div class="p-8 lg:p-12 flex flex-col justify-center">
                            
                            {{-- Category Tag --}}
                            <span class="inline-block w-fit px-4 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full mb-4 uppercase tracking-wider">
                                Must Read
                            </span>

                            {{-- Title --}}
                            <h3 class="text-3xl md:text-4xl font-black mb-6 text-gray-900 group-hover:text-blue-600 transition leading-tight">
                                {{ $featured->title }}
                            </h3>

                            {{-- Excerpt --}}
                            <p class="text-gray-600 text-lg mb-6 leading-relaxed line-clamp-3">
                                {{ Str::limit(strip_tags($featured->content), 180) }}
                            </p>

                            {{-- Author & CTA --}}
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="{{ optional($featured->author)->avatar ? asset('storage/' . $featured->author->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(optional($featured->author)->name ?? 'Admin').'&background=3B82F6&color=fff' }}" 
                                         class="w-12 h-12 rounded-full border-2 border-blue-200">
                                    <div>
                                        <p class="font-bold text-gray-900">{{ optional($featured->author)->name ?? 'Admin' }}</p>
                                        <p class="text-xs text-gray-500">5 min read</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2 text-blue-600 font-bold group-hover:gap-4 transition-all">
                                    <span>Read Story</span>
                                    <svg class="w-5 h-5 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            {{-- REMAINING POSTS GRID - MODERN CARDS --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($latest_blogs->skip(1) as $index => $blog)
                <a href="{{ route('blog.show', $blog->slug) }}" class="group block">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 border-2 border-transparent hover:border-blue-200 hover:-translate-y-3 h-full flex flex-col">
                        
                        {{-- Image with Overlay --}}
                        <div class="relative h-64 overflow-hidden">
                            <img src="{{ asset('storage/' . ($blog->thumbnail ?? $blog->image)) }}" 
                                 class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            
                            {{-- Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            {{-- Date Badge --}}
                            <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full text-xs font-bold text-gray-900 shadow-lg flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-blue-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                {{ $blog->created_at->format('M d') }}
                            </div>

                            {{-- Color Accent (Different for each card) --}}
                            @php
                                $colors = ['from-blue-500', 'from-purple-500', 'from-pink-500', 'from-orange-500', 'from-green-500'];
                                $color = $colors[$index % count($colors)];
                            @endphp
                            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r {{ $color }} to-transparent transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex-1 flex flex-col">
                            
                            {{-- Title --}}
                            <h3 class="text-xl font-bold mb-3 text-gray-900 group-hover:text-blue-600 transition line-clamp-2 leading-tight">
                                {{ $blog->title }}
                            </h3>

                            {{-- Excerpt --}}
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed flex-1">
                                {{ Str::limit(strip_tags($blog->content), 100) }}
                            </p>

                            {{-- Footer --}}
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                {{-- Author --}}
                                <div class="flex items-center gap-2">
                                    <img src="{{ optional($blog->author)->avatar ? asset('storage/' . $blog->author->avatar) : 'https://ui-avatars.com/api/?name='.urlencode(optional($blog->author)->name ?? 'Admin').'&background=random' }}" 
                                         class="w-8 h-8 rounded-full border-2 border-gray-200">
                                    <span class="text-xs font-semibold text-gray-700">{{ optional($blog->author)->name ?? 'Admin' }}</span>
                                </div>

                                {{-- Arrow Icon --}}
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all transform group-hover:scale-110">
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- VIEW ALL BUTTON --}}
            <div class="text-center mt-16">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold px-10 py-5 rounded-full shadow-2xl hover:shadow-blue-500/50 transition-all duration-300 transform hover:scale-105 group">
                    <span class="text-lg">Explore All Articles</span>
                    <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- Custom Animations --}}
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    @keyframes float-delayed {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-30px) rotate(-5deg); }
    }

    @keyframes pulse-slow {
        0%, 100% { opacity: 0.6; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }

    @keyframes bounce-subtle {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .animate-float {
        animation: float 8s ease-in-out infinite;
    }

    .animate-float-delayed {
        animation: float-delayed 10s ease-in-out infinite;
    }

    .animate-pulse-slow {
        animation: pulse-slow 4s ease-in-out infinite;
    }

    .animate-bounce-subtle {
        animation: bounce-subtle 2s ease-in-out infinite;
    }
</style>
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
    PLACE THIS AT THE VERY BOTTOM OF home.blade.php
    AFTER the testimonials section, BEFORE @endsection
--}}

{{-- Only load Swiper if hero slider didn't load it --}}
@if(!isset($sliders) || $sliders->count() === 0)
    @once
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @endonce
@endif

<script>
(function() {
    'use strict';
    
    function initOtherSliders() {
        // Check if Swiper is loaded
        if (typeof Swiper === 'undefined') {
            setTimeout(initOtherSliders, 100);
            return;
        }

        // Wait for hero slider to initialize first (if exists)
        const hasHeroSlider = document.querySelector('.proHeroSwiper');
        const delay = hasHeroSlider ? 200 : 0;

        setTimeout(function() {
            
            // 1. Affiliate Ticker
            const affiliateEl = document.querySelector(".affiliateSwiper");
            if (affiliateEl) {
                new Swiper(".affiliateSwiper", {
                    slidesPerView: "auto",
                    spaceBetween: 0,
                    loop: true,
                    speed: 5000, 
                    allowTouchMove: false,
                    autoplay: { delay: 0, disableOnInteraction: false },
                });
            }

            // 2. Destinations Slider
            const destinationEl = document.querySelector(".destinations-slider");
            if (destinationEl) {
                new Swiper(".destinations-slider", {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    loop: true,
                    observer: true,
                    observeParents: true,
                    autoplay: { 
                        delay: 4000, 
                        disableOnInteraction: false, 
                        pauseOnMouseEnter: true 
                    },
                    navigation: { 
                        nextEl: ".destination-next", 
                        prevEl: ".destination-prev" 
                    },
                    pagination: { 
                        el: ".destination-pagination", 
                        clickable: true, 
                        dynamicBullets: true 
                    },
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
            }

            // 3. Testimonial Slider (if you add it later)
            const testimonialEl = document.querySelector(".testimonial-slider");
            if (testimonialEl) {
                new Swiper(".testimonial-slider", {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    loop: true,
                    observer: true,
                    observeParents: true,
                    autoplay: { 
                        delay: 5000, 
                        disableOnInteraction: false, 
                        pauseOnMouseEnter: true 
                    },
                    pagination: { 
                        el: ".testimonial-pagination", 
                        clickable: true 
                    },
                    breakpoints: {
                        640: { slidesPerView: 1, spaceBetween: 20 },
                        768: { slidesPerView: 2, spaceBetween: 30 },
                        1024: { slidesPerView: 3, spaceBetween: 30 },
                    },
                });
            }
            
        }, delay);
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initOtherSliders);
    } else {
        initOtherSliders();
    }
})();
</script>

@endsection