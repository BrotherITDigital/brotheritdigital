@extends('layouts.admin')

@section('title', 'Manage Team')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Team</span>
@endsection

@section('content')

<div class="admin-card">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.5rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Team Members</h2>
        <a href="{{ route('admin.team.create') }}" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="create-team-btn">
            <i class="fas fa-plus"></i> Add Member
        </a>
    </div>

    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap:1.5rem;">
        @forelse($team as $member)
        <div style="background:#fff; border:1px solid #E2E8F0; border-radius:var(--radius-md); overflow:hidden; display:flex; flex-direction:column; text-align:center; box-shadow:var(--shadow-sm);">
            
            {{-- Photo --}}
            <div style="aspect-ratio:1; background:#E2E8F0; position:relative; overflow:hidden;">
                @if($member->photo)
                    <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <div style="width:100%; height:100%; background:linear-gradient(135deg,var(--primary),var(--accent)); display:flex; align-items:center; justify-content:center; color:#fff; font-size:3.5rem; font-weight:800; font-family:'Poppins',sans-serif;">
                        {{ strtoupper(substr($member->name, 0, 1)) }}
                    </div>
                @endif
            </div>

            <div style="padding:1.25rem; flex:1; display:flex; flex-direction:column; justify-content:space-between;">
                <div>
                    <h3 style="font-size:1rem; font-weight:700; color:#0F172A; margin:0 0 .25rem;">{{ $member->name }}</h3>
                    <div style="font-size:.8125rem; color:var(--primary); font-weight:600; margin-bottom:.75rem;">{{ $member->position }}</div>
                    
                    @if($member->skills)
                    <div style="display:flex; flex-wrap:wrap; gap:.25rem; justify-content:center; margin-bottom:1rem;">
                        @foreach(array_slice($member->skills, 0, 3) as $skill)
                        <span class="badge badge-primary" style="font-size:.65rem; padding:.15rem .5rem;">{{ $skill }}</span>
                        @endforeach
                        @if(count($member->skills) > 3)
                        <span class="badge badge-primary" style="font-size:.65rem; padding:.15rem .5rem;">+{{ count($member->skills)-3 }}</span>
                        @endif
                    </div>
                    @endif
                </div>

                {{-- CRUD Actions --}}
                <div style="display:flex; border-top:1px solid #E2E8F0; padding-top:.875rem; margin-top:.5rem; gap:.5rem;">
                    <a href="{{ route('admin.team.edit', $member->id) }}" class="btn" style="flex:1; padding:.375rem; font-size:.75rem; border:1px solid #E2E8F0; background:transparent; color:#0F172A;" id="edit-member-{{ $member->id }}">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    
                    <form action="{{ route('admin.team.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this team member?')" style="flex:1;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="width:100%; padding:.375rem; font-size:.75rem; background:#EF4444; color:#fff;" id="delete-member-{{ $member->id }}">
                            <i class="fas fa-trash-alt"></i> Remove
                        </button>
                    </form>
                </div>
            </div>

        </div>
        @empty
        <div style="grid-column:1/-1; text-align:center; padding:3rem; color:#64748B;">No team members found.</div>
        @endforelse
    </div>

    <div style="margin-top:1.5rem;">
        {{ $team->links() }}
    </div>
</div>

@endsection
