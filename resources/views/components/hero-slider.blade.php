@props(['sliders'])

{{-- Clean Pro Hero Slider - Simplified --}}
<div class="relative w-full h-[510px] md:h-[610px] lg:h-[710px] overflow-hidden bg-gray-900">

    <div class="swiper proHeroSwiper w-full h-full">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide relative w-full h-full flex items-center justify-center">

                    {{-- Background Image --}}
                    <div class="slide-bg absolute inset-0">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($slider->image_path) }}"
                            alt="{{ $slider->title }}" class="w-full h-full object-cover">
                    </div>

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/70 to-purple-900/40 mix-blend-multiply z-10"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 via-transparent to-transparent z-10"></div>

                    {{-- Animated Pattern Overlay --}}
                    <div class="absolute inset-0 opacity-10 z-10 pattern-overlay"></div>

                    {{-- Content Container --}}
                    <div class="relative z-20 mx-auto w-[95%] max-w-[1400px] px-4 sm:px-6 flex items-center min-h-full pt-40 md:pt-48 pb-12 md:pb-20">
                        <div class="max-w-3xl text-white">

                            {{-- Subtitle --}}
                            @if($slider->subtitle)
                                <div class="overflow-hidden mb-3 md:mb-4">
                                    <span class="slide-subtitle inline-block text-secondary font-bold tracking-[0.2em] uppercase text-xs md:text-sm lg:text-base bg-gradient-to-r from-blue-500/20 to-purple-500/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 shadow-lg">
                                        <span class="relative z-10">{{ $slider->subtitle }}</span>
                                    </span>
                                </div>
                            @endif

                            {{-- Title --}}
                            <div class="overflow-hidden mb-4 md:mb-6">
                                <h1 class="slide-title text-4xl md:text-5xl lg:text-7xl font-black leading-tight tracking-tight drop-shadow-2xl">
                                    <span class="bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
                                        {{ $slider->title }}
                                    </span>
                                </h1>
                            </div>

                            {{-- Description --}}
                            @if($slider->description)
                                <div class="overflow-hidden mb-6 md:mb-8">
                                    <p class="slide-desc text-gray-200 text-base md:text-lg lg:text-xl leading-relaxed font-light drop-shadow-lg max-w-2xl">
                                        {{ $slider->description }}
                                    </p>
                                </div>
                            @endif

                            {{-- CTA Button --}}
                            @if($slider->button_text)
                                <div class="slide-btn flex flex-wrap gap-3 md:gap-4">
                                    <a href="{{ $slider->button_link }}" class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-full shadow-2xl shadow-blue-900/50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-blue-500/50 overflow-hidden">
                                        <span class="relative z-10">{{ $slider->button_text }}</span>
                                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                        <span class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Navigation Buttons --}}
        <div class="hidden md:flex absolute top-1/2 left-0 right-0 -translate-y-1/2 z-30 justify-between px-6 lg:px-12 pointer-events-none">
            <div class="swiper-button-prev-pro group cursor-pointer w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-blue-600 hover:border-blue-500 transition-all duration-300 shadow-2xl hover:scale-110 pointer-events-auto">
                <svg class="w-6 h-6 lg:w-7 lg:h-7 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </div>
            <div class="swiper-button-next-pro group cursor-pointer w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-blue-600 hover:border-blue-500 transition-all duration-300 shadow-2xl hover:scale-110 pointer-events-auto">
                <svg class="w-6 h-6 lg:w-7 lg:h-7 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
        </div>

        {{-- Scroll Down Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 animate-bounce hidden md:block">
            <div class="w-6 h-10 rounded-full border-2 border-white/50 flex items-start justify-center p-2">
                <div class="w-1 h-3 bg-white/80 rounded-full animate-scroll"></div>
            </div>
        </div>
    </div>
</div>

{{-- STYLES: Load once --}}
@once
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* Background Zoom Animation - Simple */
    .slide-bg img {
        transition: transform 8s ease-out;
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .swiper-slide-active .slide-bg img {
        transform: scale(1.1);
    }

    /* Pattern Overlay Animation */
    .pattern-overlay {
        background-image:
            repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255, 255, 255, .03) 10px, rgba(255, 255, 255, .03) 20px),
            repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(255, 255, 255, .03) 10px, rgba(255, 255, 255, .03) 20px);
        animation: patternMove 20s linear infinite;
    }

    @keyframes patternMove {
        0% { transform: translate(0, 0); }
        100% { transform: translate(50px, 50px); }
    }

    /* Simple Fade In Animation for Text */
    .slide-subtitle, .slide-title, .slide-desc, .slide-btn {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.8s ease-out;
    }

    .swiper-slide-active .slide-subtitle {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.2s;
    }

    .swiper-slide-active .slide-title {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.4s;
    }

    .swiper-slide-active .slide-desc {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.6s;
    }

    .swiper-slide-active .slide-btn {
        opacity: 1;
        transform: translateY(0);
        transition-delay: 0.8s;
    }

    /* Scroll Down Animation */
    @keyframes scroll {
        0% { transform: translateY(0); opacity: 0; }
        40% { opacity: 1; }
        80% { transform: translateY(12px); opacity: 0; }
        100% { opacity: 0; }
    }

    .animate-scroll {
        animation: scroll 2s ease-in-out infinite;
    }
</style>
@endonce

{{-- SCRIPT: Simple and Conflict-Free --}}
@once
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
(function() {
    'use strict';
    
    function initHeroSlider() {
        // Check if Swiper is loaded
        if (typeof Swiper === 'undefined') {
            console.log('Swiper not loaded, retrying...');
            setTimeout(initHeroSlider, 100);
            return;
        }

        // Check if element exists
        const swiperEl = document.querySelector('.proHeroSwiper');
        if (!swiperEl) {
            console.log('Hero slider element not found');
            return;
        }

        console.log('Initializing hero slider...');

        // Simple Swiper initialization
        const heroSwiper = new Swiper('.proHeroSwiper', {
            // Core settings
            loop: true,
            speed: 1000,
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            
            // Autoplay
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: false
            },
            
            // Navigation
            navigation: {
                nextEl: '.swiper-button-next-pro',
                prevEl: '.swiper-button-prev-pro',
            },
            
            // Keyboard
            keyboard: {
                enabled: true,
                onlyInViewport: true
            },
            
            // Accessibility
            a11y: {
                enabled: true
            },
            
            // Events
            on: {
                init: function() {
                    console.log('Hero slider initialized successfully');
                    console.log('Total slides:', this.slides.length);
                },
                slideChange: function() {
                    console.log('Slide changed to:', this.realIndex + 1);
                }
            }
        });

        // Store globally for debugging
        window.heroSwiper = heroSwiper;
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initHeroSlider);
    } else {
        initHeroSlider();
    }
})();
</script>
@endonce