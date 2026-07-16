@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.testimonials.index') }}" style="color:#64748B; text-decoration:none;">Testimonials</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Edit</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Edit Testimonial: {{ $testimonial->client_name }}
    </h2>

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Client Name --}}
            <div class="form-group">
                <label for="client_name">Client Name <span style="color:#EF4444;">*</span></label>
                <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $testimonial->client_name) }}" class="form-control @error('client_name') error @enderror" placeholder="e.g. Fatima Al-Hassan" required>
                @error('client_name')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Company --}}
            <div class="form-group">
                <label for="company">Company / Organization</label>
                <input type="text" id="company" name="company" value="{{ old('company', $testimonial->company) }}" class="form-control @error('company') error @enderror" placeholder="e.g. ShopEase Ltd.">
                @error('company')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Position --}}
            <div class="form-group">
                <label for="position">Client Position / Title</label>
                <input type="text" id="position" name="position" value="{{ old('position', $testimonial->position) }}" class="form-control @error('position') error @enderror" placeholder="e.g. Founder & CTO">
                @error('position')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Rating --}}
            <div class="form-group">
                <label for="rating">Rating (1 to 5 Stars) <span style="color:#EF4444;">*</span></label>
                <select id="rating" name="rating" class="form-control @error('rating') error @enderror" style="height:auto;" required>
                    <option value="5" {{ old('rating', $testimonial->rating) == '5' ? 'selected' : '' }}>5 Stars (Excellent)</option>
                    <option value="4" {{ old('rating', $testimonial->rating) == '4' ? 'selected' : '' }}>4 Stars (Good)</option>
                    <option value="3" {{ old('rating', $testimonial->rating) == '3' ? 'selected' : '' }}>3 Stars (Average)</option>
                    <option value="2" {{ old('rating', $testimonial->rating) == '2' ? 'selected' : '' }}>2 Stars (Fair)</option>
                    <option value="1" {{ old('rating', $testimonial->rating) == '1' ? 'selected' : '' }}>1 Star (Poor)</option>
                </select>
                @error('rating')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; align-items:center;">
            {{-- Photo --}}
            <div class="form-group">
                <label for="photo">Client Photo</label>
                <input type="file" id="photo" name="photo" class="form-control @error('photo') error @enderror">
                <span style="font-size:.75rem; color:#64748B; margin-top:.25rem; display:block;">Max size: 1MB (JPG, PNG, WebP)</span>
                @error('photo')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Display Order --}}
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $testimonial->order) }}" class="form-control" min="0">
            </div>
        </div>

        {{-- Show existing client photo --}}
        @if($testimonial->photo)
        <div style="margin-bottom: .5rem;">
            <span style="font-size: .875rem; font-weight: 600; display: block; margin-bottom: .25rem;">Current Photo:</span>
            <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="Client Photo" style="max-width: 100px; border-radius: .25rem; border: 1px solid #E2E8F0;">
        </div>
        @endif

        {{-- Review Message --}}
        <div class="form-group">
            <label for="review">Client Review <span style="color:#EF4444;">*</span></label>
            <textarea id="review" name="review" rows="5" class="form-control @error('review') error @enderror" placeholder="Copy-paste client comments or feedback details..." required>{{ old('review', $testimonial->review) }}</textarea>
            @error('review')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Featured & Active Toggles --}}
        <div style="display:flex; gap:2rem; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0; padding:1rem 0;">
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $testimonial->is_featured) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_featured" style="font-weight:600; cursor:pointer; margin:0;">Feature on Homepage</label>
            </div>
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $testimonial->is_active) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_active" style="font-weight:600; cursor:pointer; margin:0;">Active Status</label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.testimonials.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-edit-testimonial-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-edit-testimonial-btn">Update Testimonial</button>
        </div>

    </form>
</div>

@endsection
