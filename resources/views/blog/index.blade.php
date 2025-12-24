@extends('layouts.app')

@section('content')

{{-- 
    Wrapper
    - pt-5: Consistent top spacing.
    - pb-10: Consistent bottom spacing.
--}}
<div class="w-full bg-white pt-5 pb-10">
    
    {{-- Container: Strictly 1400px max width --}}
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        
        {{-- Orange Banner --}}
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- Decorative Line Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern-blog" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-blog)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                
                {{-- Title --}}
                <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">
                    Latest News & Articles
                </h1>

                {{-- Description --}}
                <p class="text-lg md:text-xl text-white/90 mb-6 max-w-2xl mx-auto font-medium">
                    Stay updated with study abroad trends and guides
                </p>
                
                {{-- Breadcrumbs --}}
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <span>Blog</span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <a href="{{ route('blog.show', $post->slug) }}" class="group block bg-white rounded-2xl shadow-sm hover:shadow-xl transition border border-gray-100 overflow-hidden">
            <div class="h-56 overflow-hidden bg-gray-200 relative">
                @if($post->thumbnail)
                    <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                @endif
                
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm">
                    {{ $post->published_at->format('M d, Y') }}
                </div>
            </div>

            <div class="p-6">
                <h2 class="text-xl font-bold mb-3 group-hover:text-primary transition line-clamp-2">
                    {{ $post->title }}
                </h2>
                <div class="text-gray-600 mb-4 line-clamp-3 text-sm">
                    {!! Str::limit(strip_tags($post->content), 100) !!}
                </div>
                <span class="text-primary font-semibold text-sm">Read Article &rarr;</span>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-12">
        {{ $posts->links() }}
    </div>
</div>

@endsection