<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings->site_name ?? 'GlobalEd' }} - Study Abroad Consultancy</title>

    <style>
        :root {
            --primary-color: {{ $settings->primary_color ?? '#2563eb' }};
            --secondary-color: {{ $settings->secondary_color ?? '#f59e0b' }};
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-800 antialiased bg-gray-50 flex flex-col min-h-screen">

    @include('partials.header')

    {{-- APPOINTMENT MODAL --}}
    <div id="appointmentModal" class="fixed inset-0 z-[9999] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        {{-- Backdrop --}}
        <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity backdrop-blur-sm" onclick="toggleAppointmentModal()"></div>

        {{-- Modal Panel --}}
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl grid md:grid-cols-5">

                {{-- Close Button --}}
                <button onclick="toggleAppointmentModal()" class="absolute top-4 right-4 z-10 text-gray-500 hover:text-gray-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>

                {{-- Left Side: Image --}}
                <div class="hidden md:block md:col-span-2 relative">
                    {{-- Replace this URL with your actual vertical image --}}
                    <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?q=80&w=1470&auto=format&fit=crop" 
                         class="absolute inset-0 h-full w-full object-cover" alt="Student">
                    <div class="absolute inset-0 bg-blue-900/40 mix-blend-multiply"></div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <h3 class="text-2xl font-bold">Start Your Journey</h3>
                        <p class="text-sm opacity-90">Expert guidance for your global education.</p>
                    </div>
                </div>

                {{-- Right Side: Form --}}
                <div class="md:col-span-3 p-8 bg-white">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Book an Appointment</h2>

                    <form action="{{ route('appointment.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                                <select name="subject" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                                    <option value="">Select Option</option>
                                    <option value="Visa Counseling">Visa Counseling</option>
                                    <option value="University Admission">University Admission</option>
                                    <option value="IELTS Prep">IELTS Prep</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                                <select name="country" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                                    <option value="">Select Country</option>
                                    <option value="UK">UK</option>
                                    <option value="USA">USA</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="name" required placeholder="Enter your full name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                <input type="email" name="email" required placeholder="email@example.com" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                                <input type="tel" name="phone" required placeholder="+880..." class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">IELTS Status</label>
                                <select name="ielts_score" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2">
                                    <option value="">Select Status</option>
                                    <option value="Not Taken">Not Taken Yet</option>
                                    <option value="6.0">6.0</option>
                                    <option value="6.5">6.5</option>
                                    <option value="7.0">7.0+</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Your Query</label>
                            <textarea name="message" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 border p-2"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-4 rounded transition">
                            Submit Request
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JAVASCRIPT TO HANDLE MODAL --}}
    <script>
        function toggleAppointmentModal() {
            const modal = document.getElementById('appointmentModal');
            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent background scrolling
            } else {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Restore scrolling
            }
        }
    </script>

    {{-- SUCCESS MESSAGE TOAST --}}
    @if(session('success'))
        <div class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded shadow-lg z-50 animate-bounce">
            {{ session('success') }}
        </div>
    @endif

    {{-- LOGIC: If it's 'home', add 0 padding (let it overlap). 
         If it's NOT 'home', add padding-top so content starts below the header. --}}
    <main class="flex-grow {{ request()->routeIs('home') ? '' : 'pt-32 md:pt-48' }}">
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>