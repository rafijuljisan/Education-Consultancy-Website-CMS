@extends('layouts.app')

@section('content')

{{-- 
    Wrapper
    - pt-5: Reduced top spacing to match your other pages.
    - pb-10: Consistent bottom spacing.
--}}
<div class="w-full bg-white pt-5 pb-10">
    
    {{-- Container: Strictly 1400px max width --}}
    <div class="max-w-[1400px] mx-auto px-4 md:px-6">
        
        {{-- Orange Banner --}}
        <div class="relative w-full bg-gradient-to-r from-[#FF6B35] to-[#FF4B2B] rounded-[30px] overflow-hidden shadow-xl">
            
            {{-- Decorative Line Pattern --}}
            <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <svg class="w-full h-full" viewBox="0 0 800 400" preserveAspectRatio="none">
                    <defs>
                        <pattern id="grid-pattern-service" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                        </pattern>
                    </defs>
                    <path d="M0,400 C200,300 100,50 400,0 L0,0 Z" fill="url(#grid-pattern-service)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 py-12 md:py-16 text-center text-white">
                
                {{-- Optional: Small "Service" Label (If you want to keep the original label) --}}
                <span class="inline-block mb-2 text-orange-100 font-bold tracking-wider uppercase text-xs bg-white/10 px-3 py-1 rounded-full">
                    Service
                </span>

                {{-- Dynamic Title --}}
                <h1 class="text-3xl md:text-5xl font-bold mb-3 tracking-tight">
                    {{ $service->title }}
                </h1>
                
                {{-- Breadcrumbs --}}
                <div class="flex items-center justify-center gap-2 text-sm md:text-base font-medium opacity-90">
                    <a href="/" class="hover:underline hover:text-gray-100 transition">Home</a>
                    <span>/</span>
                    <a href="{{ route('services.index') }}" class="hover:underline hover:text-gray-100 transition">Services</a>
                    <span>/</span>
                    <span class="truncate max-w-[200px]">{{ $service->title }}</span>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="max-w-[1400px] mx-auto px-4 py-16 grid md:grid-cols-3 gap-12">
    
    <div class="md:col-span-2">
        @if($service->icon)
            <img src="{{ Storage::url($service->icon) }}" class="w-full h-80 object-cover rounded-2xl mb-8 shadow-sm">
        @endif

        <div class="prose max-w-none text-gray-700">
            {!! $service->content !!}
        </div>
        
        <div class="mt-12 bg-blue-50 p-8 rounded-2xl border border-blue-100 flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-bold text-gray-900">Need help with {{ $service->title }}?</h3>
                <p class="text-gray-600 mt-1">Book a free session with our experts today.</p>
            </div>
            <a href="#contact" class="bg-primary hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-bold transition whitespace-nowrap">
                Book Consultation
            </a>
        </div>
    </div>

    <div class="md:col-span-1 space-y-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-lg mb-4 border-b pb-2">Other Services</h3>
            <ul class="space-y-3">
                @foreach($other_services as $other)
                <li>
                    <a href="{{ route('services.show', $other->slug) }}" class="block px-4 py-2 rounded-lg hover:bg-gray-50 hover:text-primary transition flex justify-between items-center group">
                        {{ $other->title }}
                        <span class="text-gray-300 group-hover:text-primary">&rarr;</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="bg-gray-900 text-white p-8 rounded-2xl text-center">
            <h3 class="text-xl font-bold mb-4">Have Questions?</h3>
            <p class="text-gray-400 mb-6">Call us directly to speak with a counselor.</p>
            <a href="tel:+1234567890" class="text-2xl font-bold text-secondary hover:text-white transition block mb-2">
                +1 (123) 456-7890
            </a>
            <span class="text-sm text-gray-500">Mon - Fri, 9am - 6pm</span>
        </div>
    </div>

</div>

@endsection