@extends('layouts.app')

@section('content')

{{-- HERO SECTION --}}
<div class="relative bg-gray-900 h-[450px] flex items-center">
    @if($scholarship->image)
        <img src="{{ Storage::url($scholarship->image) }}" class="absolute inset-0 w-full h-full object-cover opacity-30">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/50 to-transparent"></div>
    
    <div class="container max-w-[1400px] mx-auto px-4 relative z-10 pt-16">
        <span class="inline-block py-1 px-3 rounded bg-green-500/20 border border-green-500/50 text-green-300 text-sm font-bold mb-4 uppercase tracking-wider">
            {{ $scholarship->funding_type }}
        </span>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 max-w-4xl">{{ $scholarship->title }}</h1>
        
        <div class="flex flex-wrap gap-6 text-gray-300 text-sm md:text-base font-medium">
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ $scholarship->country->name }}
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path></svg>
                {{ $scholarship->degree_level }}
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Deadline: {{ $scholarship->deadline ? $scholarship->deadline->format('d M, Y') : 'Open' }}
            </span>
        </div>
    </div>
</div>

{{-- CONTENT --}}
<div class="container max-w-[1400px] mx-auto px-4 py-16">
    <div class="grid lg:grid-cols-12 gap-12">
        
        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-8 space-y-12">
            
            {{-- About --}}
            <section class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">About this Scholarship</h2>
                <div class="prose prose-blue max-w-none text-gray-600">
                    {!! $scholarship->description !!}
                </div>
            </section>

            {{-- Benefits Grid --}}
            @if($scholarship->benefits)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Scholarship Benefits</h2>
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($scholarship->benefits as $benefit)
                    <div class="flex gap-4 p-5 bg-green-50 rounded-xl border border-green-100">
                        <div class="w-10 h-10 bg-green-200 rounded-full flex items-center justify-center text-green-700 font-bold flex-shrink-0">
                            ✓
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 mb-1">{{ $benefit['title'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $benefit['description'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- Requirements & Documents --}}
            <div class="grid md:grid-cols-2 gap-8">
                @if($scholarship->requirements)
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Eligibility Criteria</h3>
                    <ul class="space-y-3">
                        @foreach($scholarship->requirements as $req)
                        <li class="flex items-start gap-3 text-sm text-gray-700">
                            <span class="text-blue-500 mt-0.5">•</span>
                            {{ $req['criteria'] }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($scholarship->documents)
                <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Required Documents</h3>
                    <ul class="space-y-3">
                        @foreach($scholarship->documents as $doc)
                        <li class="flex items-start gap-3 text-sm text-gray-700">
                            <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            <div>
                                <span class="font-bold block">{{ $doc['name'] }}</span>
                                @if(!empty($doc['note']))
                                    <span class="text-xs text-gray-500">{{ $doc['note'] }}</span>
                                @endif
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            {{-- Application Process --}}
            @if($scholarship->application_process)
            <section>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">How to Apply</h2>
                <div class="space-y-6">
                    @foreach($scholarship->application_process as $step)
                    <div class="flex gap-6">
                        <div class="flex flex-col items-center">
                            <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold shadow-md z-10">
                                {{ $loop->iteration }}
                            </div>
                            @if(!$loop->last)
                                <div class="w-0.5 h-full bg-gray-200 -my-2"></div>
                            @endif
                        </div>
                        <div class="pb-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $step['step_name'] }}</h3>
                            <div class="prose prose-sm text-gray-600">
                                {!! $step['description'] !!}
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

        </div>

        {{-- RIGHT COLUMN --}}
        <div class="lg:col-span-4 space-y-8">
            
            {{-- Timeline Box --}}
            @if($scholarship->timeline)
            <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Application Timeline</h3>
                <div class="space-y-4">
                    @foreach($scholarship->timeline as $time)
                    <div class="flex justify-between items-center bg-white p-3 rounded-lg shadow-sm">
                        <span class="text-sm font-medium text-gray-600">{{ $time['event'] }}</span>
                        <span class="text-sm font-bold text-blue-600">{{ $time['date'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Apply CTA --}}
            <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 text-center sticky top-32">
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Interested?</h3>
                <p class="text-gray-500 mb-6 text-sm">We can help you secure this scholarship.</p>
                
                <button onclick="toggleAppointmentModal()" class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1 mb-4">
                    Apply Now
                </button>
                <div class="text-xs text-gray-400">
                    Free initial assessment included.
                </div>
            </div>

        </div>
    </div>
</div>

@endsection