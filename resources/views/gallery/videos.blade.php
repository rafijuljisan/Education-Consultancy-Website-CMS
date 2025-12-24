@extends('layouts.app')

@section('content')

{{-- Video Grid --}}
<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($videos as $video)
            @php
                // --- ROBUST YOUTUBE ID EXTRACTOR ---
                // This regex handles: youtube.com/watch?v=ID, youtu.be/ID, youtube.com/embed/ID
                $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
                preg_match($pattern, $video->video_url, $matches);
                
                // If ID found, create embed link. If not, fallback to null.
                $videoId = $matches[1] ?? null;
                $embedUrl = $videoId ? "https://www.youtube.com/embed/$videoId" : null;
            @endphp

            <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition">
                <div class="aspect-w-16 aspect-h-9 bg-black relative">
                    @if($embedUrl)
                        <iframe src="{{ $embedUrl }}" 
                                class="w-full h-64" 
                                title="{{ $video->title }}"
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    @else
                        {{-- Fallback if URL is invalid --}}
                        <div class="w-full h-64 flex items-center justify-center text-white bg-gray-800">
                            <span>Video Unavailable</span>
                        </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-900 line-clamp-2">{{ $video->title }}</h3>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection