@extends('layouts.admin')

@section('content')
<div class="max-w-[1400px] mx-auto px-6 py-8">
    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="py-4 px-6 bg-gray-800 text-white font-bold text-xl">
            Create New Slider
        </div>
        
        <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">Slider Image (Required)</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col w-full h-32 border-4 border-dashed hover:bg-gray-100 hover:border-blue-300 group">
                        <div class="flex flex-col items-center justify-center pt-7">
                            <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-blue-600">
                                Select a photo (1920x800 recommended)
                            </p>
                        </div>
                        <input type="file" name="image" class="opacity-0" required />
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Subtitle (Small Top Text)</label>
                    <input type="text" name="subtitle" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g. Welcome To">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Main Title (Required)</label>
                    <input type="text" name="title" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g. Study Abroad">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" rows="3" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Button Text</label>
                    <input type="text" name="button_text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g. Contact Us">
                </div>
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Button Link</label>
                    <input type="text" name="button_link" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="e.g. /contact">
                </div>
            </div>

            <div class="flex items-center gap-6 mb-6">
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="shadow appearance-none border rounded w-20 py-2 px-3 text-gray-700 leading-tight">
                </div>
                <div class="flex items-center mt-6">
                    <input type="checkbox" name="is_active" id="is_active" checked class="form-checkbox h-5 w-5 text-blue-600">
                    <label for="is_active" class="ml-2 text-gray-700 font-bold">Active?</label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-6 rounded hover:bg-blue-700 transition">
                    Save Slider
                </button>
            </div>
        </form>
    </div>
</div>
@endsection