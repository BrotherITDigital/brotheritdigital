@extends('layouts.admin')

@section('title', 'Edit Client')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.clients.index') }}" style="color:#64748B; text-decoration:none;">Clients</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Edit</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 700px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Edit Client: {{ $client->name }}
    </h2>

    <form action="{{ route('admin.clients.update', $client->id) }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf
        @method('PUT')

        {{-- Client Name --}}
        <div class="form-group">
            <label for="name">Client Name <span style="color:#EF4444;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $client->name) }}" class="form-control @error('name') error @enderror" placeholder="e.g. Acme Corporation" required>
            @error('name')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Website URL --}}
        <div class="form-group">
            <label for="website_url">Website URL</label>
            <input type="url" id="website_url" name="website_url" value="{{ old('website_url', $client->website_url) }}" class="form-control @error('website_url') error @enderror" placeholder="https://example.com">
            @error('website_url')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display:grid; grid-template-columns: 1.2fr 1fr; gap:1rem; align-items:center;">
            {{-- Client Logo --}}
            <div class="form-group">
                <label for="logo">Client Logo</label>
                <input type="file" id="logo" name="logo" class="form-control @error('logo') error @enderror">
                <span style="font-size:.75rem; color:#64748B; margin-top:.25rem; display:block;">Max size: 1MB (JPG, PNG, WebP, SVG)</span>
                @error('logo')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Display Order --}}
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', $client->order) }}" class="form-control" min="0">
            </div>
        </div>

        {{-- Current Logo Preview --}}
        @if($client->logo)
        <div style="margin-bottom: .5rem;">
            <span style="font-size: .875rem; font-weight: 600; display: block; margin-bottom: .25rem;">Current Logo:</span>
            <div style="width: 100px; height: 60px; background: #E2E8F0; border-radius: .25rem; border: 1px solid #CBD5E1; display: flex; align-items: center; justify-content: center; overflow: hidden; padding: 5px;">
                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" style="max-width: 100%; max-height: 100%; object-fit: contain;">
            </div>
        </div>
        @endif

        {{-- Description --}}
        <div class="form-group">
            <label for="description">Client Description / Details</label>
            <textarea id="description" name="description" rows="3" class="form-control @error('description') error @enderror" placeholder="Write a short summary about our collaboration with this client...">{{ old('description', $client->description) }}</textarea>
            @error('description')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Active Toggle --}}
        <div style="display:flex; gap:2rem; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0; padding:1rem 0;">
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $client->is_active) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_active" style="font-weight:600; cursor:pointer; margin:0;">Active Status</label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.clients.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-client-edit-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-client-edit-btn">Update Client</button>
        </div>

    </form>
</div>

@endsection
