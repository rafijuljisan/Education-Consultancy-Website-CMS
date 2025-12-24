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
    <section class="py-20 bg-gray-50">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">How We Help You</h2>
                <div class="h-1 w-20 bg-primary mx-auto mt-4 rounded"></div>
            </div>
            
            <div class="grid md:grid-cols-4 gap-8">
                @foreach($services as $service)
                <div class="bg-white p-8 rounded-2xl shadow-sm hover:shadow-xl transition duration-300 border-b-4 border-transparent hover:border-primary group">
                    <div class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition">
                        @if($service->icon)
                            <img src="{{ Storage::url($service->icon) }}" class="w-8 h-8">
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold mb-3">{{ $service->title }}</h3>
                    <p class="text-gray-600 mb-4 text-sm leading-relaxed line-clamp-3">{{ $service->short_description }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="text-primary font-bold text-sm hover:underline flex items-center gap-1">
                        Learn More <span>&rarr;</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 4. TOP DESTINATIONS --}}
    <section class="py-20 bg-white">
        <div class="max-w-[1400px] mx-auto px-4">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">Top Destinations</h2>
                    <p class="text-gray-500 mt-2">Explore the world's best education hubs</p>
                </div>
                <a href="{{ route('countries.index') }}" class="hidden md:inline-flex items-center text-primary font-bold hover:underline">
                    View All Countries <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                @foreach($countries as $country)
                <a href="{{ route('countries.show', $country->slug) }}" class="group relative overflow-hidden rounded-2xl h-80 block shadow-lg">
                    <img src="{{ $country->cover_image ? Storage::url($country->cover_image) : 'https://source.unsplash.com/random/400x600/?'.$country->name }}" 
                         class="w-full h-full object-cover transition duration-700 group-hover:scale-110 group-hover:brightness-75">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent p-6 flex flex-col justify-end">
                        <div class="transform translate-y-2 group-hover:translate-y-0 transition duration-300">
                            <h3 class="text-white text-2xl font-bold mb-1 flex items-center gap-2">
                                {{ $country->name }}
                            </h3>
                            <p class="text-gray-300 text-sm opacity-0 group-hover:opacity-100 transition duration-300 delay-100">
                                {{ $country->universities_count ?? '0' }} Universities Listed
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
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

@endsection