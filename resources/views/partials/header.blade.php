<header 
    x-data="{ 
        mobileMenuOpen: false, 
        searchOpen: false,
        scrolled: false 
    }" 
    @scroll.window="scrolled = (window.pageYOffset > 40)"
    {{-- 'fixed' ensures it overlaps the slider. Transition handles the move from top-8 to top-2 --}}
    class="fixed left-0 right-0 z-50 transition-all duration-500 ease-in-out"
    :class="scrolled ? 'top-2' : 'top-6 md:top-8'"
>
    {{-- WIDTH CONTAINER: Matches the red box width in your image --}}
    <div class="mx-auto w-[95%] max-w-[1400px] transition-all duration-300">
        
        {{-- THE ISLAND: White background, rounded corners, shadow --}}
        {{-- CRITICAL FIX: Removed 'overflow-hidden' here so submenus can show --}}
        <div class="bg-white rounded-[2rem] shadow-2xl border border-gray-100 relative">

            {{-- 1. TOP BAR (Collapsible) --}}
            {{-- CRITICAL FIX: Added 'rounded-t-[2rem]' to match parent corners manually --}}
            <div 
                class="hidden md:block bg-gray-50 border-b border-gray-100 transition-all duration-500 ease-in-out overflow-hidden rounded-t-[2rem]"
                :class="scrolled ? 'max-h-0 opacity-0' : 'max-h-12 opacity-100 py-2.5'"
            >
                <div class="px-6 lg:px-10 flex justify-between items-center text-xs font-medium text-gray-500">
                    {{-- Contact Info --}}
                    <div class="flex items-center gap-6">
                        @if(!empty($settings->contact_email))
                            <a href="mailto:{{ $settings->contact_email }}" class="flex items-center gap-2 hover:text-primary transition group">
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                <span>{{ $settings->contact_email }}</span>
                            </a>
                        @endif
                        @if(!empty($settings->contact_phone))
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone) }}" class="flex items-center gap-2 hover:text-primary transition group">
                                <svg class="w-3.5 h-3.5 text-gray-400 group-hover:text-primary transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                <span>{{ $settings->contact_phone }}</span>
                            </a>
                        @endif
                    </div>

                    {{-- Socials --}}
                    <div class="flex items-center gap-4">
                        <span>Follow Us:</span>
                        <div class="flex gap-3">
                            @if(!empty($settings->facebook_url)) <a href="{{ $settings->facebook_url }}" target="_blank" class="hover:text-primary transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a> @endif
                            @if(!empty($settings->twitter_url)) <a href="{{ $settings->twitter_url }}" target="_blank" class="hover:text-primary transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg></a> @endif
                            @if(!empty($settings->instagram_url)) <a href="{{ $settings->instagram_url }}" target="_blank" class="hover:text-primary transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg></a> @endif
                            @if(!empty($settings->linkedin_url)) <a href="{{ $settings->linkedin_url }}" target="_blank" class="hover:text-primary transition"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a> @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. MAIN NAVIGATION --}}
            {{-- Added rounded-b-[2rem] to ensure bottom corners are round --}}
            <div 
                class="px-5 md:px-10 flex items-center justify-between transition-all duration-300 rounded-b-[2rem]"
                :class="scrolled ? 'h-16' : 'h-20'"
            >
                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 z-50 flex-shrink-0">
                    @if(isset($settings) && $settings->site_logo)
                        <img src="{{ Storage::url($settings->site_logo) }}" alt="Logo" class="w-auto transition-all" :class="scrolled ? 'h-9' : 'h-11'">
                    @else
                        <div class="flex flex-col">
                            <span class="font-extrabold text-gray-900 leading-none tracking-tight transition-all" :class="scrolled ? 'text-xl' : 'text-2xl'">{{ $settings->site_name ?? 'GlobalEd' }}</span>
                            <span class="text-[0.65rem] uppercase tracking-widest text-primary font-bold">Consultancy</span>
                        </div>
                    @endif
                </a>

                {{-- DESKTOP MENU --}}
                <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
                    @foreach($menu_items as $item)
                        @if($item->children->isEmpty())
                            <a href="{{ $item->url }}" 
                               class="text-sm font-bold text-gray-700 hover:text-primary transition relative group py-2"
                               @if($item->new_tab) target="_blank" @endif>
                                {{ $item->label }}
                                <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-primary transition-all group-hover:w-full duration-300"></span>
                            </a>
                        @else
                            {{-- Dropdown --}}
                            <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative h-full flex items-center">
                                <button class="flex items-center gap-1 text-sm font-bold text-gray-700 hover:text-primary transition py-2">
                                    {{ $item->label }}
                                    <svg :class="{'rotate-180': open}" class="w-3.5 h-3.5 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </button>

                                <div 
                                    x-show="open" 
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute top-full left-1/2 -translate-x-1/2 pt-4 w-56 z-50"
                                    x-cloak
                                >
                                    <div class="bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden py-2">
                                        @foreach($item->children as $child)
                                            <a href="{{ $child->url }}" 
                                               class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition font-medium"
                                               @if($child->new_tab) target="_blank" @endif>
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
                <div class="flex items-center gap-3">
                    
                    {{-- Search --}}
                    <button @click="searchOpen = !searchOpen" class="text-gray-400 hover:text-primary transition p-2 rounded-full hover:bg-gray-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>

                    {{-- Auth & Appointment --}}
                    <div class="hidden md:flex items-center gap-3">
                        @auth
                            <a href="/admin" class="w-9 h-9 flex items-center justify-center rounded-full bg-gray-100 text-gray-600 hover:bg-primary hover:text-white transition" title="Dashboard">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </a>
                        @else
                            <a href="/admin/login" class="text-sm font-bold text-gray-600 hover:text-primary transition px-2">
                                Login
                            </a>
                        @endauth

                        <button onclick="toggleAppointmentModal()" class="bg-primary text-white px-6 rounded-full font-bold shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300" :class="scrolled ? 'py-2 text-sm' : 'py-3 text-sm'">
                            Book Appointment
                        </button>
                    </div>

                    {{-- Mobile Toggle --}}
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-gray-800">
                        <svg x-show="!mobileMenuOpen" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- SEARCH BAR OVERLAY --}}
    <div 
        x-show="searchOpen" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.away="searchOpen = false"
        class="absolute top-full mt-4 left-0 w-full z-30 px-4"
        x-cloak
    >
        <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-2xl p-4 border border-gray-100">
            <form action="{{ route('search') }}" method="GET" class="relative">
                <input type="text" name="q" placeholder="Search courses, universities..." 
                       class="w-full bg-gray-50 border-transparent rounded-xl py-3 pl-12 pr-12 focus:ring-0 focus:bg-white focus:border-primary transition"
                       autofocus>
                <svg class="w-5 h-5 text-gray-400 absolute left-4 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                <button type="button" @click="searchOpen = false" class="absolute right-4 top-3.5 text-xs font-bold text-gray-400 bg-gray-200 px-2 py-0.5 rounded hover:bg-gray-300">ESC</button>
            </form>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div 
        x-show="mobileMenuOpen" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-x-full"
        x-transition:enter-end="opacity-100 translate-x-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-x-0"
        x-transition:leave-end="opacity-0 translate-x-full"
        class="fixed inset-0 bg-white z-[60] flex flex-col h-screen overflow-y-auto"
        x-cloak
    >
        <div class="flex justify-between items-center p-6 border-b border-gray-100">
            <span class="text-xl font-bold text-gray-900">Menu</span>
            <button @click="mobileMenuOpen = false" class="p-2 bg-gray-50 rounded-full text-gray-500 hover:text-red-500 hover:bg-red-50 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <nav class="flex-1 p-6 flex flex-col gap-2">
            @foreach($menu_items as $item)
                @if($item->children->isEmpty())
                    <a href="{{ $item->url }}" class="text-lg font-bold text-gray-800 hover:text-primary py-3 border-b border-gray-50">{{ $item->label }}</a>
                @else
                    <div x-data="{ subOpen: false }" class="border-b border-gray-50 py-2">
                        <button @click="subOpen = !subOpen" class="w-full text-lg font-bold text-gray-800 hover:text-primary flex items-center justify-between py-2">
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

        <div class="p-6 bg-gray-50">
            @auth
                <a href="/admin" class="block w-full text-center py-3 bg-white border border-gray-200 rounded-xl font-bold text-gray-700 mb-3">Dashboard</a>
            @else
                <a href="/admin/login" class="block w-full text-center py-3 bg-white border border-gray-200 rounded-xl font-bold text-gray-700 mb-3">Login</a>
            @endauth
            <button onclick="toggleAppointmentModal(); mobileMenuOpen = false;" class="block w-full py-4 bg-primary text-white rounded-xl font-bold shadow-lg shadow-blue-500/30">
                Book Appointment
            </button>
        </div>
    </div>
</header>