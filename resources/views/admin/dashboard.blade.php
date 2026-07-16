@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('breadcrumb')
<span style="color:#0F172A; font-weight: 600;">Dashboard</span>
@endsection

@section('content')

{{-- Stats Row --}}
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1.5rem; margin-bottom: 2.25rem;">
    
    {{-- Services count --}}
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background: rgba(37,99,235,.1); color: var(--primary);">
            <i class="fas fa-cogs"></i>
        </div>
        <div>
            <div style="font-size: .8125rem; color: #64748B; font-weight: 500;">Total Services</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #0F172A; font-family: 'Poppins', sans-serif;">{{ $servicesCount }}</div>
        </div>
    </div>

    {{-- Portfolios count --}}
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background: rgba(6,182,212,.1); color: var(--accent);">
            <i class="fas fa-folder-open"></i>
        </div>
        <div>
            <div style="font-size: .8125rem; color: #64748B; font-weight: 500;">Projects Done</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #0F172A; font-family: 'Poppins', sans-serif;">{{ $portfoliosCount }}</div>
        </div>
    </div>

    {{-- Unread messages count --}}
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background: {{ $unreadCount > 0 ? 'rgba(239,68,68,.1)' : 'rgba(16,185,129,.1)' }}; color: {{ $unreadCount > 0 ? '#EF4444' : '#10B981' }};">
            <i class="fas fa-envelope"></i>
        </div>
        <div>
            <div style="font-size: .8125rem; color: #64748B; font-weight: 500;">Unread Messages</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #0F172A; font-family: 'Poppins', sans-serif;">{{ $unreadCount }}</div>
        </div>
    </div>

    {{-- Blog count --}}
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background: rgba(245,158,11,.1); color: #F59E0B;">
            <i class="fas fa-edit"></i>
        </div>
        <div>
            <div style="font-size: .8125rem; color: #64748B; font-weight: 500;">Blog Articles</div>
            <div style="font-size: 1.75rem; font-weight: 800; color: #0F172A; font-family: 'Poppins', sans-serif;">{{ $blogCount }}</div>
        </div>
    </div>

</div>

{{-- Quick Actions Row --}}
<h3 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin-bottom: 1.25rem;">Quick Management Actions</h3>
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
    <a href="{{ route('admin.services.create') }}" style="text-decoration:none;" id="action-add-service">
        <div style="background:#fff; border:1px solid #E2E8F0; padding:1.5rem; border-radius:var(--radius-md); text-align:center; transition:transform .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
            <i class="fas fa-plus-circle" style="font-size:2rem; color:var(--primary); margin-bottom:.75rem; display:block;"></i>
            <span style="font-weight:600; color:#0F172A; font-size:.875rem;">Add New Service</span>
        </div>
    </a>
    <a href="{{ route('admin.portfolios.create') }}" style="text-decoration:none;" id="action-add-portfolio">
        <div style="background:#fff; border:1px solid #E2E8F0; padding:1.5rem; border-radius:var(--radius-md); text-align:center; transition:transform .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
            <i class="fas fa-folder-plus" style="font-size:2rem; color:var(--accent); margin-bottom:.75rem; display:block;"></i>
            <span style="font-weight:600; color:#0F172A; font-size:.875rem;">Add Portfolio Project</span>
        </div>
    </a>
    <a href="{{ route('admin.team.create') }}" style="text-decoration:none;" id="action-add-team">
        <div style="background:#fff; border:1px solid #E2E8F0; padding:1.5rem; border-radius:var(--radius-md); text-align:center; transition:transform .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
            <i class="fas fa-user-plus" style="font-size:2rem; color:#10B981; margin-bottom:.75rem; display:block;"></i>
            <span style="font-weight:600; color:#0F172A; font-size:.875rem;">Add Team Member</span>
        </div>
    </a>
    <a href="{{ route('admin.blog.create') }}" style="text-decoration:none;" id="action-add-blog">
        <div style="background:#fff; border:1px solid #E2E8F0; padding:1.5rem; border-radius:var(--radius-md); text-align:center; transition:transform .2s;" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='none'">
            <i class="fas fa-pen-nib" style="font-size:2rem; color:#F59E0B; margin-bottom:.75rem; display:block;"></i>
            <span style="font-weight:600; color:#0F172A; font-size:.875rem;">Write Blog Article</span>
        </div>
    </a>
