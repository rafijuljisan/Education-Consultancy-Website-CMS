<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth overflow-x-hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ========================================================================
    1. GOOGLE TAG MANAGER - HEAD SCRIPT (From Admin Panel)
    ======================================================================== --}}
    @if(isset($settings->google_tag_manager_id) && !empty($settings->google_tag_manager_id) && app()->environment('production'))
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || []; w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                }); var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $settings->google_tag_manager_id }}');
        </script>
    @endif

    {{-- ========================================================================
    2. DYNAMIC SEO LOGIC
    (Determines Title, Description, & Image based on current page data)
    ======================================================================== --}}
    @php
        // 1. Defaults from General Settings
        $seo_site_name = $settings->site_name ?? 'GlobalEd';
        $seo_title = $seo_site_name . ' - Study Abroad Consultancy';
        $seo_desc = $settings->site_description ?? 'Expert guidance for your global education dreams. Study in UK, USA, Canada, and more.';
        $seo_img = isset($settings->site_logo) ? Storage::url($settings->site_logo) : asset('images/default-og.jpg');
        $seo_url = url()->current();
        $seo_type = 'website';

        // 2. Check if a specific page object exists (passed from Controller as 'page_data', 'service', 'post', etc.)
        $page_obj = $page_data ?? $service ?? $post ?? $country ?? $course ?? null;

        if ($page_obj) {
            // Title
            $raw_title = $page_obj->meta_title ?? $page_obj->title ?? $page_obj->name ?? null;
            if ($raw_title) {
                $seo_title = $raw_title . ' | ' . $seo_site_name;
            }

            // Description
            $raw_desc = $page_obj->meta_description ?? $page_obj->short_description ?? null;
            if ($raw_desc) {
                $seo_desc = Str::limit(strip_tags($raw_desc), 160);
            }

            // Image
            $raw_img = $page_obj->image ?? $page_obj->thumbnail ?? $page_obj->cover_image ?? null;
            if ($raw_img) {
                $seo_img = Storage::url($raw_img);
            }

            // Type
            if (isset($post)) {
                $seo_type = 'article';
            }
        }
    @endphp

    {{-- ========================================================================
    3. SEO META TAGS
    ======================================================================== --}}
    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    <link rel="canonical" href="{{ $seo_url }}" />

    {{-- Open Graph --}}
    <meta property="og:site_name" content="{{ $seo_site_name }}">
    <meta property="og:type" content="{{ $seo_type }}">
    <meta property="og:url" content="{{ $seo_url }}">
    <meta property="og:title" content="{{ $seo_title }}">
    <meta property="og:description" content="{{ $seo_desc }}">
    <meta property="og:image" content="{{ $seo_img }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo_title }}">
    <meta name="twitter:description" content="{{ $seo_desc }}">
    <meta name="twitter:image" content="{{ $seo_img }}">

    {{-- Favicon --}}
    @if(isset($settings->site_favicon))
        <link rel="icon" href="{{ Storage::url($settings->site_favicon) }}">
    @endif

    {{-- ========================================================================
    4. SCHEMA MARKUP (JSON-LD)
    ======================================================================== --}}
    @php
        $schema = [
            "@context" => "https://schema.org",
            "@type" => "EducationalOrganization",
            "name" => $seo_site_name,
            "url" => url('/'),
            "contactPoint" => [
                "@type" => "ContactPoint",
                "telephone" => $settings->contact_phone ?? '',
                "contactType" => "customer service",
                "email" => $settings->contact_email ?? '',
            ],
            "sameAs" => array_values(array_filter([
                $settings->facebook_url ?? null,
                $settings->twitter_url ?? null,
                $settings->linkedin_url ?? null,
                $settings->instagram_url ?? null,
            ])),
        ];

        if (!empty($settings->site_logo)) {
            $schema['logo'] = Storage::url($settings->site_logo);
        }
    @endphp

    @if(isset($settings))
        <script type="application/ld+json">
            {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
            </script>
    @endif

    {{-- ========================================================================
    5. STYLES & SCRIPTS
    ======================================================================== --}}
    <style>
        :root {
            --primary-color:
                {{ $settings->primary_color ?? '#2563eb' }}
            ;
            --secondary-color:
                {{ $settings->secondary_color ?? '#f59e0b' }}
            ;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

{{-- Added 'w-full' and ensured overflow-x-hidden is inherited --}}

<body class="font-sans text-gray-800 antialiased bg-gray-50 flex flex-col min-h-screen w-full overflow-x-hidden"
    x-data="{ appointmentOpen: false }" @toggle-appointment.window="appointmentOpen = !appointmentOpen">

    {{-- ========================================================================
    6. GOOGLE TAG MANAGER - BODY NOSCRIPT (From Admin Panel)
    ======================================================================== --}}
    @if(isset($settings->google_tag_manager_id) && !empty($settings->google_tag_manager_id) && app()->environment('production'))
        <noscript>
            <iframe src="https://www.googletagmanager.com/ns.html?id={{ $settings->google_tag_manager_id }}" height="0"
                width="0" style="display:none;visibility:hidden"></iframe>
        </noscript>
    @endif

    @include('partials.header')

    {{-- ========================================================================
    APPOINTMENT MODAL (Global)
    ======================================================================== --}}
    <div x-show="appointmentOpen" x-cloak class="fixed inset-0 z-[9999]" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">

        {{-- Backdrop --}}
        <div x-show="appointmentOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900 bg-opacity-75 backdrop-blur-sm transition-opacity"
            @click="appointmentOpen = false"></div>

        {{-- Modal Panel --}}
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                <div x-show="appointmentOpen" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl grid md:grid-cols-5">

                    {{-- Close Button --}}
                    <button @click="appointmentOpen = false"
                        class="absolute top-4 right-4 z-20 text-gray-400 hover:text-gray-800 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    {{-- Left Side: Image --}}
                    <div class="hidden md:block md:col-span-2 relative h-full min-h-[500px]">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1470&auto=format&fit=crop"
                            class="absolute inset-0 h-full w-full object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-blue-900/90 to-blue-900/40 mix-blend-multiply">
                        </div>
                        <div class="absolute bottom-8 left-8 text-white z-10">
                            <h3 class="text-3xl font-bold mb-2">Start Your Journey</h3>
                            <p class="text-blue-100 opacity-90">Expert guidance for your global education dreams.</p>
                        </div>
                    </div>

                    {{-- Right Side: Form --}}
                    <div class="md:col-span-3 p-8 md:p-10 bg-white">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Book Free Consultation</h2>

                        <form action="{{ route('appointment.store') }}" method="POST" class="space-y-5">
                            @csrf

                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Service Type *</label>
                                    <select name="subject" required
                                        class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary">
                                        <option value="">Select Option</option>
                                        <option value="Visa Counseling">Visa Counseling</option>
                                        <option value="University Admission">University Admission</option>
                                        <option value="IELTS Prep">IELTS Prep</option>
                                        <option value="Work Permit">Work Permit</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Destination</label>
                                    <select name="country" required
                                        class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary">
                                        <option value="">Select Country</option>
                                        @foreach($global_countries as $countryName)
                                            <option value="{{ $countryName }}">{{ $countryName }}</option>
                                        @endforeach
                                        @if($global_countries->isEmpty())
                                            <option value="UK">UK</option>
                                            <option value="USA">USA</option>
                                            <option value="Canada">Canada</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Full Name *</label>
                                <input type="text" name="name" required
                                    class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary"
                                    placeholder="Enter your name">
                            </div>

                            <div class="grid grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Email *</label>
                                    <input type="email" name="email" required
                                        class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary"
                                        placeholder="john@example.com">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Phone *</label>
                                    <input type="tel" name="phone" required
                                        class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary"
                                        placeholder="+880...">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Message (Optional)</label>
                                <textarea name="message" rows="3"
                                    class="w-full rounded-lg border-gray-300 bg-gray-50 focus:bg-white focus:border-primary focus:ring-primary"
                                    placeholder="Tell us about your study plans..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-primary hover:bg-blue-700 text-white font-bold py-3.5 px-4 rounded-xl transition shadow-lg transform hover:scale-[1.02]">
                                Submit Request
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SUCCESS TOAST --}}
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
            x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            class="fixed bottom-4 right-4 z-50 bg-green-600 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div>
                <h4 class="font-bold">Success!</h4>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="ml-4 text-green-200 hover:text-white"><svg class="w-4 h-4" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg></button>
        </div>
    @endif

    {{-- MAIN CONTENT --}}
    <main class="flex-grow {{ request()->routeIs('home') ? '' : 'pt-24 md:pt-32' }}">
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        function toggleAppointmentModal() {
            // Dispatch a custom event that the body tag listens for
            window.dispatchEvent(new CustomEvent('toggle-appointment'));
        }
    </script>
</body>

</html>