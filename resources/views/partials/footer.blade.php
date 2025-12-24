{{-- CTA Section --}}
{{-- 1. z-20: Ensures this sits ON TOP of the footer --}}
<section class="relative z-20">
    <div class="container mx-auto px-4 md:px-6 lg:px-8">
        {{-- Rounded Box --}}
        <div class="relative max-w-[1400px] mx-auto bg-gradient-to-r from-orange-500 via-orange-400 to-pink-300 rounded-3xl overflow-hidden shadow-2xl">
            {{-- Decorative Background Pattern --}}
            <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 left-0 w-full h-full"
                    style="background-image: repeating-linear-gradient(90deg, transparent, transparent 2px, rgba(255,255,255,0.1) 2px, rgba(255,255,255,0.1) 4px);">
                </div>
            </div>

            {{-- Radial Lines Pattern --}}
            <div class="absolute top-0 left-0 w-1/3 h-full opacity-30">
                <svg class="w-full h-full" viewBox="0 0 400 400">
                    <defs>
                        <pattern id="radialLines" x="0" y="0" width="400" height="400" patternUnits="userSpaceOnUse">
                            <g transform="translate(0, 200)">
                                <line x1="0" y1="0" x2="400" y2="-200" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-180" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-160" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-140" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-120" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-100" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-80" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-60" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-40" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="-20" stroke="white" stroke-width="1" opacity="0.3" />
                                <line x1="0" y1="0" x2="400" y2="0" stroke="white" stroke-width="1" opacity="0.3" />
                            </g>
                        </pattern>
                    </defs>
                    <rect width="400" height="400" fill="url(#radialLines)" />
                </svg>
            </div>

            {{-- Content --}}
            <div class="relative z-10 px-6 md:px-12 lg:px-16 py-12 md:py-16">
                <div class="grid lg:grid-cols-2 gap-8 items-center">
                    {{-- Left Content --}}
                    <div class="text-white">
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                            Are you prepared to soar<br>and chase your dreams?
                        </h2>
                        <p class="text-base md:text-lg mb-8 text-white/90 leading-relaxed">
                            We work collaboratively with students to provide tailored solutions<br class="hidden md:block">for their study abroad needs.
                        </p>
                        <a href="{{ route('contact') }}"
                            class="inline-flex items-center gap-3 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold px-8 py-4 rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span>Book a Consultation</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </a>
                    </div>

                    {{-- Right Image --}}
                    <div class="relative">
                        <img src="{{ asset('storage/students-consultation.jpg') }}" alt="Students"
                            class="rounded-2xl shadow-2xl w-full h-auto object-cover">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Footer --}}
{{-- 
    1. relative z-10: Puts footer BEHIND the CTA section.
    2. -mt-32...: Moves the footer UP to overlap the CTA.
    3. pt-48...: Adds PADDING inside to compensate.
--}}
<footer class="bg-[#003b99] text-white relative z-10 -mt-24 md:-mt-32 lg:-mt-48 pt-32 md:pt-48 lg:pt-64 overflow-hidden text-base">
    
    {{-- Decorative Wave Pattern --}}
    <div class="absolute top-0 left-0 w-full h-32 opacity-5 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0 C150,50 350,50 600,20 C850,50 1050,50 1200,0 L1200,120 L0,120 Z" fill="white"></path>
        </svg>
    </div>

    <div class="container mx-auto px-4 md:px-6 lg:px-8 pb-8 relative z-10">
        <div class="max-w-[1400px] mx-auto">
            
            {{-- Footer Main Content --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                {{-- About Section --}}
                <div>
                    {{-- CHANGED: text-xl -> text-2xl --}}
                    <h3 class="text-2xl font-bold mb-6">About {{ $settings->site_name ?? 'Studylifter' }}</h3>
                    {{-- CHANGED: text-sm -> text-base --}}
                    <p class="text-gray-300 text-base leading-relaxed">
                        {{ $settings->footer_about ?? 'We offer personalized support for students starting their study abroad journeys with top universities across UK, USA, Canada & Australia.' }}
                    </p>
                </div>

                {{-- Useful Links --}}
                <div>
                    {{-- CHANGED: text-lg -> text-xl --}}
                    <h4 class="text-xl font-semibold mb-6">Useful Links</h4>
                    <ul class="space-y-3">
                        {{-- CHANGED: text-sm -> text-base for all links --}}
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Contact Us</a></li>
                        <li><a href="{{ route('services.index') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Our Services</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Latest News</a></li>
                        <li><a href="{{ route('careers.index') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Careers</a></li>
                        <li><a href="{{ route('countries.index') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Destinations</a></li>
                    </ul>
                </div>

                {{-- More Links (Dynamic/Optional) --}}
                <div>
                    {{-- CHANGED: text-lg -> text-xl --}}
                    <h4 class="text-xl font-semibold mb-6">Resources</h4>
                    <ul class="space-y-3">
                        {{-- CHANGED: text-sm -> text-base for all links --}}
                        <li><a href="{{ route('languages.index') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Language Prep</a></li>
                        <li><a href="{{ route('gallery.photos') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Photo Gallery</a></li>
                        <li><a href="{{ route('gallery.videos') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Video Tour</a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Book Consultation</a></li>
                    </ul>
                </div>

                {{-- Policies --}}
                <div>
                    {{-- CHANGED: text-lg -> text-xl --}}
                    <h4 class="text-xl font-semibold mb-6">Policies</h4>
                    <ul class="space-y-3">
                        {{-- CHANGED: text-sm -> text-base for all links --}}
                        <li><a href="/terms" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Terms & Services</a></li>
                        <li><a href="/refund-policy" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Refund Policy</a></li>
                        <li><a href="/privacy-policy" class="text-gray-300 hover:text-yellow-400 transition-colors text-base">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            {{-- Contact Information Bar --}}
            <div class="grid md:grid-cols-3 gap-8 py-8 border-t border-white/10">
                {{-- Email --}}
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div>
                        {{-- CHANGED: text-sm -> text-base --}}
                        <p class="text-white font-medium text-base">
                            <a href="mailto:{{ $settings->contact_email }}" class="hover:text-yellow-400 transition">{{ $settings->contact_email ?? 'info@example.com' }}</a>
                        </p>
                    </div>
                </div>

                {{-- Location --}}
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        {{-- CHANGED: text-sm -> text-base --}}
                        <p class="text-white font-medium text-base">{{ $settings->address ?? 'Dhaka, Bangladesh' }}</p>
                    </div>
                </div>

                {{-- Phone --}}
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-yellow-400 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gray-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <div>
                        {{-- CHANGED: text-sm -> text-base --}}
                        <p class="text-white font-medium text-base">
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->contact_phone) }}" class="hover:text-yellow-400 transition">{{ $settings->contact_phone ?? '+880 123 456 789' }}</a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Bottom Bar --}}
            <div class="flex flex-col md:flex-row justify-between items-center pt-8 border-t border-white/10 gap-4">
                {{-- Copyright --}}
                {{-- CHANGED: text-sm -> text-base --}}
                <div class="flex items-center gap-2 text-base text-gray-400">
                    <span>© {{ date('Y') }} {{ $settings->site_name ?? 'GlobalEd' }}. All Rights Reserved.</span>
                </div>

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-80 transition">
                    @if(isset($settings) && $settings->site_logo)
                        <img src="{{ Storage::url($settings->site_logo) }}" alt="Logo" class="h-10 w-auto bg-white rounded p-1">
                    @else
                        <div class="w-10 h-10 bg-yellow-400 rounded-lg flex items-center justify-center text-gray-900 font-bold text-xl">
                            {{ substr($settings->site_name ?? 'G', 0, 1) }}
                        </div>
                    @endif
                    {{-- CHANGED: text-xl -> text-2xl --}}
                    <span class="text-2xl font-bold text-white">{{ $settings->site_name ?? 'GlobalEd' }}</span>
                </a>

                {{-- Social Media --}}
                <div class="flex items-center gap-3">
                    @if(!empty($settings->facebook_url))
                        <a href="{{ $settings->facebook_url }}" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-yellow-400 rounded-full flex items-center justify-center transition-all duration-300 group">
                            <svg class="w-5 h-5 text-white group-hover:text-gray-900" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings->twitter_url))
                        <a href="{{ $settings->twitter_url }}" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-yellow-400 rounded-full flex items-center justify-center transition-all duration-300 group">
                            <svg class="w-5 h-5 text-white group-hover:text-gray-900" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings->instagram_url))
                        <a href="{{ $settings->instagram_url }}" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-yellow-400 rounded-full flex items-center justify-center transition-all duration-300 group">
                            <svg class="w-5 h-5 text-white group-hover:text-gray-900" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                    @endif
                    @if(!empty($settings->linkedin_url))
                        <a href="{{ $settings->linkedin_url }}" target="_blank" class="w-10 h-10 bg-white/10 hover:bg-yellow-400 rounded-full flex items-center justify-center transition-all duration-300 group">
                            <svg class="w-5 h-5 text-white group-hover:text-gray-900" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>