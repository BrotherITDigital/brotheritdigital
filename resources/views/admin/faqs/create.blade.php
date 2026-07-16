@extends('layouts.admin')

@section('title', 'Add FAQ')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.faqs.index') }}" style="color:#64748B; text-decoration:none;">FAQs</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Create</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Add Frequently Asked Question
    </h2>

    <form action="{{ route('admin.faqs.store') }}" method="POST" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf

        <div style="display:grid; grid-template-columns: 2fr 1fr; gap:1rem;">
            {{-- Question --}}
            <div class="form-group">
                <label for="question">Question / Title <span style="color:#EF4444;">*</span></label>
                <input type="text" id="question" name="question" value="{{ old('question') }}" class="form-control @error('question') error @enderror" placeholder="e.g. What hosting options do you support?" required>
                @error('question')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>

            {{-- Category --}}
            <div class="form-group">
                <label for="category">Category <span style="color:#EF4444;">*</span></label>
                <select id="category" name="category" class="form-control @error('category') error @enderror" style="height:auto;" required>
                    <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>General Info</option>
                    <option value="technology" {{ old('category') === 'technology' ? 'selected' : '' }}>Technology</option>
                    <option value="pricing" {{ old('category') === 'pricing' ? 'selected' : '' }}>Pricing</option>
                    <option value="timeline" {{ old('category') === 'timeline' ? 'selected' : '' }}>Timeline</option>
                    <option value="support" {{ old('category') === 'support' ? 'selected' : '' }}>Support & Hosting</option>
                </select>
                @error('category')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr; gap:1rem;">
            {{-- Answer --}}
            <div class="form-group">
                <label for="answer">Answer Content <span style="color:#EF4444;">*</span></label>
                <textarea id="answer" name="answer" rows="5" class="form-control @error('answer') error @enderror" placeholder="Write detailed answer explanation here..." required>{{ old('answer') }}</textarea>
                @error('answer')
                <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; align-items:center;">
            {{-- Display Order --}}
            <div class="form-group">
                <label for="order">Display Order</label>
                <input type="number" id="order" name="order" value="{{ old('order', 0) }}" class="form-control" min="0">
            </div>

            {{-- Active Status --}}
            <div style="display:flex; align-items:center; gap:.5rem; margin-top:1.25rem;">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:1.1rem; height:1.1rem; cursor:pointer;">
                <label for="is_active" style="font-weight:600; cursor:pointer; margin:0;">Active Status</label>
            </div>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.faqs.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-faq-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-faq-btn">Create FAQ</button>
        </div>

    </form>
</div>

@endsection
