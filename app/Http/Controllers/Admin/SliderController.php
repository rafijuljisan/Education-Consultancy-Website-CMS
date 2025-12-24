<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index()
    {
        // Get sliders ordered by custom sort order
        $sliders = Slider::orderBy('sort_order', 'asc')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
            'sort_order' => 'integer',
        ]);

        $data = $request->except('image');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('sliders'), $filename);
            $data['image_path'] = 'sliders/' . $filename;
        }

        // Checkbox handling (if unchecked, it's missing from request)
        $data['is_active'] = $request->has('is_active');

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Delete old image
            if (File::exists(public_path($slider->image_path))) {
                File::delete(public_path($slider->image_path));
            }

            // Upload new
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('sliders'), $filename);
            $data['image_path'] = 'sliders/' . $filename;
        }

        $data['is_active'] = $request->has('is_active');
        
        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        // Delete image file to keep server clean
        if (File::exists(public_path($slider->image_path))) {
            File::delete(public_path($slider->image_path));
        }
        
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted.');
    }
}