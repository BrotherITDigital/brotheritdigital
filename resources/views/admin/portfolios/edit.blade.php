@extends('layouts.admin')

@section('title', 'Edit Portfolio Project')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.portfolios.index') }}" style="color:#64748B; text-decoration:none;">Portfolios</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Edit</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Edit Project: {{ $portfolio->title }}
    </h2>

    <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:1rem;">
            {{-- Title --}}
            <div class="form-group">
                <label for="title">Project Title <span style="color:#EF4444;">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $portfolio->title) }}" class="form-control @error('title') error @enderror" placeholder="e.g. ShopEase E-commerce Platform" required>
                @error('title')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category">Category <span style="color:#EF4444;">*</span></label>
                <select id="category" name="category" class="form-control @error('category') error @enderror" style="height:auto;" required>
                    <option value="website" {{ old('category', $portfolio->category) === 'website' ? 'selected' : '' }}>Website Development</option>
                    <option value="mobile" {{ old('category', $portfolio->category) === 'mobile' ? 'selected' : '' }}>Mobile App Development</option>
                    <option value="uiux" {{ old('category', $portfolio->category) === 'uiux' ? 'selected' : '' }}>UI/UX Design</option>
                    <option value="wordpress_landing" {{ old('category', $portfolio->category) === 'wordpress_landing' ? 'selected' : '' }}>Wordpress Landing Page</option>
                    <option value="custom_code_landing" {{ old('category', $portfolio->category) === 'custom_code_landing' ? 'selected' : '' }}>Custom Code Landing Page</option>
                </select>
                @error('category')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Client --}}
            <div class="form-group">
                <label for="client">Client Name</label>
                <input type="text" id="client" name="client" value="{{ old('client', $portfolio->client) }}" class="form-control @error('client') error @enderror" placeholder="e.g. ShopEase Ltd.">
                @error('client')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Date Completed --}}
            <div class="form-group">
                <label for="completed_at">Date Completed</label>
                <input type="date" id="completed_at" name="completed_at" value="{{ old('completed_at', $portfolio->completed_at ? $portfolio->completed_at->format('Y-m-d') : '') }}" class="form-control @error('completed_at') error @enderror">
                @error('completed_at')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Live URL --}}
            <div class="form-group">
                <label for="live_url">Live URL</label>
                <div style="display:flex; gap:0.5rem;">
                    <input type="url" id="live_url" name="live_url" value="{{ old('live_url', $portfolio->live_url) }}" class="form-control @error('live_url') error @enderror" placeholder="https://example.com" style="flex:1;">
                    <button type="button" onclick="fetchLiveScreenshot()" class="btn" style="background:#0F172A; color:#fff; font-size:.8rem; padding:0 1rem; border:none; border-radius:.5rem; font-weight:600; white-space:nowrap; cursor:pointer;" id="fetch-screenshot-btn">
                        Fetch Screenshot
                    </button>
                </div>
                @error('live_url')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- GitHub URL --}}
            <div class="form-group">
                <label for="github_url">GitHub Repository URL</label>
                <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $portfolio->github_url) }}" class="form-control @error('github_url') error @enderror" placeholder="https://github.com/user/repo">
                @error('github_url')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Screenshot Preview container --}}
        <div id="screenshot-preview-container" style="display:none; border:1px solid #E2E8F0; padding:1rem; border-radius:.75rem; background:#F8FAFC; margin-bottom:.5rem;">
            <span style="font-size: .875rem; font-weight: 600; display: block; margin-bottom: .5rem; color:#0F172A;">Website Screenshot Preview:</span>
            <div style="display:flex; gap:1.5rem; align-items:center; flex-wrap:wrap;">
                <div style="width:200px; height:120px; border-radius:.5rem; border:1px solid #CBD5E1; background:#fff; display:flex; align-items:center; justify-content:center; overflow:hidden; position:relative; box-shadow:0 4px 6px -1px rgba(0,0,0,0.05); flex-shrink:0;">
                    <img id="screenshot-preview-img" src="" alt="Screenshot Preview" style="width:100%; height:100%; object-fit:cover; display:none;">
                    <div id="screenshot-preview-loading" style="display:flex; align-items:center; justify-content:center; gap:0.5rem; color:#64748B; font-size:.8rem;">
                        <i class="fas fa-spinner fa-spin"></i> Loading...
                    </div>
                </div>
                <div style="flex:1; min-width:200px;">
                    <p style="font-size:.8rem; color:#64748B; margin:0 0 .5rem 0; line-height:1.4;">A live screenshot has been generated. Click the button below to use this image as the project thumbnail upload.</p>
                    <button type="button" onclick="useScreenshotAsFile()" class="btn btn-primary" style="font-size:.8rem; padding:.5rem 1rem; cursor:pointer;" id="use-screenshot-btn">
                        <i class="fas fa-check"></i> Use as Thumbnail
                    </button>
                </div>
            </div>
        </div>

        {{-- Technologies --}}
        <div class="form-group">
            <label for="technologies">Technologies Used (Comma-separated)</label>
            <input type="text" id="technologies" name="technologies" value="{{ old('technologies', $portfolio->technologies ? implode(', ', $portfolio->technologies) : '') }}" class="form-control @error('technologies') error @enderror" placeholder="e.g. Laravel, React, Tailwind CSS, MySQL">
            @error('technologies')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Short Description --}}
        <div class="form-group">
            <label for="short_description">Short Description <span style="color:#EF4444;">*</span></label>
            <textarea id="short_description" name="short_description" rows="3" class="form-control @error('short_description') error @enderror" placeholder="Short overview sentence..." required>{{ old('short_description', $portfolio->short_description) }}</textarea>
            @error('short_description')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" rows="6" class="form-control @error('description') error @enderror" placeholder="Provide a detailed case study or project explanation...">{{ old('description', $portfolio->description) }}</textarea>
            @error('description')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; align-items:center;">
            {{-- Thumbnail Upload --}}
            <div class="form-group">
                <label for="thumbnail">Featured Thumbnail Image</label>
                <input type="file" id="thumbnail" name="thumbnail" class="form-control @error('thumbnail') error @enderror">
                <span style="font-size:.75rem; color:#64748B; margin-top:.25rem; display:block;">Max size: 2MB (JPG, PNG, WebP)</span>
                @error('thumbnail')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Order --}}
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $portfolio->order) }}" class="form-control" min="0">
            </div>
        </div>

        {{-- Show existing thumbnail --}}
        @if($portfolio->thumbnail)
        <div style="margin-bottom: .5rem;">
            <span style="font-size: .875rem; font-weight: 600; display: block; margin-bottom: .25rem;">Current Thumbnail:</span>
            <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="Thumbnail" style="max-width: 120px; border-radius: .25rem; border: 1px solid #E2E8F0;">
        </div>
        @endif

        {{-- Featured & Active Toggles --}}
        <div style="display:flex; gap:2rem; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0; padding:1rem 0;">
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $portfolio->is_featured) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_featured" style="font-weight:600; cursor:pointer; margin:0;">Feature on Homepage</label>
            </div>
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $portfolio->is_active) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_active" style="font-weight:600; cursor:pointer; margin:0;">Active Status</label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.portfolios.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-edit-project-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-edit-project-btn">Update Project</button>
        </div>

    </form>
