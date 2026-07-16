@extends('layouts.admin')

@section('title', 'Manage FAQs')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">FAQs</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Frequently Asked Questions</h2>
        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-faq-btn">
            <i class="fas fa-plus"></i> Add FAQ
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem; width:45%;">Question</th>
                    <th style="padding:.75rem;">Category</th>
                    <th style="padding:.75rem;">Status</th>
                    <th style="padding:.75rem;">Order</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem; font-weight:600; color:#0F172A;">{{ Str::limit($faq->question, 60) }}</td>
                    <td style="padding:.75rem;">
                        <span class="badge badge-primary">{{ ucfirst($faq->category) }}</span>
                    </td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $faq->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $faq->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding:.75rem; color:#64748B;">{{ $faq->order }}</td>
                    <td style="padding:.75rem; text-align:right;">
                        <div style="display:inline-flex; gap:.5rem;">
                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn" style="padding:.25rem .625rem; font-size:.75rem; border:1px solid #E2E8F0; background:transparent; color:#0F172A;" id="edit-faq-{{ $faq->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this FAQ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-faq-{{ $faq->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding:2rem; text-align:center; color:#64748B;">No FAQs found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $faqs->links() }}
    </div>
</div>

@endsection
