@extends('layouts.app')

@section('content')

<div class="max-w-[1400px] mx-auto px-4 py-16 grid md:grid-cols-4 gap-12">
    
    <div class="md:col-span-3">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-primary">Home</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-primary">Blog</a>
            <span>/</span>
            <span class="text-gray-800">{{ Str::limit($post->title, 20) }}</span>
        </div>

        @if($post->thumbnail)
            <img src="{{ Storage::url($post->thumbnail) }}" class="w-full h-[400px] object-cover rounded-2xl mb-8 shadow-sm">
        @endif

        <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>
        <div class="text-gray-500 text-sm mb-8 border-b pb-8">
            Published on {{ $post->published_at->format('F d, Y') }}
        </div>

        <div class="prose max-w-none text-gray-800 leading-relaxed">
            {!! $post->content !!}
        </div>
    </div>

    <div class="md:col-span-1">
        <div class="sticky top-24">
            <h3 class="font-bold text-xl mb-6 text-gray-900">Recent Updates</h3>
            <div class="space-y-6">
                @foreach($recent_posts as $recent)
                <a href="{{ route('blog.show', $recent->slug) }}" class="flex gap-4 group">
                    <div class="w-20 h-20 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
                        @if($recent->thumbnail)
                            <img src="{{ Storage::url($recent->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                        @endif
                    </div>
                    <div>
                        <h4 class="font-bold text-sm text-gray-900 group-hover:text-primary transition line-clamp-2">
                            {{ $recent->title }}
                        </h4>
                        <span class="text-xs text-gray-500 mt-1 block">{{ $recent->published_at->format('M d, Y') }}</span>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="mt-12 bg-blue-50 p-6 rounded-xl border border-blue-100 text-center">
                <h4 class="font-bold text-lg mb-2">Apply for 2025 Intake</h4>
                <p class="text-sm text-gray-600 mb-4">Don't miss the deadline. Get free counseling today.</p>
                <a href="#contact" class="block w-full bg-primary text-white font-bold py-2 rounded-lg hover:bg-blue-700 transition">Contact Us</a>
            </div>
        </div>
    </div>

</div>

@endsection