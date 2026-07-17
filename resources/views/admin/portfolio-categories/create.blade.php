@extends('layouts.admin')

@section('title', 'Add Portfolio Category')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.portfolios.index') }}" style="color:#64748B; text-decoration:none;">Portfolios</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.portfolio-categories.index') }}" style="color:#64748B; text-decoration:none;">Categories</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Add</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 600px; margin: 0 auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; border-bottom:1px solid #E2E8F0; padding-bottom:1rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Add New Category</h2>
        <a href="{{ route('admin.portfolio-categories.index') }}" style="color:#64748B; text-decoration:none; font-size:.875rem;" id="back-categories-btn">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.portfolio-categories.store') }}" method="POST">
        @csrf

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="name" style="display:block; margin-bottom:.5rem; font-weight:600; color:#334155; font-size:.875rem;">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" style="width:100%; padding:.625rem; border:1px solid #CBD5E1; border-radius:.375rem; font-size:.875rem;" value="{{ old('name') }}" placeholder="e.g. E-Commerce Solutions" required>
            @error('name')
                <span style="color:#EF4444; font-size:.75rem; display:block; margin-top:.25rem;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display:flex; justify-content:flex-end; gap:.75rem; border-top:1px solid #E2E8F0; padding-top:1.5rem; margin-top:2rem;">
            <a href="{{ route('admin.portfolio-categories.index') }}" class="btn btn-outline" style="padding: .5rem 1.25rem; font-size: .875rem; background:transparent; border:1px solid #E2E8F0; color:#0F172A;" id="cancel-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .875rem;" id="save-btn">Save Category</button>
        </div>
    </form>
</div>

@endsection
