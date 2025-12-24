@extends('layouts.app')

@section('content')

    <div class="relative h-[400px] flex items-center justify-center text-center text-white bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img src="{{ $country->cover_image ? Storage::url($country->cover_image) : 'https://source.unsplash.com/random/1200x600/?' . $country->name }}"
                class="w-full h-full object-cover brightness-50">
        </div>

        <div class="relative z-10 container px-4">
            <span
                class="inline-block py-1 px-3 rounded bg-white/20 backdrop-blur text-sm font-bold mb-4 uppercase tracking-wider">
                Study In
            </span>
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6">{{ $country->name }}</h1>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-4 py-16 grid md:grid-cols-3 gap-12">

        <div class="md:col-span-2 space-y-12">
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    About {{ $country->name }}
                </h2>
                <div class="prose max-w-none text-gray-600">
                    {!! $country->details !!}
                </div>
            </div>

            <div>
                <h2 class="text-2xl font-bold mb-6">Top Universities in {{ $country->name }}</h2>
                <div class="space-y-4">
                    @forelse($country->universities as $uni)
                        <div
                            class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition flex flex-col md:flex-row items-center gap-6">
                            <div
                                class="w-24 h-24 flex-shrink-0 bg-gray-50 rounded-lg flex items-center justify-center p-2 border">
                                @if($uni->logo)
                                    <img src="{{ Storage::url($uni->logo) }}" class="max-w-full max-h-full">
                                @else
                                    <span class="font-bold text-gray-400 text-xs">{{ $uni->name }}</span>
                                @endif
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-xl font-bold text-gray-900">{{ $uni->name }}</h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    <span class="mr-3">📍 {{ $uni->city ?? 'Main Campus' }}</span>
                                    @if($uni->ranking)
                                        <span class="text-orange-500">★ Global Rank: #{{ $uni->ranking }}</span>
                                    @endif
                                </p>
                            </div>

                            <a href="{{ route('universities.show', $uni->slug) }}"
                                class="bg-gray-900 text-white px-6 py-3 rounded-lg font-semibold hover:bg-primary transition whitespace-nowrap">
                                View Courses
                            </a>
                        </div>
                    @empty
                        <div class="text-center py-10 bg-gray-50 rounded-xl">
                            <p class="text-gray-500">No universities listed for {{ $country->name }} yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-primary p-8 rounded-2xl text-white sticky top-24">
                <h3 class="text-2xl font-bold mb-2">Interested in {{ $country->name }}?</h3>
                <p class="mb-6 opacity-90">Fill out the form below and our expert counselors will contact you.</p>

                <form action="#" class="space-y-4">
                    <input type="text" placeholder="Your Name"
                        class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                    <input type="email" placeholder="Your Email"
                        class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                    <input type="tel" placeholder="Phone Number"
                        class="w-full px-4 py-3 rounded-lg text-gray-900 focus:outline-none">
                    <button
                        class="w-full bg-secondary hover:bg-yellow-500 text-white font-bold py-3 rounded-lg transition shadow-lg mt-2">
                        Get Free Advice
                    </button>
                </form>
            </div>
        </div>

    </div>

@endsection