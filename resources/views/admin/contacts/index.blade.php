@extends('layouts.admin')

@section('title', 'Messages')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Contact Messages</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="margin-bottom:1.5rem; border-bottom:1px solid #E2E8F0; padding-bottom:.75rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Inbox Messages</h2>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem;">Name</th>
                    <th style="padding:.75rem;">Email</th>
                    <th style="padding:.75rem;">Subject</th>
                    <th style="padding:.75rem;">Received At</th>
                    <th style="padding:.75rem;">Status</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s; font-weight: {{ $msg->is_read ? 'normal' : '600' }};" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem; color:#0F172A;">{{ $msg->name }}</td>
                    <td style="padding:.75rem; color:#64748B;">{{ $msg->email }}</td>
                    <td style="padding:.75rem; color:#0F172A;">{{ Str::limit($msg->subject, 40) }}</td>
                    <td style="padding:.75rem; color:#64748B;">{{ $msg->created_at->format('M d, Y g:i a') }}</td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $msg->is_read ? 'badge-success' : 'badge-danger' }}">
                            {{ $msg->is_read ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td style="padding:.75rem; text-align:right;">
                        <div style="display:inline-flex; gap:.5rem;">
                            <a href="{{ route('admin.contacts.show', $msg->id) }}" class="btn btn-primary" style="padding:.25rem .625rem; font-size:.75rem;" id="view-message-{{ $msg->id }}">
                                <i class="fas fa-envelope-open"></i> Read
                            </a>
                            <form action="{{ route('admin.contacts.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-message-{{ $msg->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:2rem; text-align:center; color:#64748B;">No contact inquiries found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $messages->links() }}
    </div>
</div>

@endsection
