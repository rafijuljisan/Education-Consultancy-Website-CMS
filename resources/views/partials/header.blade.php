<header 
    x-data="{ 
        mobileMenuOpen: false, 
        searchOpen: false,
        scrolled: false 
    }" 
    @scroll.window="scrolled = (window.pageYOffset > 40)" 
    class="fixed left-0 right-0 z-50 transition-all duration-500 ease-in-out"
    :class="scrolled ? 'top-0 md:top-2' : 'top-0 md:top-6'"
>
    {{-- WIDTH CONTAINER --}}
    <div class="mx-auto w-full md:w-[95%] max-w-[1400px] transition-all duration-300">

        {{-- THE ISLAND CONTAINER --}}
        <div class="bg-white md:rounded-[2rem] shadow-xl border-b md:border border-gray-100 relative transition-all duration-300"
             :class="scrolled ? 'rounded-none md:rounded-[2rem]' : 'rounded-none md:rounded-[2rem]'">

            {{-- 1. TOP BAR (Hidden on Mobile) --}}
            <div class="hidden md:block bg-gray-50 border-b border-gray-100 transition-all duration-500 ease-in-out overflow-hidden md:rounded-t-[2rem]"
                :class="scrolled ? 'max-h-0 opacity-0' : 'max-h-12 opacity-100 py-2.5'">
                <div class="px-6 lg:px-10 flex justify-between items-center text-xs font-medium text-gray-500">
                    
                    {{-- Contact Info --}}
                    <div class="flex items-center gap-6">
                        @if(!empty($settings->contact_email))
                            <a href="mailto:{{ $settings->contact_email }}" class="flex items-center gap-2 hover:text-blue-600 transition group">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>{{ $settings->contact_email }}</span>
                            </a>
                        @endif
                        @if(!empty($settings->contact_phone))
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone) }}" class="flex items-center gap-2 hover:text-blue-600 transition group">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $settings->contact_phone }}</span>
                            </a>
                        @endif
                    </div>

                    {{-- Social Icons --}}
                    <div class="flex items-center gap-4">
                        <span>Follow Us:</span>
                        <div class="flex gap-3">
                            @if(!empty($settings->facebook_url)) 
                                <a href="{{ $settings->facebook_url }}" target="_blank" class="hover:text-blue-600 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                                    </svg>
                                </a> 
                            @endif
                            
                            @if(!empty($settings->twitter_url)) 
                                <a href="{{ $settings->twitter_url }}" target="_blank" class="hover:text-blue-400 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>
                                    </svg>
                                </a> 
                            @endif
                            
                            @if(!empty($settings->instagram_url)) 
                                <a href="{{ $settings->instagram_url }}" target="_blank" class="hover:text-pink-600 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path>
                                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                    </svg>
                                </a> 
                            @endif
                            
                            @if(!empty($settings->linkedin_url)) 
                                <a href="{{ $settings->linkedin_url }}" target="_blank" class="hover:text-blue-700 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>
                                        <circle cx="4" cy="4" r="2"></circle>
                                    </svg>
                                </a> 
                            @endif

                            @if(!empty($settings->youtube_url))
                                <a href="{{ $settings->youtube_url }}" target="_blank" class="hover:text-red-600 transition">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. MAIN NAVIGATION --}}
            <div class="px-4 md:px-10 flex items-center justify-between transition-all duration-300 md:rounded-b-[2rem]"
                :class="scrolled ? 'h-16' : 'h-18 md:h-20'">
                
                {{-- LOGO AREA --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 z-50 flex-shrink-0 mr-4 max-w-[65%] md:max-w-none overflow-hidden">
                    @if(isset($settings) && $settings->site_logo)
                        <img src="{{ Storage::url($settings->site_logo) }}" alt="Logo" class="w-auto object-contain transition-all"
                            :class="scrolled ? 'h-8 md:h-9' : 'h-10 md:h-11'">
                    @else
                        <div class="flex flex-col justify-center">
                            <span class="font-extrabold text-gray-900 leading-none tracking-tight transition-all truncate"
                                :class="scrolled ? 'text-lg md:text-xl' : 'text-xl md:text-2xl'">
                                {{ $settings->site_name ?? 'GlobalEd' }}
                            </span>
                            <span class="text-[0.6rem] md:text-[0.65rem] uppercase tracking-widest text-blue-600 font-bold hidden md:block">
                                Consultation
                            </span>
                        </div>
                    @endif
                </a>

                {{-- DESKTOP MENU --}}
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
                    @foreach($menu_items as $item)
                        @if($item->children->isEmpty())
                            <a href="{{ $item->url }}" class="text-sm font-bold text-gray-700 hover:text-blue-600 transition relative group py-2">
                                {{ $item->label }}
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-blue-600 transition-all group-hover:w-full duration-300"></span>
                            </a>
                        @else
                            <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative h-full flex items-center">
                                <a href="{{ $item->url }}" class="flex items-center gap-1 text-sm font-bold text-gray-700 hover:text-blue-600 transition py-2">
                                    {{ $item->label }}
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </a>
                                <div x-show="open" x-cloak class="absolute top-full left-1/2 -translate-x-1/2 pt-4 w-56 z-50">
                                    <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-2">
                                        @foreach($item->children as $child)
                                            <a href="{{ $child->url }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-blue-600 font-medium">
                                                {{ $child->label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </nav>

                {{-- RIGHT ACTIONS --}}
                <div class="flex items-center gap-2 md:gap-3 flex-shrink-0">
                    {{-- Search --}}
                    <button @click="searchOpen = !searchOpen" class="text-gray-500 hover:text-blue-600 p-2 rounded-full hover:bg-gray-50">
                        <svg class="w-6 h-6 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>

                    {{-- Desktop Button --}}
                    <div class="hidden md:flex items-center gap-3">
                        <button onclick="toggleAppointmentModal()" class="bg-blue-600 text-white px-6 rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300"
                            :class="scrolled ? 'py-2 text-sm' : 'py-3 text-sm'">
                            Book Appointment
                        </button>
                    </div>

                    {{-- Mobile Hamburger --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-800 focus:outline-none">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH OVERLAY --}}
    <div x-show="searchOpen" x-cloak @click.away="searchOpen = false" class="absolute top-full mt-2 left-0 w-full z-40 px-4">
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-2xl p-4 border border-gray-100">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Search..." class="w-full bg-gray-50 border-0 rounded-xl py-3 pl-4 pr-12 focus:ring-2 focus:ring-blue-500">
                <button type="button" @click="searchOpen = false" class="absolute right-4 top-3.5 text-gray-400">✕</button>
            </form>
        </div>
    </div>

    {{-- MOBILE MENU DRAWER --}}
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         class="fixed inset-0 bg-white z-[60] flex flex-col h-screen w-full overflow-y-auto" x-cloak>
        
        {{-- Mobile Menu Header --}}
        <div class="flex justify-between items-center p-5 border-b border-gray-100 bg-white sticky top-0 z-10">
            <span class="text-xl font-bold text-gray-900">Menu</span>
            <button @click="mobileMenuOpen = false" class="p-2 bg-gray-100 rounded-full text-gray-600 hover:text-red-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- Mobile Links --}}
        <nav class="flex-1 p-6 flex flex-col gap-2 overflow-y-auto">
            @foreach($menu_items as $item)
                @if($item->children->isEmpty())
                    <a href="{{ $item->url }}" class="text-lg font-bold text-gray-800 py-3 border-b border-gray-50">{{ $item->label }}</a>
                @else
                    <div x-data="{ subOpen: false }" class="border-b border-gray-50 py-2">
                        <button @click="subOpen = !subOpen" class="w-full text-lg font-bold text-gray-800 flex items-center justify-between py-2">
                            {{ $item->label }}
                            <svg :class="{'rotate-180': subOpen}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div x-show="subOpen" class="pl-4 flex flex-col gap-3 py-2 bg-gray-50 rounded-lg mt-2">
                            @foreach($item->children as $child)
                                <a href="{{ $child->url }}" class="text-gray-600 font-medium">{{ $child->label }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach
        </nav>

        {{-- Mobile Action Buttons --}}
        <div class="p-6 bg-gray-50 mt-auto">
            <button type="button" onclick="toggleAppointmentModal();" @click="mobileMenuOpen = false" class="block w-full py-4 bg-blue-600 text-white rounded-xl font-bold shadow-lg mb-4 text-center">
                Book Appointment
            </button>
            
            @auth
                <a href="/admin" class="block w-full text-center py-3 bg-white border border-gray-200 rounded-xl font-bold text-gray-700">Dashboard</a>
            @else
                <a href="/admin/login" class="block w-full text-center py-3 bg-white border border-gray-200 rounded-xl font-bold text-gray-700">Login</a>
            @endauth
        </div>
    </div>
</header>

{{-- Ensure Modal Toggle Works --}}
<script>
    function toggleAppointmentModal() {
        // Fallback for direct Alpine access
        if (typeof Alpine !== 'undefined') {
            // Find component with x-data="{ appointmentOpen: false }"
            const alpineComponent = document.querySelector('[x-data*="appointmentOpen"]');
            if (alpineComponent && alpineComponent.__x) {
                alpineComponent.__x.$data.appointmentOpen = !alpineComponent.__x.$data.appointmentOpen;
            } else {
                console.warn('Appointment modal alpine data not found. Ensure x-data="{ appointmentOpen: false }" is on a parent element.');
            }
        }
    }
</script>