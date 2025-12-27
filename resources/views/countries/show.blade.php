@extends('layouts.app')

@section('content')

{{-- 1. HERO HEADER --}}
<div class="relative bg-gray-900 h-[500px] flex items-center overflow-hidden">
    @if($country->cover_image)
        <img src="{{ Storage::url($country->cover_image) }}" class="absolute inset-0 w-full h-full object-cover opacity-40">
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
    
    <div class="container mx-auto px-4 relative z-10 pt-20 text-center">
        @if($country->flag_image)
            <img src="{{ Storage::url($country->flag_image) }}" class="w-20 h-auto mx-auto mb-6 shadow-lg rounded-md border-2 border-white/20">
        @endif
        <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 tracking-tight drop-shadow-lg">Study in {{ $country->name }}</h1>
        
        {{-- Quick Stats Bar --}}
        @if($country->quick_stats)
        <div class="inline-flex flex-wrap justify-center gap-6 md:gap-12 bg-white/10 backdrop-blur-md border border-white/20 rounded-full px-8 py-4 mt-8 text-white shadow-2xl">
            @foreach(collect($country->quick_stats)->take(3) as $stat)
            <div class="text-center px-4 border-r border-white/10 last:border-0">
                <span class="block text-gray-300 text-xs uppercase tracking-wide font-semibold">{{ $stat['label'] }}</span>
                <span class="text-lg md:text-xl font-bold text-yellow-400">{{ $stat['value'] }}</span>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

{{-- 2. MAIN CONTENT GRID --}}
<div class="container mx-auto px-4 py-16">
    <div class="grid lg:grid-cols-12 gap-12">
        
        {{-- LEFT COLUMN --}}
        <div class="lg:col-span-8 space-y-16">
            
            {{-- Introduction --}}
            <section class="prose prose-lg max-w-none text-gray-600 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                    <span class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    Overview
                </h2>
                {!! $country->details !!}
            </section>

            {{-- Why Study Here --}}
            @if($country->why_study)
            <section>
                <h2 class="text-3xl font-bold text-gray-900 mb-8 px-2">Why Study in {{ $country->name }}?</h2>
                <div class="grid gap-6">
                    @foreach($country->why_study as $index => $reason)
                    <div class="flex gap-5 items-start bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl border border-blue-100 shadow-sm hover:shadow-md transition duration-300">
                        <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center font-bold flex-shrink-0 text-lg shadow-blue-200 shadow-lg">
                            {{ $loop->iteration }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $reason['title'] }}</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $reason['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- DYNAMIC SECTION: Living Costs (Cards) --}}
            @if($country->living_costs)
            <section>
                <div class="flex items-center gap-3 mb-8 px-2">
                    <div class="p-2 bg-green-100 rounded-lg text-green-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900">Cost of Living</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($country->living_costs as $cost)
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg hover:border-green-200 transition-all duration-300 group">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 rounded-full bg-gray-50 flex items-center justify-center text-2xl group-hover:bg-green-50 group-hover:text-green-600 transition">
                                @switch($cost['icon'] ?? 'default')
                                    @case('home') 🏠 @break
                                    @case('food') 🍔 @break
                                    @case('transport') 🚌 @break
                                    @case('bill') 💡 @break
                                    @case('health') 💊 @break
                                    @default 💰
                                @endswitch
                            </div>
                            <span class="bg-green-50 text-green-700 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">Monthly</span>
                        </div>
                        <h3 class="text-gray-900 text-lg font-bold mb-1">{{ $cost['category'] }}</h3>
                        @if(!empty($cost['description']))
                            <p class="text-gray-500 text-sm mb-3 line-clamp-2">{{ $cost['description'] }}</p>
                        @endif
                        <div class="pt-3 border-t border-gray-100">
                            <p class="text-xl font-extrabold text-green-600">{{ $cost['cost'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
            @endif

            {{-- DYNAMIC SECTION: Documents & Visa --}}
            <div class="grid md:grid-cols-2 gap-8">
                
                {{-- Documents Checklist --}}
                @if($country->requirements)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden h-fit">
                    <div class="bg-indigo-600 p-6 text-white">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Documents Required
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-4">
                            @foreach($country->requirements as $req)
                            <li class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-5 h-5 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mt-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm">{{ $req['title'] }}</h4>
                                    @if(!empty($req['description']))
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $req['description'] }}</p>
                                    @endif
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                {{-- Visa Timeline --}}
                @if($country->visa_steps)
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2 px-2">
                        <span class="p-2 bg-purple-100 text-purple-600 rounded-lg"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg></span>
                        Visa Process
                    </h3>
                    
                    <div class="relative pl-6 space-y-8 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-200">
                        @foreach($country->visa_steps as $step)
                        <div class="relative group">
                            {{-- Timeline Dot --}}
                            <div class="absolute -left-[29px] top-1 w-6 h-6 rounded-full border-4 border-white bg-purple-600 shadow-sm group-hover:scale-125 transition"></div>
                            
                            <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 hover:bg-white hover:shadow-md transition duration-300">
                                <span class="text-xs font-bold text-purple-600 uppercase tracking-wider mb-1 block">Step {{ $loop->iteration }}</span>
                                <h4 class="text-lg font-bold text-gray-900 mb-2">{{ $step['step_name'] }}</h4>
                                <div class="prose prose-sm text-gray-600">
                                    {!! $step['description'] !!}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>

        </div>

        {{-- RIGHT COLUMN (Universities & CTA) --}}
        <div class="lg:col-span-4 space-y-8">
            
            {{-- Universities List --}}
            <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-4 flex items-center justify-between">
                    Top Universities
                    <span class="text-xs font-normal text-gray-500 bg-gray-100 px-2 py-1 rounded-full">{{ count($country->universities) }} Listed</span>
                </h3>
                <ul class="space-y-4 max-h-[600px] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($country->universities as $uni)
                        <li>
                            <a href="{{ route('universities.show', $uni->slug) }}" class="flex items-center gap-3 group p-2 hover:bg-gray-50 rounded-lg transition">
                                <div class="w-12 h-12 bg-white rounded-lg flex items-center justify-center border p-1 shadow-sm group-hover:border-primary transition">
                                    @if($uni->logo)
                                        <img src="{{ Storage::url($uni->logo) }}" class="max-w-full max-h-full">
                                    @else
                                        <span class="text-xs font-bold text-gray-400">LOGO</span>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800 text-sm group-hover:text-primary transition line-clamp-1">{{ $uni->name }}</h4>
                                    <p class="text-xs text-gray-500 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        {{ $uni->city ?? 'Main Campus' }}
                                    </p>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="text-center py-8 text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            <p class="text-sm">Universities list updating soon.</p>
                        </li>
                    @endforelse
                </ul>
            </div>

            {{-- Sticky CTA --}}
            <div class="sticky top-32 bg-gradient-to-br from-blue-600 to-blue-800 text-white p-8 rounded-3xl text-center shadow-xl relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-16 -mt-16"></div>
                
                <h3 class="text-2xl font-bold mb-3 relative z-10">Apply to {{ $country->name }}</h3>
                <p class="text-blue-100 mb-8 text-sm relative z-10 leading-relaxed">
                    Don't navigate the complex process alone. Get free expert counseling for your visa and university application.
                </p>
                <button onclick="toggleAppointmentModal()" class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-4 rounded-xl transition shadow-lg transform hover:-translate-y-1 relative z-10 flex items-center justify-center gap-2">
                    <span>Book Free Consultation</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </button>
            </div>

        </div>

    </div>
</div>

<style>
    /* Custom Scrollbar for Universities List */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
</style>

@endsection