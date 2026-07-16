@extends('layouts.admin')

@section('title', 'Create Service')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.services.index') }}" style="color:#64748B; text-decoration:none;">Services</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Create</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Add New Service
    </h2>

    <form action="{{ route('admin.services.store') }}" method="POST" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Title --}}
            <div class="form-group">
                <label for="title">Service Title <span style="color:#EF4444;">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') error @enderror" placeholder="e.g. E-commerce Website" required>
                @error('title')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category">Category <span style="color:#EF4444;">*</span></label>
                <select id="category" name="category" class="form-control @error('category') error @enderror" style="height:auto;" required>
                    <option value="website" {{ old('category') === 'website' ? 'selected' : '' }}>Website Development</option>
                    <option value="mobile" {{ old('category') === 'mobile' ? 'selected' : '' }}>Mobile App Development</option>
                    <option value="uiux" {{ old('category') === 'uiux' ? 'selected' : '' }}>UI/UX Design</option>
                    <option value="digital" {{ old('category') === 'digital' ? 'selected' : '' }}>Digital Services</option>
                </select>
                @error('category')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:1rem;">
            {{-- Icon --}}
            <div class="form-group">
                <label for="icon">FontAwesome Icon Class <span style="color:#EF4444;">*</span></label>
                <input type="text" id="icon" name="icon" value="{{ old('icon', 'fas fa-code') }}" class="form-control @error('icon') error @enderror" placeholder="e.g. fas fa-shopping-cart" required>
                <span style="font-size:.75rem; color:#64748B; margin-top:.25rem; display:block;">Get icon classes from <a href="https://fontawesome.com/search?o=r&m=free" target="_blank" rel="noopener">FontAwesome (Free)</a></span>
                @error('icon')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Order --}}
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" class="form-control @error('order') error @enderror" min="0">
                @error('order')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Short Description --}}
        <div class="form-group">
            <label for="short_description">Short Description <span style="color:#EF4444;">*</span></label>
            <textarea id="short_description" name="short_description" rows="3" class="form-control @error('short_description') error @enderror" placeholder="Brief summary for list/card views..." required>{{ old('short_description') }}</textarea>
            @error('short_description')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Full Description --}}
        <div class="form-group">
            <label for="description">Full Description</label>
            <textarea id="description" name="description" rows="6" class="form-control @error('description') error @enderror" placeholder="Full overview details for the service detail page...">{{ old('description') }}</textarea>
            @error('description')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Featured & Active Toggles --}}
        <div style="display:flex; gap:2rem; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0; padding:1rem 0;">
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_featured" style="font-weight:600; cursor:pointer; margin:0;">Feature on Homepage</label>
            </div>
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_active" style="font-weight:600; cursor:pointer; margin:0;">Active Status</label>
            </div>
        </div>

        {{-- SEO Section --}}
        <h3 style="font-size: .95rem; font-weight: 700; color: #0F172A; margin: .5rem 0 0;">SEO Metadata (Optional)</h3>
        <div style="display:grid; grid-template-columns: 1fr; gap:1rem;">
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" class="form-control" placeholder="Browser title tag fallback">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="2" class="form-control" placeholder="Search result excerpt tag fallback"></textarea>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.services.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-service-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-service-btn">Create Service</button>
        </div>

    </form>
</div>

@endsection
