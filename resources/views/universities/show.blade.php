@extends('layouts.app')

@section('content')

<div class="bg-white border-b">
    <div class="max-w-[1400px] mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-32 h-32 bg-gray-50 rounded-xl border flex items-center justify-center p-4 shadow-sm">
                @if($university->logo)
                    <img src="{{ Storage::url($university->logo) }}" class="max-w-full max-h-full">
                @else
                    <span class="text-3xl font-bold text-gray-300">{{ substr($university->name, 0, 1) }}</span>
                @endif
            </div>

            <div class="text-center md:text-left flex-1">
                <div class="flex items-center justify-center md:justify-start gap-2 text-sm font-bold text-primary mb-2 uppercase tracking-wide">
                    <a href="{{ route('countries.show', $university->country->slug) }}" class="hover:underline">
                        {{ $university->country->name }}
                    </a>
                    <span>/</span>
                    <span>{{ $university->city ?? 'Campus' }}</span>
                </div>
                <h1 class="text-4xl font-extrabold text-gray-900 mb-2">{{ $university->name }}</h1>
                @if($university->ranking)
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full font-bold">
                        ★ Global Ranking: #{{ $university->ranking }}
                    </span>
                @endif
            </div>

            <div>
                <a href="#courses" class="bg-primary text-white px-8 py-4 rounded-full font-bold shadow-lg hover:bg-blue-700 transition">
                    Browse Courses
                </a>
            </div>
        </div>
    </div>
</div>

<div id="courses" class="bg-gray-50 py-16">
    <div class="max-w-[1400px] mx-auto px-4">
        <h2 class="text-2xl font-bold mb-8">Available Programs</h2>

        <div class="grid md:grid-cols-1 gap-6">
            @forelse($university->courses as $course)
            <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col md:flex-row items-center justify-between gap-6">
                
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold uppercase">
                            {{ $course->level }}
                        </span>
                        @if($course->duration)
                        <span class="text-gray-500 text-xs flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $course->duration }}
                        </span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-500 mt-1">
                        Intake: {{ $course->intake_months ?? 'Flexible' }}
                    </p>
                </div>

                <div class="text-center md:text-right flex flex-col items-center md:items-end gap-2">
                    @if($course->tuition_fee)
                    <div>
                        <span class="block text-xs text-gray-400 uppercase">Tuition Fee</span>
                        <span class="text-xl font-bold text-gray-900">
                            {{ $course->currency }} {{ number_format($course->tuition_fee) }}
                        </span>
                    </div>
                    @endif
                    
                    <a href="{{ route('contact') }}?subject=Inquiry for {{ $course->title }} at {{ $university->name }}" 
                       class="text-sm font-bold text-primary hover:underline">
                        Inquire Now &rarr;
                    </a>
                </div>

            </div>
            @empty
            <div class="text-center py-12 text-gray-500">
                <p>No courses listed for this university yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

@endsection