<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\GeneralSetting;

class PostController extends Controller
{
    // Show all posts (Paginated)
    public function index()
    {
        return view('blog.index', [
            'settings' => GeneralSetting::first(),
            // Get latest posts, 9 per page
            'posts' => Post::whereNotNull('published_at')->latest()->paginate(9),
        ]);
    }

    // Show single post
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->whereNotNull('published_at')
            ->firstOrFail();

        return view('blog.show', [
            'settings' => GeneralSetting::first(),
            'post' => $post,
            // Show 3 recent posts in the sidebar
            'recent_posts' => Post::where('id', '!=', $post->id)
                ->whereNotNull('published_at')
                ->latest()
                ->take(3)
                ->get(),
        ]);
    }
}