</div>

@endsection

@push('scripts')
<script>
    let fetchedBlob = null;

    async function fetchLiveScreenshot() {
        const urlInput = document.getElementById('live_url');
        const url = urlInput.value.trim();

        if (!url) {
            alert('Please enter a valid website URL first.');
            return;
        }

        const previewContainer = document.getElementById('screenshot-preview-container');
        const previewImg = document.getElementById('screenshot-preview-img');
        const loadingIndicator = document.getElementById('screenshot-preview-loading');
        const useBtn = document.getElementById('use-screenshot-btn');

        // Reset state
        previewContainer.style.display = 'block';
        previewImg.style.display = 'none';
        loadingIndicator.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
        loadingIndicator.style.display = 'flex';
        useBtn.disabled = true;

        try {
            // Use image.thum.io API
            const screenshotUrl = 'https://image.thum.io/get/width/1280/crop/800/' + url;

            // Fetch image as blob
            const response = await fetch(screenshotUrl);
            if (!response.ok) throw new Error('Failed to fetch screenshot');

            fetchedBlob = await response.blob();

            // Create object URL to show preview
            const objectUrl = URL.createObjectURL(fetchedBlob);
            previewImg.src = objectUrl;
            previewImg.style.display = 'block';
            loadingIndicator.style.display = 'none';
            useBtn.disabled = false;
        } catch (error) {
            console.error(error);
            loadingIndicator.innerHTML = '<span style="color:#EF4444;"><i class="fas fa-times-circle"></i> Error generating preview. Please try again.</span>';
        }
    }

    function useScreenshotAsFile() {
        if (!fetchedBlob) {
            alert('No screenshot fetched yet.');
            return;
        }

        // Convert blob to File object
        const file = new File([fetchedBlob], 'website-screenshot.jpg', { type: 'image/jpeg' });
        
        // Inject file into input using DataTransfer
        const container = new DataTransfer();
        container.items.add(file);
        
        const fileInput = document.getElementById('thumbnail');
        if (fileInput) {
            fileInput.files = container.files;
            
            // Trigger change event
            fileInput.dispatchEvent(new Event('change'));
            alert('Successfully selected screenshot as the thumbnail image!');
        } else {
            alert('Thumbnail file input not found!');
        }
    }
</script>
@endpush
