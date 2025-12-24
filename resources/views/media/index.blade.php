@extends('layouts.app')

@section('content')

<div class="bg-gray-900 py-20 text-center text-white">
    <h1 class="text-4xl font-bold mb-4">Campus Life & Events</h1>
    <p class="text-xl text-gray-300">Explore our student success stories and university tours</p>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="flex items-center gap-4 mb-8">
        <h2 class="text-3xl font-bold text-gray-900">Video Tour</h2>
        <div class="h-1 flex-grow bg-gray-200 rounded"></div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($videos as $video)
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition">
            <div class="aspect-w-16 aspect-h-9 bg-black">
                {{-- We assume the user pastes a standard YouTube URL. 
                     We need to simple embed logic or just use iframe if they pasted an embed code. 
                     For simplicity, we use a helper to turn 'watch?v=' into 'embed/' --}}
                
                @php
                    // Simple helper to convert standard YouTube URL to Embed URL
                    $embedUrl = str_replace('watch?v=', 'embed/', $video->video_url);
                    $embedUrl = str_replace('vimeo.com/', 'player.vimeo.com/video/', $embedUrl);
                @endphp

                <iframe src="{{ $embedUrl }}" 
                        class="w-full h-64" 
                        title="{{ $video->title }}"
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            </div>
            <div class="p-4">
                <h3 class="font-bold text-lg text-gray-900 line-clamp-2">{{ $video->title }}</h3>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="bg-gray-50 py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        <div class="flex items-center gap-4 mb-8">
            <h2 class="text-3xl font-bold text-gray-900">Photo Gallery</h2>
            <div class="h-1 flex-grow bg-gray-200 rounded"></div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach($galleries as $image)
            <div class="group relative aspect-square overflow-hidden rounded-xl cursor-pointer">
                <img src="{{ Storage::url($image->image_path) }}" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center p-4 text-center">
                    <p class="text-white font-bold">{{ $image->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection