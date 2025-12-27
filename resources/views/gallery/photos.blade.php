@extends('layouts.app')

@section('content')

{{-- 1. Import GLightbox CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<style>
    /* Scoped Masonry logic to avoid global conflicts */
    .masonry-wrapper {
        /* Adjust column count based on screen size */
        column-count: 2;
        column-gap: 1rem;
    }
    
    @media (min-width: 768px) {
        .masonry-wrapper {
            column-count: 3;
        }
    }
    
    @media (min-width: 1024px) {
        .masonry-wrapper {
            column-count: 4;
        }
    }

    .masonry-item {
        /* Prevents cards from breaking across columns */
        break-inside: avoid;
        margin-bottom: 1rem;
        display: block;
    }
</style>

{{-- Photo Grid --}}
<div class="bg-gray-50 py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        {{-- CHANGED: Switched from 'grid' to 'masonry-wrapper' --}}
        <div class="masonry-wrapper">
            @foreach($galleries as $image)
                {{-- Lightbox Link Wrapper --}}
                {{-- REMOVED: 'aspect-[4/3]' to allow natural portrait/landscape heights --}}
                <a href="{{ Storage::url($image->image_path) }}" 
                   class="glightbox masonry-item group relative overflow-hidden rounded-xl cursor-pointer"
                   data-gallery="campus-gallery"
                   data-title="{{ $image->title }}">
                    
                    {{-- CHANGED: Removed h-full and object-cover to respect natural image ratio --}}
                    <img src="{{ Storage::url($image->image_path) }}" 
                         alt="{{ $image->title }}"
                         class="w-full h-auto block transition duration-500 group-hover:scale-110">
                    
                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center p-4 text-center">
                        <p class="text-white font-bold">{{ $image->title }}</p>
                        <span class="mt-2 text-xs text-gray-300 uppercase tracking-wider">Click to view</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- 2. Import GLightbox JS and Initialize --}}
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        touchNavigation: true,
        loop: true,
        autoplayVideos: true
    });
</script>

@endsection