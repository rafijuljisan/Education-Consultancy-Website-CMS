@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<div class="w-full bg-white pt-5 pb-10">
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- Decorative Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern-contact" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-contact)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                <h1 class="text-3xl md:text-5xl font-bold mb-4 tracking-tight">Contact Us</h1>
                <p class="text-lg md:text-xl text-white/90 mb-6 max-w-2xl mx-auto font-medium">
                    We are here to help you with your study abroad journey
                </p>
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <span>Contact Us</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MAIN CONTACT CONTENT GRID --}}
<div class="max-w-[1400px] mx-auto px-4 py-16 grid lg:grid-cols-2 gap-16">

    {{-- Left Side: Contact Info & Map --}}
    <div class="flex flex-col">
        <div class="mb-10">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Get in Touch</h2>
            <p class="text-gray-600 mb-8">
                Have questions about visas, universities, or scholarships? Our team of experts is ready to assist you.
            </p>

            <div class="space-y-6">
                {{-- PHONE --}}
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Phone</h3>
                        <p class="text-gray-600">{{ $settings->contact_phone ?? 'Not Available' }}</p>
                        <p class="text-gray-500 text-sm">Mon-Fri 9am to 6pm</p>
                    </div>
                </div>

                {{-- EMAIL --}}
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Email</h3>
                        <p class="text-gray-600">{{ $settings->contact_email ?? 'info@example.com' }}</p>
                    </div>
                </div>

                {{-- ADDRESS --}}
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-primary flex-shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900">Office</h3>
                        <p class="text-gray-600">
                            {!! nl2br(e($settings->contact_address ?? 'Address not set')) !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- INTEGRATED GOOGLE MAP --}}
        <div class="flex-grow min-h-[300px] w-full rounded-2xl overflow-hidden shadow-inner border border-gray-100 grayscale hover:grayscale-0 transition duration-700">
            @if($settings->google_map_code)
                {!! $settings->google_map_code !!}
            @else
                <div class="h-full bg-gray-100 w-full flex items-center justify-center text-gray-400">
                    Google Map not configured.
                </div>
            @endif
        </div>
    </div>

    {{-- Right Side: Contact Form --}}
    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 h-fit sticky top-10">
        <h3 class="text-xl font-bold mb-6">Send us a Message</h3>
        <form action="{{ route('inquiry.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="type" value="Contact Page">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input type="tel" name="phone" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                <textarea name="message" rows="5" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-primary outline-none"></textarea>
            </div>
            <button type="submit" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition shadow-lg mt-2">
                Send Message
            </button>
        </form>
    </div>
</div>

<style>
    /* Force the Google Map iframe to fill its container */
    iframe { width: 100% !important; height: 100% !important; border: 0; min-height: 300px; }
</style>

@endsection