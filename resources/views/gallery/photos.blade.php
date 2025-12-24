@extends('layouts.app')

@section('content')

{{-- 1. Import GLightbox CSS --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

{{-- Photo Grid --}}
<div class="bg-gray-50 py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleries as $image)
                {{-- Lightbox Link Wrapper --}}
                {{-- CHANGED: Replaced 'aspect-square' with 'aspect-[4/3]' --}}
                <a href="{{ Storage::url($image->image_path) }}" 
                   class="glightbox group relative aspect-[4/3] overflow-hidden rounded-xl cursor-pointer block"
                   data-gallery="campus-gallery"
                   data-title="{{ $image->title }}">
                    
                    <img src="{{ Storage::url($image->image_path) }}" 
                         class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                    
                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center p-4 text-center">
                        <p class="text-white font-bold">{{ $image->title }}</p>
                        <span class="absolute bottom-4 text-xs text-gray-300 uppercase tracking-wider">Click to view</span>
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