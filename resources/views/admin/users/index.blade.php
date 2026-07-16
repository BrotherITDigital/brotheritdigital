@extends('layouts.admin')

@section('title', 'Manage Users')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Users</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">System Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-user-btn">
            <i class="fas fa-user-plus"></i> Add User
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem;">Avatar</th>
                    <th style="padding:.75rem;">Name</th>
                    <th style="padding:.75rem;">Email Address</th>
                    <th style="padding:.75rem;">Role</th>
                    <th style="padding:.75rem;">Created Date</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem;">
                        <div style="width: 2.25rem; height: 2.25rem; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: .9rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    </td>
                    <td style="padding:.75rem; font-weight:600; color:#0F172A;">{{ $user->name }}</td>
                    <td style="padding:.75rem; color:#64748B;">{{ $user->email }}</td>
                    <td style="padding:.75rem;">
                        <span class="badge badge-primary" style="font-size: .7rem;">Administrator</span>
                    </td>
                    <td style="padding:.75rem; color:#64748B;">{{ $user->created_at->format('M d, Y') }}</td>
                    <td style="padding:.75rem; text-align:right;">
                        @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-user-{{ $user->id }}">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                        @else
                        <span style="font-size:.75rem; color:#64748B; font-weight:600;">Active Account</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:2rem; text-align:center; color:#64748B;">No system users found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $users->links() }}
    </div>
</div>

@endsection
