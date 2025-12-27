@extends('layouts.app')

@section('content')

{{-- 1. HERO HEADER --}}
<div class="relative bg-gray-900 py-20 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-purple-900 opacity-90"></div>
        {{-- Optional Background Pattern --}}
        <div class="absolute inset-0 opacity-10" style="background-image: repeating-linear-gradient(45deg, transparent, transparent 10px, #fff 10px, #fff 11px);"></div>
    </div>
    
    <div class="container max-w-[1400px] mx-auto px-4 relative z-10 text-center">
        <span class="inline-block py-1 px-3 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-widest mb-4">
            Global Opportunities
        </span>
        <h1 class="text-4xl md:text-5xl font-extrabold text-white mb-6">
            Find Your Perfect Scholarship
        </h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto mb-10">
            Explore fully funded and partially funded scholarships from top universities and governments around the world.
        </p>
    </div>
</div>

{{-- 2. SCHOLARSHIP LISTING --}}
<div class="bg-gray-50 py-16 min-h-screen">
    <div class="container max-w-[1400px] mx-auto px-4">
        
        {{-- Optional: Filter Bar (Static for now, can be made dynamic later) --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8 pb-8 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Latest Opportunities</h2>
            {{-- <div class="flex gap-2">
                <button class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50">Filter by Country</button>
            </div> --}}
        </div>

        @if($scholarships->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($scholarships as $scholarship)
                <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1 flex flex-col h-full">
                    
                    {{-- Image Thumb --}}
                    <div class="h-48 relative overflow-hidden bg-gray-200">
                        @if($scholarship->image)
                            <img src="{{ Storage::url($scholarship->image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-blue-50 text-blue-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        @endif
                        
                        {{-- Funding Badge --}}
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide shadow-sm
                                {{ $scholarship->funding_type === 'Fully Funded' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                {{ $scholarship->funding_type }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-center gap-2 mb-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                            <span class="text-primary">{{ $scholarship->country->name ?? 'International' }}</span>
                            <span>•</span>
                            <span>{{ $scholarship->degree_level }}</span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors">
                            <a href="{{ route('scholarships.show', $scholarship->slug) }}">
                                {{ $scholarship->title }}
                            </a>
                        </h3>

                        <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-1">
                            {{ Str::limit(strip_tags($scholarship->description), 120) }}
                        </p>

                        <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
                            <div class="text-xs text-gray-500 font-medium">
                                @if($scholarship->deadline)
                                    Deadline: <span class="text-gray-900">{{ $scholarship->deadline->format('d M, Y') }}</span>
                                @else
                                    <span class="text-green-600">Open Application</span>
                                @endif
                            </div>
                            <a href="{{ route('scholarships.show', $scholarship->slug) }}" class="text-primary text-sm font-bold flex items-center gap-1 group-hover:gap-2 transition-all">
                                Details <span aria-hidden="true">&rarr;</span>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No scholarships found</h3>
                <p class="text-gray-500 mt-1">Please check back later for new opportunities.</p>
            </div>
        @endif

    </div>
</div>

@endsection