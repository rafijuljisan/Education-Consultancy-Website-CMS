@extends('layouts.app')

@section('content')

{{-- Reading Time Calculation --}}
@php
    $wordCount = str_word_count(strip_tags($post->content));
    $readTime = ceil($wordCount / 200); // Average reading speed 200 wpm
    $shareUrl = urlencode(url()->current());
    $shareTitle = urlencode($post->title);
@endphp

{{-- 1. PROGRESS BAR --}}
<div class="fixed top-0 left-0 h-1 bg-blue-600 z-[100]" id="progressBar" style="width: 0%"></div>

<div class="bg-gray-50 min-h-screen pb-20">
    
    {{-- 2. HERO HEADER --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-[1400px] mx-auto px-4 py-12 md:py-20">
            {{-- Breadcrumb --}}
            <nav class="flex text-sm text-gray-500 mb-6 space-x-2">
                <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Home</a>
                <span>/</span>
                <a href="{{ route('blog.index') }}" class="hover:text-blue-600 transition">Blog</a>
                <span>/</span>
                <span class="text-gray-900 font-medium truncate max-w-[200px]">{{ $post->title }}</span>
            </nav>

            {{-- Title & Meta --}}
            <div class="max-w-4xl">
                {{-- Main Page Title (H1) --}}
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 mb-8 leading-tight tracking-tight">
                    {{ $post->title }}
                </h1>
                
                <div class="flex flex-wrap items-center gap-6 text-sm md:text-base text-gray-600">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-lg">
                            {{ substr($settings->site_name ?? 'A', 0, 1) }}
                        </div>
                        <span class="font-medium text-gray-900">By {{ $settings->site_name ?? 'Admin' }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span>{{ $post->published_at->format('F d, Y') }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ $readTime }} min read</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. MAIN CONTENT GRID --}}
    <div class="max-w-[1400px] mx-auto px-4 py-12 grid lg:grid-cols-12 gap-12">
        
        {{-- LEFT COLUMN: Social Share (Desktop) --}}
        <div class="hidden lg:block lg:col-span-1">
            <div class="sticky top-32 flex flex-col gap-4">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 text-center">Share</p>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition shadow-lg hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" class="w-10 h-10 rounded-full bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition shadow-lg hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" class="w-10 h-10 rounded-full bg-blue-700 text-white flex items-center justify-center hover:bg-blue-800 transition shadow-lg hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path><circle cx="4" cy="4" r="2"></circle></svg>
                </a>
                <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link copied!');" class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center hover:bg-gray-300 transition shadow-sm hover:-translate-y-1" title="Copy Link">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                </button>
            </div>
        </div>

        {{-- CENTER COLUMN: Post Content --}}
        <div class="col-span-12 lg:col-span-8">
            
            @if($post->thumbnail)
                <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-12 group">
                    <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-[300px] md:h-[500px] object-cover transform transition duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            @endif

            {{-- 
                FIXED: Added 'custom-prose' class and explicit style block below 
                to force H1, H2, H3 sizes to be larger and distinct.
            --}}
            <article class="prose prose-lg md:prose-xl prose-blue max-w-none bg-white p-8 md:p-12 rounded-3xl shadow-sm border border-gray-100 custom-prose">
                {!! $post->content !!}
            </article>

            {{-- Mobile Share --}}
            <div class="lg:hidden mt-8 flex gap-4 justify-center">
                <span class="font-bold text-gray-600 self-center">Share:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" class="p-3 bg-blue-600 text-white rounded-full"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg></a>
                <a href="https://whatsapp.com/send?text={{ $shareTitle }}%20{{ $shareUrl }}" class="p-3 bg-green-500 text-white rounded-full"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>
            </div>

            {{-- Author Bio --}}
            <div class="mt-12 bg-white border border-gray-100 p-8 rounded-2xl flex flex-col md:flex-row items-center gap-6 text-center md:text-left shadow-sm">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center text-3xl font-bold text-blue-600 flex-shrink-0">
                    {{ substr($settings->site_name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">About the Author</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Expert education consultants at {{ $settings->site_name ?? 'Open Window' }}. We help students navigate the complex world of international education, visas, and university admissions.
                    </p>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Sidebar --}}
        <div class="col-span-12 lg:col-span-3 space-y-8">
            
            {{-- Search Widget --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <form action="{{ route('search') }}" method="GET">
                    <div class="relative">
                        <input type="text" name="q" placeholder="Search articles..." class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </form>
            </div>

            {{-- Recent Posts --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="font-bold text-lg text-gray-900 mb-6 flex items-center gap-2">
                    <span class="w-1 h-6 bg-blue-600 rounded-full"></span>
                    Recent Updates
                </h3>
                <div class="space-y-6">
                    @foreach($recent_posts as $recent)
                    <a href="{{ route('blog.show', $recent->slug) }}" class="flex gap-4 group items-start">
                        <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden relative">
                            @if($recent->thumbnail)
                                <img src="{{ Storage::url($recent->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-gray-900 group-hover:text-blue-600 transition line-clamp-2 leading-snug mb-1">
                                {{ $recent->title }}
                            </h4>
                            <span class="text-xs text-gray-400">{{ $recent->published_at->format('M d, Y') }}</span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Sticky CTA --}}
            <div class="sticky top-32">
                <div class="bg-gradient-to-br from-blue-900 to-blue-700 p-8 rounded-3xl text-center text-white shadow-xl relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
                    <h4 class="font-bold text-2xl mb-2 relative z-10">Start Your Journey</h4>
                    <p class="text-blue-100 text-sm mb-6 relative z-10 opacity-90">Get free expert counseling for your visa and university application.</p>
                    <button onclick="toggleAppointmentModal()" class="w-full bg-yellow-400 hover:bg-yellow-500 text-blue-900 font-bold py-3.5 rounded-xl transition shadow-lg transform hover:-translate-y-1 relative z-10 flex items-center justify-center gap-2">
                        <span>Book Free Session</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    // Scroll Progress Bar Logic
    window.onscroll = function() {
        var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        var scrolled = (winScroll / height) * 100;
        document.getElementById("progressBar").style.width = scrolled + "%";
    };
</script>

{{-- CUSTOM STYLES TO FIX HEADINGS --}}
<style>
    /* Force Heading Sizes */
    .custom-prose h1 {
        font-size: 2.25rem !important; /* 36px */
        line-height: 2.5rem !important;
        font-weight: 800 !important;
        color: #111827;
        margin-top: 2em !important;
        margin-bottom: 1em !important;
    }
    
    .custom-prose h2 {
        font-size: 1.875rem !important; /* 30px */
        line-height: 2.25rem !important;
        font-weight: 700 !important;
        color: #1e40af !important; /* Dark Blue */
        margin-top: 2em !important;
        margin-bottom: 1em !important;
        border-bottom: 2px solid #eff6ff;
        padding-bottom: 0.5em;
    }

    .custom-prose h3 {
        font-size: 1.5rem !important; /* 24px */
        line-height: 2rem !important;
        font-weight: 600 !important;
        color: #374151;
        margin-top: 1.5em !important;
        margin-bottom: 0.75em !important;
    }

    .custom-prose p {
        margin-bottom: 1.5em !important;
        line-height: 1.8 !important;
    }

    /* Fix image rounding inside prose */
    .custom-prose img {
        border-radius: 1rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
    }
</style>

@endsection