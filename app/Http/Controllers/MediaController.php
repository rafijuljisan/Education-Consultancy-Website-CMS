<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery; // Your Image Model
use App\Models\Video;   // Your Video Model

class MediaController extends Controller
{
    // Show Photo Gallery
    public function photos()
    {
        $galleries = Gallery::latest()->get(); // Or paginate(12)
        return view('gallery.photos', compact('galleries'));
    }

    // Show Video Gallery
    public function videos()
    {
        $videos = Video::latest()->get();
        return view('gallery.videos', compact('videos'));
    }
}