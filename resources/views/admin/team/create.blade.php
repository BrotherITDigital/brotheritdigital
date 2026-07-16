@extends('layouts.admin')

@section('title', 'Add Team Member')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.team.index') }}" style="color:#64748B; text-decoration:none;">Team</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Create</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Add New Team Member
    </h2>

    <form action="{{ route('admin.team.store') }}" method="POST" enctype="multipart/form-data" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Name --}}
            <div class="form-group">
                <label for="name">Full Name <span style="color:#EF4444;">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') error @enderror" placeholder="e.g. Sarah Ahmed" required>
                @error('name')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Position --}}
            <div class="form-group">
                <label for="position">Job Position <span style="color:#EF4444;">*</span></label>
                <input type="text" id="position" name="position" value="{{ old('position') }}" class="form-control @error('position') error @enderror" placeholder="e.g. UI/UX Designer" required>
                @error('position')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1.5fr 1fr; gap:1rem;">
            {{-- Skills --}}
            <div class="form-group">
                <label for="skills">Key Skills (Comma-separated)</label>
                <input type="text" id="skills" name="skills" value="{{ old('skills') }}" class="form-control @error('skills') error @enderror" placeholder="e.g. Figma, Illustrator, CSS, Tailwind">
                @error('skills')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Display Order --}}
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" class="form-control" min="0">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            {{-- Email --}}
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') error @enderror" placeholder="sarah@example.com">
                @error('email')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Profile Photo --}}
            <div class="form-group">
                <label for="photo">Profile Photo</label>
                <input type="file" id="photo" name="photo" class="form-control @error('photo') error @enderror">
                <span style="font-size:.75rem; color:#64748B; margin-top:.25rem; display:block;">Max size: 2MB (JPG, PNG, WebP)</span>
                @error('photo')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Bio --}}
        <div class="form-group">
            <label for="bio">Biography / Short Summary</label>
            <textarea id="bio" name="bio" rows="3" class="form-control @error('bio') error @enderror" placeholder="Tell us about this team member's role and background...">{{ old('bio') }}</textarea>
            @error('bio')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Social Media Links --}}
        <h3 style="font-size: .95rem; font-weight: 700; color: #0F172A; margin: .5rem 0 0;">Social Profile URLs</h3>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label for="github">GitHub Profile URL</label>
                <input type="url" id="github" name="github" value="{{ old('github') }}" class="form-control" placeholder="https://github.com/username">
            </div>
            <div class="form-group">
                <label for="linkedin">LinkedIn Profile URL</label>
                <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" class="form-control" placeholder="https://linkedin.com/in/username">
            </div>
        </div>
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
            <div class="form-group">
                <label for="twitter">Twitter Profile URL</label>
                <input type="url" id="twitter" name="twitter" value="{{ old('twitter') }}" class="form-control" placeholder="https://twitter.com/username">
            </div>
            <div class="form-group">
                <label for="facebook">Facebook Profile URL</label>
                <input type="url" id="facebook" name="facebook" value="{{ old('facebook') }}" class="form-control" placeholder="https://facebook.com/username">
            </div>
        </div>

        {{-- Active Toggle --}}
        <div style="display:flex; gap:2rem; border-top:1px solid #E2E8F0; border-bottom:1px solid #E2E8F0; padding:1rem 0;">
            <div style="display:flex; align-items:center; gap:.5rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_active" style="font-weight:600; cursor:pointer; margin:0;">Active Member</label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.team.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-member-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-member-btn">Add Member</button>
        </div>

    </form>
</div>

@endsection
