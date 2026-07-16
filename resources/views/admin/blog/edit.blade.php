@extends('layouts.admin')

@section('title', 'Edit Article')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.blog.index') }}" style="color:#64748B; text-decoration:none;">Blog</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Edit</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 850px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Edit Article: {{ $blog->title }}
    </h2>

    <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns: 2fr 1fr; gap:1rem;">
            {{-- Title --}}
            <div class="form-group">
                <label for="title">Article Title <span style="color:#EF4444;">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" class="form-control @error('title') error @enderror" placeholder="e.g. Understanding Core Web Vitals in Laravel 12" required>
                @error('title')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="blog_category_id">Category</label>
                <select id="blog_category_id" name="blog_category_id" class="form-control @error('blog_category_id') error @enderror" style="height:auto;">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('blog_category_id', $blog->blog_category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('blog_category_id')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Author --}}
            <div class="form-group">
                <label for="author">Author Name</label>
                <input type="text" id="author" name="author" value="{{ old('author', $blog->author) }}" class="form-control @error('author') error @enderror">
                @error('author')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tags --}}
            <div class="form-group">
                <label for="tags">Tags (Comma-separated)</label>
                <input type="text" id="tags" name="tags" value="{{ old('tags', $blog->tags ? implode(', ', $blog->tags) : '') }}" class="form-control @error('tags') error @enderror" placeholder="e.g. Laravel, PHP, Speed Optimization">
                @error('tags')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Excerpt --}}
        <div class="form-group">
            <label for="excerpt">Short Summary / Excerpt</label>
            <textarea id="excerpt" name="excerpt" rows="2" class="form-control @error('excerpt') error @enderror" placeholder="Write a summary sentence to display in lists...">{{ old('excerpt', $blog->excerpt) }}</textarea>
            @error('excerpt')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Content --}}
        <div class="form-group">
            <label for="content">Article Content <span style="color:#EF4444;">*</span></label>
            <textarea id="content" name="content" rows="10" class="form-control @error('content') error @enderror" placeholder="Write the full body content of your article here (HTML allowed)..." required>{{ old('content', $blog->content) }}</textarea>
            @error('content')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1.5fr; gap:1rem; align-items:center;">
            {{-- Featured Image --}}
            <div class="form-group">
                <label for="featured_image">Featured Image</label>
                <input type="file" id="featured_image" name="featured_image" class="form-control @error('featured_image') error @enderror">
                <span style="font-size:.75rem; color:#64748B; margin-top:.25rem; display:block;">Max size: 3MB (JPG, PNG, WebP)</span>
                @error('featured_image')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Featured & Active Toggles --}}
            <div style="display:flex; gap:2rem; margin-top:1rem;">
                <div style="display:flex; align-items:center; gap:.5rem;">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                    <label for="is_featured" style="font-weight:600; cursor:pointer; margin:0;">Feature on Homepage</label>
                </div>
                <div style="display:flex; align-items:center; gap:.5rem;">
                    <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                    <label for="is_published" style="font-weight:600; cursor:pointer; margin:0;">Publish Article</label>
                </div>
            </div>
        </div>

        {{-- Show existing featured image --}}
        @if($blog->featured_image)
        <div style="margin-bottom: .5rem;">
            <span style="font-size: .875rem; font-weight: 600; display: block; margin-bottom: .25rem;">Current Image:</span>
            <img src="{{ asset('storage/' . $blog->featured_image) }}" alt="Featured Image" style="max-width: 120px; border-radius: .25rem; border: 1px solid #E2E8F0;">
        </div>
        @endif

        {{-- SEO Section --}}
        <h3 style="font-size: .95rem; font-weight: 700; color: #0F172A; margin: .5rem 0 0;">SEO Metadata (Optional)</h3>
        <div style="display:grid; grid-template-columns: 1fr; gap:1rem;">
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" class="form-control" placeholder="Browser title tag fallback">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="2" class="form-control" placeholder="Search result description tag fallback">{{ old('meta_description', $blog->meta_description) }}</textarea>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.blog.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-edit-blog-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-edit-blog-btn">Update Article</button>
        </div>

    </form>
</div>

@endsection
