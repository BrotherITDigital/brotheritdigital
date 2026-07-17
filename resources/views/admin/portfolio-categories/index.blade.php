@extends('layouts.admin')

@section('title', 'Manage Portfolio Categories')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.portfolios.index') }}" style="color:#64748B; text-decoration:none;">Portfolios</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Categories</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Portfolio Categories</h2>
        <div style="display:flex; gap:.5rem;">
            <a href="{{ route('admin.portfolios.index') }}" class="btn btn-outline" style="padding: .5rem 1.25rem; font-size: .8125rem; background:transparent; border:1px solid #E2E8F0; color:#0F172A;" id="back-portfolios-btn">
                <i class="fas fa-arrow-left"></i> Back to Portfolios
            </a>
            <a href="{{ route('admin.portfolio-categories.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-category-btn">
                <i class="fas fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="padding: 1rem; background: #DEF7EC; color: #03543F; border-radius: .375rem; margin-bottom: 1.5rem; font-size: .875rem;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="padding: 1rem; background: #FDE8E8; color: #9B1C1C; border-radius: .375rem; margin-bottom: 1.5rem; font-size: .875rem;">
            {{ session('error') }}
        </div>
    @endif

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem;">ID</th>
                    <th style="padding:.75rem;">Name</th>
                    <th style="padding:.75rem;">Slug</th>
                    <th style="padding:.75rem;">Total Projects</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem; color:#64748B;">{{ $category->id }}</td>
                    <td style="padding:.75rem; font-weight:600; color:#0F172A;">{{ $category->name }}</td>
                    <td style="padding:.75rem; color:#64748B;">{{ $category->slug }}</td>
                    <td style="padding:.75rem;">
                        <span class="badge badge-primary">{{ $category->portfolios_count }} projects</span>
                    </td>
                    <td style="padding:.75rem; text-align:right;">
                        <div style="display:inline-flex; gap:.5rem;">
                            <a href="{{ route('admin.portfolio-categories.edit', $category->id) }}" class="btn" style="padding:.25rem .625rem; font-size:.75rem; border:1px solid #E2E8F0; background:transparent; color:#0F172A;" id="edit-category-{{ $category->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.portfolio-categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-category-{{ $category->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:2rem; text-align:center; color:#64748B;">No portfolio categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $categories->links() }}
    </div>
</div>

@endsection
