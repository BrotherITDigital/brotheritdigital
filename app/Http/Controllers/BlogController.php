<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;

class BlogController extends Controller
{
    public function index()
    {
        $posts      = BlogPost::published()->paginate(9);
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])
            ->where('is_active', true)->get();
        $recent     = BlogPost::published()->take(3)->get();
        return view('pages.blog.index', compact('posts', 'categories', 'recent'));
    }

    public function show(string $slug)
    {
        $post = BlogPost::published()->where('slug', $slug)->firstOrFail();
        $post->increment('views');
        $related    = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where('blog_category_id', $post->blog_category_id)
            ->take(3)->get();
        $categories = BlogCategory::withCount(['posts' => fn($q) => $q->published()])
            ->where('is_active', true)->get();
        $recent     = BlogPost::published()->where('id', '!=', $post->id)->take(3)->get();
        return view('pages.blog.show', compact('post', 'related', 'categories', 'recent'));
    }
}
