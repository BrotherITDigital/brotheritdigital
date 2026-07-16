@extends('layouts.admin')

@section('title', 'Add User')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.users.index') }}" style="color:#64748B; text-decoration:none;">Users</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Create</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 600px; margin: 0 auto;">
    <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.5rem; border-bottom: 1px solid #E2E8F0; padding-bottom: .75rem;">
        Add System Administrator
    </h2>

    <form action="{{ route('admin.users.store') }}" method="POST" style="display:flex; flex-direction:column; gap:1.25rem;">
        @csrf

        {{-- Name --}}
        <div class="form-group">
            <label for="name">Full Name <span style="color:#EF4444;">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') error @enderror" placeholder="e.g. John Doe" required>
            @error('name')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Email --}}
        <div class="form-group">
            <label for="email">Email Address <span style="color:#EF4444;">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') error @enderror" placeholder="john@brotherit.com" required>
            @error('email')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label for="password">Password <span style="color:#EF4444;">*</span></label>
            <input type="password" id="password" name="password" class="form-control @error('password') error @enderror" placeholder="At least 8 characters..." required>
            @error('password')
            <span style="color:#EF4444; font-size:.75rem; margin-top:.25rem; display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="form-group">
            <label for="password_confirmation">Confirm Password <span style="color:#EF4444;">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-type password..." required>
        </div>

        {{-- Form Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:.5rem;">
            <a href="{{ route('admin.users.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent;" id="cancel-user-btn">Cancel</a>
            <button type="submit" class="btn btn-primary" id="save-user-btn">Create User</button>
        </div>

    </form>
</div>

@endsection
