@extends('layouts.app')

@section('content')

    <div class="max-w-[1400px] mx-auto px-4 py-16 grid md:grid-cols-3 gap-12">

        <div class="md:col-span-2">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
                <a href="{{ route('careers.index') }}" class="hover:text-primary">&larr; Back to Jobs</a>
            </div>

            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $job->title }}</h1>

            <div class="flex flex-wrap gap-4 mb-8 text-sm">
                <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded font-bold">{{ $job->type }}</span>
                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded font-bold">{{ $job->location }}</span>
                @if($job->salary_range)
                    <span
                        class="bg-green-50 text-green-700 px-3 py-1 rounded font-bold">${{ number_format($job->salary_range) }}
                        / yr</span>
                @endif
            </div>

            <div class="prose max-w-none text-gray-700 border-b pb-8 mb-8">
                {!! $job->description !!}
            </div>

            @if(!$job->is_filled)
                <div class="bg-blue-50 p-8 rounded-xl border border-blue-100">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Apply for this position</h3>
                    <form action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <input type="hidden" name="career_id" value="{{ $job->id }}">

                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="grid md:grid-cols-2 gap-4">
                            <input type="text" name="name" required placeholder="Full Name"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300">
                            <input type="tel" name="phone" placeholder="Phone Number"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300">
                        </div>
                        <input type="email" name="email" required placeholder="Email Address"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Resume / CV (PDF, DOC)</label>
                            <input type="file" name="resume" required accept=".pdf,.doc,.docx"
                                class="w-full px-4 py-3 bg-white rounded-lg border border-gray-300">
                        </div>

                        <button type="submit"
                            class="bg-primary hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-lg shadow-lg transition">
                            Submit Application
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-red-50 p-6 rounded-xl border border-red-100 text-center">
                    <h3 class="text-xl font-bold text-red-800">Position Filled</h3>
                    <p class="text-red-600">This job is no longer accepting applications.</p>
                </div>
            @endif
        </div>

        <div class="md:col-span-1">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                <h3 class="font-bold text-lg mb-4">Job Summary</h3>
                <ul class="space-y-4 text-sm">
                    <li class="flex justify-between">
                        <span class="text-gray-500">Location</span>
                        <span class="font-medium text-gray-900">{{ $job->location }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Department</span>
                        <span class="font-medium text-gray-900">General</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Type</span>
                        <span class="font-medium text-gray-900">{{ $job->type }}</span>
                    </li>
                    <li class="flex justify-between">
                        <span class="text-gray-500">Published</span>
                        <span class="font-medium text-gray-900">{{ $job->created_at->format('M d, Y') }}</span>
                    </li>
                </ul>
            </div>
        </div>

    </div>

@endsection