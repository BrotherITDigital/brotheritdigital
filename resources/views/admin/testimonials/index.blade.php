@extends('layouts.admin')

@section('title', 'Manage Testimonials')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Testimonials</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Client Testimonials</h2>
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-testimonial-btn">
            <i class="fas fa-plus"></i> Add Testimonial
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem;">Photo</th>
                    <th style="padding:.75rem;">Client Name</th>
                    <th style="padding:.75rem;">Company / Role</th>
                    <th style="padding:.75rem;">Rating</th>
                    <th style="padding:.75rem;">Featured</th>
                    <th style="padding:.75rem;">Status</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($testimonials as $t)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem;">
                        <div style="width: 2.25rem; height: 2.25rem; border-radius: 50%; overflow: hidden; background: #E2E8F0;">
                            @if($t->photo)
                                <img src="{{ asset('storage/' . $t->photo) }}" alt="{{ $t->client_name }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div style="width:100%; height:100%; background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1rem; font-weight:700;">
                                    {{ strtoupper(substr($t->client_name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                    </td>
                    <td style="padding:.75rem; font-weight:600; color:#0F172A;">{{ $t->client_name }}</td>
                    <td style="padding:.75rem; color:#64748B;">
                        {{ $t->position }}{{ $t->company ? ' at ' . $t->company : '' }}
                    </td>
                    <td style="padding:.75rem; color:#F59E0B;">
                        @for($s=1; $s<=5; $s++)
                        <i class="fas fa-star" style="color:{{ $s <= $t->rating ? '#F59E0B' : '#E2E8F0' }}"></i>
                        @endfor
                    </td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $t->is_featured ? 'badge-success' : 'badge-danger' }}">
                            {{ $t->is_featured ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $t->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $t->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding:.75rem; text-align:right;">
                        <div style="display:inline-flex; gap:.5rem;">
                            <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn" style="padding:.25rem .625rem; font-size:.75rem; border:1px solid #E2E8F0; background:transparent; color:#0F172A;" id="edit-testimonial-{{ $t->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this testimonial?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-testimonial-{{ $t->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding:2rem; text-align:center; color:#64748B;">No testimonials found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $testimonials->links() }}
    </div>
</div>

@endsection
