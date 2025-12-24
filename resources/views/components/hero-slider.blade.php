@props(['sliders'])

{{-- Clean Pro Hero Slider --}}
<div class="relative w-full h-[500px] md:h-[600px] lg:h-[700px] overflow-hidden group bg-gray-900">

    <div class="swiper proHeroSwiper w-full h-full">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide relative w-full h-full flex items-center justify-center">

                    {{-- Background Image --}}
                    <div class="slide-bg absolute inset-0 will-change-transform">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url($slider->image_path) }}"
                            alt="{{ $slider->title }}" class="w-full h-full object-cover">
                    </div>

                    {{-- Gradient Overlay --}}
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-blue-900/90 via-blue-800/70 to-purple-900/40 mix-blend-multiply z-10">
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 via-transparent to-transparent z-10">
                    </div>

                    {{-- Animated Pattern Overlay --}}
                    <div class="absolute inset-0 opacity-10 z-10 pattern-overlay"></div>

                    {{-- Content Container --}}
                    <div
                        class="relative z-20 mx-auto w-[95%] max-w-[1400px] px-4 sm:px-6 flex items-center min-h-full pt-40 md:pt-48 pb-12 md:pb-20">
                        <div class="max-w-3xl text-white">

                            {{-- Subtitle --}}
                            @if($slider->subtitle)
                                <div class="overflow-hidden mb-3 md:mb-4">
                                    <span
                                        class="slide-subtitle inline-block text-secondary font-bold tracking-[0.2em] uppercase text-xs md:text-sm lg:text-base bg-gradient-to-r from-blue-500/20 to-purple-500/20 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 shadow-lg"
                                        data-animation="random">
                                        <span class="relative z-10">{{ $slider->subtitle }}</span>
                                    </span>
                                </div>
                            @endif

                            {{-- Title --}}
                            <div class="overflow-hidden mb-4 md:mb-6">
                                <h1 class="slide-title text-4xl md:text-5xl lg:text-7xl font-black leading-tight tracking-tight drop-shadow-2xl"
                                    data-animation="random">
                                    <span
                                        class="bg-gradient-to-r from-white via-gray-100 to-gray-300 bg-clip-text text-transparent">
                                        {{ $slider->title }}
                                    </span>
                                </h1>
                            </div>

                            {{-- Description --}}
                            @if($slider->description)
                                <div class="overflow-hidden mb-6 md:mb-8">
                                    <p class="slide-desc text-gray-200 text-base md:text-lg lg:text-xl leading-relaxed font-light drop-shadow-lg max-w-2xl"
                                        data-animation="random">
                                        {{ $slider->description }}
                                    </p>
                                </div>
                            @endif

                            {{-- CTA Button --}}
                            @if($slider->button_text)
                                <div class="slide-btn flex flex-wrap gap-3 md:gap-4" data-animation="random">
                                    <a href="{{ $slider->button_link }}"
                                        class="group relative inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-3 px-6 md:py-4 md:px-8 rounded-full shadow-2xl shadow-blue-900/50 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-blue-500/50 overflow-hidden">
                                        <span class="relative z-10">{{ $slider->button_text }}</span>
                                        <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1 relative z-10"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                        <span
                                            class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Navigation Buttons --}}
        <div
            class="hidden md:flex absolute top-1/2 left-0 right-0 -translate-y-1/2 z-30 justify-between px-6 lg:px-12 pointer-events-none">
            <div
                class="swiper-button-prev-pro group cursor-pointer w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-blue-600 hover:border-blue-500 transition-all duration-300 shadow-2xl hover:scale-110 pointer-events-auto">
                <svg class="w-6 h-6 lg:w-7 lg:h-7 transition-transform group-hover:-translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                </svg>
            </div>
            <div
                class="swiper-button-next-pro group cursor-pointer w-14 h-14 lg:w-16 lg:h-16 rounded-full bg-white/10 backdrop-blur-xl border border-white/20 flex items-center justify-center text-white hover:bg-blue-600 hover:border-blue-500 transition-all duration-300 shadow-2xl hover:scale-110 pointer-events-auto">
                <svg class="w-6 h-6 lg:w-7 lg:h-7 transition-transform group-hover:translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    /* Background Zoom Animation */
    .slide-bg img {
        transition: transform 8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        object-fit: cover;
        width: 100%;
        height: 100%;
    }

    .swiper-slide-active .slide-bg img {
        transform: scale(1.1);
    }

    /* Random Image Animations */
    .swiper-slide-active .slide-bg.anim-zoom-rotate img {
        transform: scale(1.15) rotate(2deg);
    }

    .swiper-slide-active .slide-bg.anim-zoom-left img {
        transform: scale(1.12) translateX(-20px);
    }

    .swiper-slide-active .slide-bg.anim-zoom-right img {
        transform: scale(1.12) translateX(20px);
    }

    .swiper-slide-active .slide-bg.anim-zoom-up img {
        transform: scale(1.1) translateY(-15px);
    }

    /* Pattern Overlay Animation */
    .pattern-overlay {
        background-image:
            repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(255, 255, 255, .03) 10px, rgba(255, 255, 255, .03) 20px),
            repeating-linear-gradient(-45deg, transparent, transparent 10px, rgba(255, 255, 255, .03) 10px, rgba(255, 255, 255, .03) 20px);
        animation: patternMove 20s linear infinite;
    }

    @keyframes patternMove {
        0% {
            transform: translate(0, 0);
        }

        100% {
            transform: translate(50px, 50px);
        }
    }

    /* Text Animations */
    .slide-subtitle,
    .slide-title,
    .slide-desc,
    .slide-btn {
        opacity: 0;
        transition: all 0.8s cubic-bezier(0.22, 1, 0.36, 1);
    }

    /* Fade Up */
    [data-animation].anim-fadeUp {
        transform: translateY(30px);
    }

    .swiper-slide-active [data-animation].anim-fadeUp {
        opacity: 1;
        transform: translateY(0);
    }

    /* Fade Down */
    [data-animation].anim-fadeDown {
        transform: translateY(-30px);
    }

    .swiper-slide-active [data-animation].anim-fadeDown {
        opacity: 1;
        transform: translateY(0);
    }

    /* Fade Left */
    [data-animation].anim-fadeLeft {
        transform: translateX(50px);
    }

    .swiper-slide-active [data-animation].anim-fadeLeft {
        opacity: 1;
        transform: translateX(0);
    }

    /* Fade Right */
    [data-animation].anim-fadeRight {
        transform: translateX(-50px);
    }

    .swiper-slide-active [data-animation].anim-fadeRight {
        opacity: 1;
        transform: translateX(0);
    }

    /* Zoom In */
    [data-animation].anim-zoomIn {
        transform: scale(0.8);
    }

    .swiper-slide-active [data-animation].anim-zoomIn {
        opacity: 1;
        transform: scale(1);
    }

    /* Flip In X */
    [data-animation].anim-flipX {
        transform: perspective(1000px) rotateX(-90deg);
    }

    .swiper-slide-active [data-animation].anim-flipX {
        opacity: 1;
        transform: perspective(1000px) rotateX(0);
    }

    /* Bounce In */
    [data-animation].anim-bounceIn {
        transform: scale(0.3);
    }

    .swiper-slide-active [data-animation].anim-bounceIn {
        opacity: 1;
        animation: bounceIn 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0.3);
            opacity: 0;
        }

        50% {
            transform: scale(1.05);
        }

        70% {
            transform: scale(0.9);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Slide Rotate In */
    [data-animation].anim-slideRotate {
        transform: translateX(-100px) rotate(-10deg);
    }

    .swiper-slide-active [data-animation].anim-slideRotate {
        opacity: 1;
        transform: translateX(0) rotate(0);
    }

    /* Stagger delays for elements */
    .swiper-slide-active .slide-subtitle {
        transition-delay: 0.2s;
    }

    .swiper-slide-active .slide-title {
        transition-delay: 0.4s;
    }

    .swiper-slide-active .slide-desc {
        transition-delay: 0.6s;
    }

    .swiper-slide-active .slide-btn {
        transition-delay: 0.8s;
    }

    /* Scroll Down Animation */
    @keyframes scroll {
        0% {
            transform: translateY(0);
            opacity: 0;
        }

        40% {
            opacity: 1;
        }

        80% {
            transform: translateY(12px);
            opacity: 0;
        }

        100% {
            opacity: 0;
        }
    }

    .animate-scroll {
        animation: scroll 2s cubic-bezier(0.65, 0, 0.35, 1) infinite;
    }

    /* Ensure images cover full area */
    .slide-bg {
        overflow: hidden;
    }

    .slide-bg img {
        min-width: 100%;
        min-height: 100%;
        object-position: center;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation options for text elements
        const textAnimations = [
            'anim-fadeUp',
            'anim-fadeDown',
            'anim-fadeLeft',
            'anim-fadeRight',
            'anim-zoomIn',
            'anim-flipX',
            'anim-bounceIn',
            'anim-slideRotate'
        ];

        // Animation options for background images
        const imageAnimations = [
            'anim-zoom-rotate',
            'anim-zoom-left',
            'anim-zoom-right',
            'anim-zoom-up',
            ''
        ];

        // Store original animations to avoid changing them
        const slideAnimations = new Map();

        // Apply random animations to original slides only once
        function applyInitialAnimations() {
            const originalSlides = document.querySelectorAll('.swiper-slide:not(.swiper-slide-duplicate)');
            
            originalSlides.forEach((slide, index) => {
                // Random image animation
                const bgDiv = slide.querySelector('.slide-bg');
                const randomImgAnim = imageAnimations[Math.floor(Math.random() * imageAnimations.length)];
                
                // Store animations for this slide
                const animations = {
                    image: randomImgAnim,
                    elements: []
                };

                if (randomImgAnim) {
                    bgDiv.classList.add(randomImgAnim);
                }

                // Random text animations for each element
                slide.querySelectorAll('[data-animation="random"]').forEach(element => {
                    const randomTextAnim = textAnimations[Math.floor(Math.random() * textAnimations.length)];
                    element.classList.add(randomTextAnim);
                    animations.elements.push({
                        element: element.className.split(' ')[0], // Get base class
                        animation: randomTextAnim
                    });
                });

                slideAnimations.set(index, animations);
            });
        }

        // Apply stored animations to duplicate slides
        function syncDuplicateSlides() {
            const duplicateSlides = document.querySelectorAll('.swiper-slide-duplicate');
            
            duplicateSlides.forEach(slide => {
                const slideIndex = parseInt(slide.getAttribute('data-swiper-slide-index'));
                const storedAnims = slideAnimations.get(slideIndex);
                
                if (storedAnims) {
                    // Apply image animation
                    const bgDiv = slide.querySelector('.slide-bg');
                    if (storedAnims.image) {
                        bgDiv.classList.add(storedAnims.image);
                    }

                    // Apply text animations
                    slide.querySelectorAll('[data-animation="random"]').forEach((element, idx) => {
                        if (storedAnims.elements[idx]) {
                            element.classList.add(storedAnims.elements[idx].animation);
                        }
                    });
                }
            });
        }

        // Apply initial animations
        applyInitialAnimations();

        // Transition effects for slides
        const transitions = [
            { effect: 'fade', fadeEffect: { crossFade: true } },
            { effect: 'slide' }
        ];

        // Initialize Swiper
        let currentTransition = transitions[Math.floor(Math.random() * transitions.length)];

        const proSwiper = new Swiper(".proHeroSwiper", {
            loop: true,
            ...currentTransition,
            speed: 1200,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next-pro",
                prevEl: ".swiper-button-prev-pro",
            },
            keyboard: {
                enabled: true,
            },
            on: {
                init: function() {
                    // Sync animations to duplicate slides after init
                    syncDuplicateSlides();
                },
                slideChangeTransitionEnd: function() {
                    const newTransition = transitions[Math.floor(Math.random() * transitions.length)];
                    Object.assign(this.params, newTransition);
                    this.update();
                }
            }
        });
    });
</script>