</div>

{{-- Content Rows --}}
<div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 2rem; align-items: start;">
    
    {{-- Recent Messages Table --}}
    <div class="admin-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem; border-bottom:1px solid #E2E8F0; padding-bottom:.75rem;">
            <h3 style="font-size: 1rem; font-weight: 700; color: #0F172A; margin: 0;"><i class="fas fa-envelope"></i> Recent Contact Inquiries</h3>
            <a href="{{ route('admin.contacts.index') }}" style="font-size:.8125rem; color:var(--primary); font-weight:600; text-decoration:none;" id="view-all-messages">View All</a>
        </div>

        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:.875rem; text-align:left;">
                <thead>
                    <tr style="border-bottom:2px solid #E2E8F0; color:#64748B;">
                        <th style="padding:.75rem;">Name</th>
                        <th style="padding:.75rem;">Subject</th>
                        <th style="padding:.75rem;">Date</th>
                        <th style="padding:.75rem;">Status</th>
                        <th style="padding:.75rem; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $msg)
                    <tr style="border-bottom:1px solid #E2E8F0; transition:background .15s;" onmouseover="this.style.background='#F8FAFC'" onmouseout="this.style.background='transparent'">
                        <td style="padding:.75rem; font-weight:500; color:#0F172A;">{{ $msg->name }}</td>
                        <td style="padding:.75rem; color:#64748B;">{{ Str::limit($msg->subject, 30) }}</td>
                        <td style="padding:.75rem; color:#64748B;">{{ $msg->created_at->format('M d, g:i a') }}</td>
                        <td style="padding:.75rem;">
                            <span class="badge {{ $msg->is_read ? 'badge-success' : 'badge-danger' }}" style="font-size:.7rem;">
                                {{ $msg->is_read ? 'Read' : 'Unread' }}
                            </span>
                        </td>
                        <td style="padding:.75rem; text-align:right;">
                            <a href="{{ route('admin.contacts.show', $msg->id) }}" class="btn btn-primary" style="padding:.25rem .625rem; font-size:.75rem;" id="view-msg-{{ $msg->id }}">
                                <i class="fas fa-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="padding:1.5rem; text-align:center; color:#64748B;">No contact messages yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Projects Done --}}
    <div class="admin-card">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem; border-bottom:1px solid #E2E8F0; padding-bottom:.75rem;">
            <h3 style="font-size: 1rem; font-weight: 700; color: #0F172A; margin: 0;"><i class="fas fa-folder-open"></i> Recent Projects</h3>
            <a href="{{ route('admin.portfolios.index') }}" style="font-size:.8125rem; color:var(--primary); font-weight:600; text-decoration:none;" id="view-all-projects">View All</a>
        </div>

        <div style="display:flex; flex-direction:column; gap:1rem;">
            @forelse($recentPortfolios as $proj)
            <div style="display:flex; gap:.75rem; align-items:center;">
                <div style="width:3rem; height:3rem; border-radius:.375rem; overflow:hidden; background:#E2E8F0; flex-shrink:0;">
                    @if($proj->thumbnail)
                        <img src="{{ asset('storage/' . $proj->thumbnail) }}" alt="{{ $proj->title }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <div style="width:100%; height:100%; background:linear-gradient(135deg,var(--primary),var(--accent));"></div>
                    @endif
                </div>
                <div style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap; flex:1;">
                    <h4 style="font-size:.875rem; font-weight:600; color:#0F172A; margin:0 0 .125rem;">{{ $proj->title }}</h4>
                    <span style="font-size:.75rem; color:#64748B;">Category: {{ ucfirst($proj->category) }}</span>
                </div>
                <a href="{{ route('admin.portfolios.edit', $proj->id) }}" style="color:var(--primary); font-size:.875rem;" aria-label="Edit project" id="edit-proj-{{ $proj->id }}"><i class="fas fa-edit"></i></a>
            </div>
            @empty
            <div style="color:#64748B; font-size:.875rem; text-align:center; padding:1rem 0;">No projects added yet.</div>
            @endforelse
        </div>
    </div>

</div>

@endsection
