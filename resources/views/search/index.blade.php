@extends('layouts.app')

@section('content')

<div class="bg-gray-100 py-12 border-b">
    <div class="max-w-[1400px] mx-auto px-4">
        <h1 class="text-3xl font-bold text-gray-900">
            Search Results for "<span class="text-primary">{{ $query }}</span>"
        </h1>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-12 space-y-12">

    @if($countries->count() > 0)
    <div>
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Destinations</h2>
        <div class="grid md:grid-cols-4 gap-6">
            @foreach($countries as $country)
            <a href="{{ route('countries.show', $country->slug) }}" class="group block bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden border border-gray-100">
                <div class="h-40 bg-gray-200 relative">
                    <img src="{{ $country->cover_image ? Storage::url($country->cover_image) : 'https://source.unsplash.com/random/400x300/?'.$country->name }}" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition"></div>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary flex items-center gap-2">
                        @if($country->flag_image)
                            <img src="{{ Storage::url($country->flag_image) }}" class="w-6 h-6 rounded-full">
                        @endif
                        {{ $country->name }}
                    </h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($universities->count() > 0)
    <div>
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Universities</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($universities as $uni)
            <a href="{{ route('universities.show', $uni->slug) }}" class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-16 h-16 bg-gray-50 rounded-lg flex items-center justify-center border flex-shrink-0">
                    @if($uni->logo)
                        <img src="{{ Storage::url($uni->logo) }}" class="max-w-full max-h-full p-1">
                    @else
                        <span class="font-bold text-gray-300 text-xl">{{ substr($uni->name, 0, 1) }}</span>
                    @endif
                </div>
                <div>
                    <h3 class="font-bold text-gray-900 line-clamp-1">{{ $uni->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $uni->city }}, {{ $uni->country->name ?? '' }}</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    @if($courses->count() > 0)
    <div>
        <h2 class="text-2xl font-bold mb-6 border-b pb-2">Courses & Programs</h2>
        <div class="grid md:grid-cols-1 gap-4">
            @foreach($courses as $course)
            <div class="bg-white p-6 rounded-xl border border-gray-100 flex flex-col md:flex-row justify-between items-center hover:border-primary transition group shadow-sm">
                <div>
                    <h3 class="font-bold text-lg text-gray-900 group-hover:text-primary">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        <span class="font-semibold text-gray-700">{{ $course->university->name ?? 'Unknown Uni' }}</span> 
                        • {{ $course->level }}
                    </p>
                </div>
                <a href="{{ route('universities.show', $course->university->slug ?? '#') }}" class="mt-4 md:mt-0 text-primary font-bold text-sm bg-blue-50 px-4 py-2 rounded-lg hover:bg-blue-100 transition">
                    View Details &rarr;
                </a>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($services->count() > 0 || $posts->count() > 0)
    <div class="grid md:grid-cols-2 gap-8">
        @if($services->count() > 0)
        <div>
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Services</h2>
            <ul class="space-y-3">
                @foreach($services as $service)
                <li>
                    <a href="{{ route('services.show', $service->slug) }}" class="flex items-center gap-2 text-gray-700 hover:text-primary hover:translate-x-1 transition">
                        <svg class="w-4 h-4 text-secondary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        {{ $service->title }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif

        @if($posts->count() > 0)
        <div>
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Articles</h2>
            <ul class="space-y-3">
                @foreach($posts as $post)
                <li>
                    <a href="{{ route('blog.show', $post->slug) }}" class="group block">
                        <span class="block text-gray-800 font-medium group-hover:text-primary transition">{{ $post->title }}</span>
                        <span class="text-xs text-gray-400">{{ $post->published_at->format('M d, Y') }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    @endif

    @if($countries->isEmpty() && $universities->isEmpty() && $courses->isEmpty() && $services->isEmpty() && $posts->isEmpty())
    <div class="text-center py-20">
        <div class="text-6xl mb-4">🔍</div>
        <h2 class="text-2xl font-bold text-gray-900">No results found for "{{ $query }}"</h2>
        <p class="text-gray-500 mt-2">Try searching for specific countries (e.g. "UK"), degrees (e.g. "MBA"), or universities.</p>
        <div class="mt-8">
            <a href="{{ route('home') }}" class="bg-gray-900 text-white px-6 py-3 rounded-lg font-bold hover:bg-gray-800 transition">Back to Home</a>
        </div>
    </div>
    @endif

</div>

@endsection