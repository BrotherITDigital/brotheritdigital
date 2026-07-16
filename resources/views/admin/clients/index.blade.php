@extends('layouts.admin')

@section('title', 'Manage Clients')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Clients</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Our Clients</h2>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-client-btn">
            <i class="fas fa-plus"></i> Add Client
        </a>
    </div>

    <div style="overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
            <thead>
                <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                    <th style="padding:.75rem; width:15%;">Logo</th>
                    <th style="padding:.75rem;">Name</th>
                    <th style="padding:.75rem;">Website</th>
                    <th style="padding:.75rem;">Status</th>
                    <th style="padding:.75rem;">Order</th>
                    <th style="padding:.75rem; text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients as $client)
                <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                    <td style="padding:.75rem;">
                        <div style="width: 4rem; height: 2.5rem; border-radius: .25rem; overflow: hidden; background: #E2E8F0; display: flex; align-items: center; justify-content: center; border: 1px solid #CBD5E1;">
                            @if($client->logo)
                                <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}" style="max-width:100%; max-height:100%; object-fit:contain;">
                            @else
                                <span style="font-size:.65rem; color:#64748B; font-weight:700;">No Logo</span>
                            @endif
                        </div>
                    </td>
                    <td style="padding:.75rem; font-weight:600; color:#0F172A;">{{ $client->name }}</td>
                    <td style="padding:.75rem; color:#64748B;">
                        @if($client->website_url)
                            <a href="{{ $client->website_url }}" target="_blank" rel="noopener noreferrer" style="color:var(--primary); text-decoration:none;">
                                {{ Str::limit($client->website_url, 40) }} <i class="fas fa-external-link-alt" style="font-size:.7rem;"></i>
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="padding:.75rem;">
                        <span class="badge {{ $client->is_active ? 'badge-success' : 'badge-danger' }}">
                            {{ $client->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td style="padding:.75rem; color:#64748B;">{{ $client->order }}</td>
                    <td style="padding:.75rem; text-align:right;">
                        <div style="display:inline-flex; gap:.5rem;">
                            <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn" style="padding:.25rem .625rem; font-size:.75rem; border:1px solid #E2E8F0; background:transparent; color:#0F172A;" id="edit-client-{{ $client->id }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this client?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding:.25rem .625rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-client-{{ $client->id }}">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:2rem; text-align:center; color:#64748B;">No clients added yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:1.5rem;">
        {{ $clients->links() }}
    </div>
</div>

@endsection
