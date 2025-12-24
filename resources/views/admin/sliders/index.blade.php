@extends('layouts.admin') {{-- Assuming you have an admin layout --}}

@section('content')
<div class="max-w-[1400px] mx-auto px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-800">Home Sliders</h2>
        <a href="{{ route('admin.sliders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">
            + Add New Slider
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Order
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Image
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Title / Subtitle
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status
                    </th>
                    <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($sliders as $slider)
                <tr>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <span class="font-mono">{{ $slider->sort_order }}</span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <div class="flex-shrink-0 w-24 h-16">
                            <img class="w-full h-full object-cover rounded" src="{{ asset($slider->image_path) }}" alt="" />
                        </div>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                        <p class="text-gray-900 whitespace-no-wrap font-bold">{{ $slider->title }}</p>
                        <p class="text-gray-500 text-xs">{{ $slider->subtitle ?? 'No Subtitle' }}</p>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <span class="relative inline-block px-3 py-1 font-semibold leading-tight {{ $slider->is_active ? 'text-green-900' : 'text-red-900' }}">
                            <span aria-hidden class="absolute inset-0 {{ $slider->is_active ? 'bg-green-200' : 'bg-red-200' }} opacity-50 rounded-full"></span>
                            <span class="relative">{{ $slider->is_active ? 'Active' : 'Inactive' }}</span>
                        </span>
                    </td>
                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex justify-center space-x-3">
                            <a href="{{ route('admin.sliders.edit', $slider->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            
                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($sliders->isEmpty())
            <div class="p-6 text-center text-gray-500">
                No sliders found. Click "Add New Slider" to create one.
            </div>
        @endif
    </div>
</div>
@endsection