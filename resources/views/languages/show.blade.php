@extends('layouts.app')

@section('content')

    <div class="max-w-[1400px] mx-auto px-4 py-16 grid md:grid-cols-3 gap-12">
        <div class="md:col-span-2">
            @if($course->thumbnail)
                <img src="{{ Storage::url($course->thumbnail) }}" class="w-full h-80 object-cover rounded-2xl mb-8 shadow-sm">
            @endif

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $course->title }}</h1>
            <div class="flex flex-wrap gap-4 mb-8">
                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-lg text-sm font-bold">⏱ Duration:
                    {{ $course->duration }}</span>
                <span class="bg-green-50 text-green-700 px-3 py-1 rounded-lg text-sm font-bold">📅 Batch:
                    {{ $course->batch_type }}</span>
                <span class="bg-orange-50 text-orange-700 px-3 py-1 rounded-lg text-sm font-bold">📍 Mode:
                    {{ $course->mode }}</span>
            </div>

            <div class="prose max-w-none text-gray-700">
                {!! $course->content !!}
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100 sticky top-24">
                <h3 class="text-xl font-bold mb-4">Enroll Now</h3>
                @if($course->fee)
                    <div class="text-3xl font-bold text-indigo-600 mb-6">${{ number_format($course->fee) }}</div>
                @endif

                <p class="text-gray-600 mb-6 text-sm">Fill out the form to reserve your seat for the upcoming batch.</p>

                <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="type" value="Enroll: {{ $course->title }}">

                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-3 rounded text-sm mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <input type="text" name="name" required placeholder="Full Name"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 outline-none focus:border-indigo-500">
                    <input type="email" name="email" required placeholder="Email Address"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 outline-none focus:border-indigo-500">
                    <input type="tel" name="phone" placeholder="Phone Number"
                        class="w-full px-4 py-3 rounded-lg border border-gray-300 outline-none focus:border-indigo-500">
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg transition">
                        Book My Seat
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection