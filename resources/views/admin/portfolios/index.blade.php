@extends('layouts.admin')

@section('title', 'Manage Portfolios')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Portfolios</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Portfolio Projects</h2>
        <a href="{{ route('admin.portfolios.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-portfolio-btn">
            <i class="fas fa-plus"></i> Add Project
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem;">Thumbnail</th>
                    <th style="padding:.75rem;">Title</th>
                    <th style="padding:.75rem;">Category</th>
                    <th style="padding:.75rem;">Client</th>
                    <th style="padding:.75rem;">Featured</th>
                    <th style="padding:.75rem;">Status</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($portfolios as $project)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem;">
                        <div style="width: 3.5rem; height: 2.25rem; border-radius: .25rem; overflow: hidden; background: #E2E8F0;">
                            @if($project->thumbnail)
                                <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div style="width:100%; height:100%; background:linear-gradient(135deg,var(--primary),var(--accent));"></div>
                            @endif
                        </div>
                    </td>
                    <td style="padding:.75rem; font-weight:600; color:#0F172A;">{{ $project->title }}</td>
                    <td style="padding:.75rem;">
                        <span class="badge badge-primary">{{ ucfirst($project->category) }}</span>
                    </td>
                    <td style="padding:.75rem; color:#64748B;">{{ $project->client ?? 'N/A' }}</td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $project->is_featured ? 'badge-success' : 'badge-danger' }}">
                            {{ $project->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $project->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $project->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding:.75rem; text-align:right;">
                        <div style="display:inline-flex; gap:.5rem;">
                            <a href="{{ route('admin.portfolios.edit', $project->id) }}" class="btn" style="padding:.25rem .625rem; font-size:.75rem; border:1px solid #E2E8F0; background:transparent; color:#0F172A;" id="edit-portfolio-{{ $project->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.portfolios.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-portfolio-{{ $project->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:2rem; text-align:center; color:#64748B;">No portfolio projects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $portfolios->links() }}
    </div>
</div>

@endsection
