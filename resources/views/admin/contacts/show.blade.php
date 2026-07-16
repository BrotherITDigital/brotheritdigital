@extends('layouts.admin')

@section('title', 'Read Message')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<a href="{{ route('admin.contacts.index') }}" style="color:#64748B; text-decoration:none;">Contact Messages</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Read</span>
@endsection

@section('content')

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem; border-bottom:1px solid #E2E8F0; padding-bottom:.75rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Message Details</h2>
        <a href="{{ route('admin.contacts.index') }}" class="btn" style="border:1px solid #E2E8F0; color:#0F172A; background:transparent; padding:.5rem 1rem; font-size:.8125rem;" id="back-inbox-btn">
            <i class="fas fa-arrow-left"></i> Back to Inbox
        </a>
    </div>

    <div style="display:flex; flex-direction:column; gap:1.25rem; font-size:.9375rem;">
        
        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; background:#F8FAFC; padding:1rem; border-radius:.375rem;">
            <div>
                <span style="color:#64748B; display:block; font-size:.75rem; text-transform:uppercase; font-weight:600; margin-bottom:.125rem;">Sender Name</span>
                <span style="font-weight:600; color:#0F172A;">{{ $message->name }}</span>
            </div>
            <div>
                <span style="color:#64748B; display:block; font-size:.75rem; text-transform:uppercase; font-weight:600; margin-bottom:.125rem;">Email Address</span>
                <a href="mailto:{{ $message->email }}" style="color:var(--primary); font-weight:500;">{{ $message->email }}</a>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem; background:#F8FAFC; padding:1rem; border-radius:.375rem;">
            <div>
                <span style="color:#64748B; display:block; font-size:.75rem; text-transform:uppercase; font-weight:600; margin-bottom:.125rem;">Phone Number</span>
                <span style="color:#0F172A;">{{ $message->phone ?? 'N/A' }}</span>
            </div>
            <div>
                <span style="color:#64748B; display:block; font-size:.75rem; text-transform:uppercase; font-weight:600; margin-bottom:.125rem;">Received Date</span>
                <span style="color:#0F172A;">{{ $message->created_at->format('F d, Y \a\t g:i a') }}</span>
            </div>
        </div>

        <div style="background:#F8FAFC; padding:1rem; border-radius:.375rem;">
            <span style="color:#64748B; display:block; font-size:.75rem; text-transform:uppercase; font-weight:600; margin-bottom:.125rem;">Subject</span>
            <span style="font-weight:700; color:#0F172A; font-size:1rem;">{{ $message->subject }}</span>
        </div>

        <div style="background:#F8FAFC; padding:1.5rem; border-radius:.375rem; border-left:4px solid var(--primary);">
            <span style="color:#64748B; display:block; font-size:.75rem; text-transform:uppercase; font-weight:600; margin-bottom:.75rem;">Message Body</span>
            <div style="color:#0F172A; line-height:1.7; white-space:pre-line;">
                {{ $message->message }}
            </div>
        </div>

        {{-- Reply / Delete Actions --}}
        <div style="display:flex; justify-content:flex-end; gap:1rem; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:1rem;">
            <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" style="background:#EF4444; color:#fff;" id="delete-message-detail-btn">
                    <i class="fas fa-trash-alt"></i> Delete Message
                </button>
            </form>
            
            <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn btn-primary" id="reply-message-btn">
                <i class="fas fa-reply"></i> Reply via Email
            </a>
        </div>

    </div>
</div>

@endsection
