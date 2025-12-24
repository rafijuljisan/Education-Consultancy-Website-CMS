@extends('layouts.app')

@section('content')

<div class="bg-indigo-900 py-20 text-center text-white">
    <h1 class="text-4xl font-bold mb-4">Language Training & Prep</h1>
    <p class="text-xl text-indigo-200">Ace your IELTS, TOEFL, or learn a new language with us.</p>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid md:grid-cols-3 gap-8">
        @foreach($courses as $course)
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition border border-gray-100 overflow-hidden flex flex-col">
            <div class="h-48 bg-gray-200 relative">
                @if($course->thumbnail)
                    <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-indigo-50 text-indigo-300 font-bold text-2xl">
                        {{ substr($course->title, 0, 3) }}
                    </div>
                @endif
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold shadow-sm text-indigo-700">
                    {{ $course->mode }}
                </div>
            </div>
            
            <div class="p-6 flex-1 flex flex-col">
                <h2 class="text-2xl font-bold mb-2">{{ $course->title }}</h2>
                <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
                    <span>⏱ {{ $course->duration }}</span>
                    <span>📅 {{ $course->batch_type }}</span>
                </div>
                <p class="text-gray-600 mb-6 line-clamp-3 flex-1">
                    {{ $course->short_description }}
                </p>
                <a href="{{ route('languages.show', $course->slug) }}" class="block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition">
                    View Details
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection