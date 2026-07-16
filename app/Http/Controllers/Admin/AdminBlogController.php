<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->latest()->paginate(12);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'featured_image'   => 'nullable|image|max:3072',
            'tags'             => 'nullable|string',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
            'author'           => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['tags']         = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        $data['published_at'] = $data['is_published'] ? now() : null;
        $data['author']       = $request->author ?? 'Brother IT Digital';

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('uploads/blog', 'public');
        }

        BlogPost::create($data);
        return redirect()->route('admin.blog.index')->with('success', 'Blog post created!');
    }

    public function edit(BlogPost $blog)
    {
        $categories = BlogCategory::where('is_active', true)->get();
        return view('admin.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $data = $request->validate([
            'title'            => 'required|string|max:255',
            'blog_category_id' => 'nullable|exists:blog_categories,id',
            'excerpt'          => 'nullable|string|max:500',
            'content'          => 'required|string',
            'featured_image'   => 'nullable|image|max:3072',
            'tags'             => 'nullable|string',
            'is_featured'      => 'boolean',
            'is_published'     => 'boolean',
            'author'           => 'nullable|string|max:255',
            'meta_title'       => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['tags']         = $request->tags ? array_map('trim', explode(',', $request->tags)) : [];
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        if ($data['is_published'] && !$blog->published_at) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) Storage::disk('public')->delete($blog->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('uploads/blog', 'public');
        }

        $blog->update($data);
        return redirect()->route('admin.blog.index')->with('success', 'Blog post updated!');
    }

    public function destroy(BlogPost $blog)
    {
        if ($blog->featured_image) Storage::disk('public')->delete($blog->featured_image);
        $blog->delete();
        return redirect()->route('admin.blog.index')->with('success', 'Post deleted.');
    }

    public function togglePublish(int $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->update([
            'is_published' => !$post->is_published,
            'published_at' => !$post->is_published ? now() : $post->published_at,
        ]);
        return back()->with('success', 'Status updated.');
    }
}
