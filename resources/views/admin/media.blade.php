@extends('layouts.admin')

@section('title', 'Media Manager')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Media Manager</span>
@endsection

@section('content')

<div style="display:grid; grid-template-columns: 1.2fr 2.5fr; gap:2rem; align-items:start;">

    {{-- Upload Box --}}
    <div class="admin-card">
        <h3 style="font-size:1rem; font-weight:700; color:#0F172A; margin:0 0 1rem; border-bottom:1px solid #E2E8F0; padding-bottom:.5rem;">Upload Files</h3>
        
        <form action="{{ route('admin.media.upload') }}" method="POST" enctype="multipart/form-data" id="media-upload-form" style="display:flex; flex-direction:column; gap:1rem;">
            @csrf
            
            <div style="border: 2px dashed #CBD5E1; border-radius: var(--radius-md); padding: 2rem; text-align: center; cursor: pointer; transition: border .2s; position:relative;" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='#CBD5E1'">
                <input type="file" name="file" id="media-file-input" style="position:absolute; inset:0; opacity:0; cursor:pointer;" required onchange="document.getElementById('file-selected-name').textContent = this.files[0].name">
                <i class="fas fa-cloud-upload-alt" style="font-size:2.5rem; color:#64748B; margin-bottom:.5rem; display:block;"></i>
                <span style="font-size:.875rem; color:#0F172A; font-weight:600; display:block; margin-bottom:.25rem;">Drag & Drop or Click</span>
                <span style="font-size:.75rem; color:#64748B; display:block;" id="file-selected-name">Max size: 5MB (Images/PDFs)</span>
            </div>

            <button type="submit" class="btn btn-primary" style="justify-content:center;" id="media-upload-btn">
                <i class="fas fa-upload"></i> Start Upload
            </button>
        </form>
    </div>

    {{-- Files Grid --}}
    <div class="admin-card">
        <h3 style="font-size:1rem; font-weight:700; color:#0F172A; margin:0 0 1rem; border-bottom:1px solid #E2E8F0; padding-bottom:.5rem;">Uploaded Files</h3>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(130px, 1fr)); gap:1rem; max-height: 500px; overflow-y: auto; padding-right: .5rem;">
            @forelse($files as $file)
            <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:var(--radius-sm); overflow:hidden; position:relative;" class="reveal">
                
                {{-- Preview --}}
                <div style="aspect-ratio:1.2; background:#E2E8F0; display:flex; align-items:center; justify-content:center;">
                    @if(Str::endsWith($file['name'], ['.jpg', '.jpeg', '.png', '.gif', '.webp', '.svg']))
                        <img src="{{ $file['url'] }}" alt="{{ $file['name'] }}" style="width:100%; height:100%; object-fit:cover;">
                    @else
                        <i class="fas fa-file-pdf" style="font-size:2rem; color:#EF4444;"></i>
                    @endif
                </div>

                {{-- Info / Action --}}
                <div style="padding:.5rem; display:flex; flex-direction:column; gap:.25rem;">
                    <div style="font-size:.7rem; color:#0F172A; font-weight:600; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;" title="{{ $file['name'] }}">{{ $file['name'] }}</div>
                    <div style="font-size:.65rem; color:#64748B;">{{ round($file['size']/1024) }} KB</div>
                    
                    <div style="display:flex; gap:.25rem; margin-top:.25rem;">
                        {{-- Copy URL --}}
                        <button onclick="navigator.clipboard.writeText('{{ $file['url'] }}'); alert('URL copied to clipboard!')" class="btn" style="padding:.15rem; font-size:.7rem; flex:1; justify-content:center; border:1px solid #E2E8F0; background:#fff; color:#0F172A;" title="Copy file URL" id="copy-url-{{ $loop->index }}">
                            <i class="fas fa-copy"></i>
                        </button>
                        
                        {{-- Delete --}}
                        <form action="{{ route('admin.media.delete') }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file permanently?')" style="flex:1; margin:0;">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="path" value="{{ $file['path'] }}">
                            <button type="submit" class="btn btn-danger" style="width:100%; padding:.15rem; font-size:.7rem; background:#EF4444; color:#fff;" title="Delete file" id="delete-media-{{ $loop->index }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            @empty
            <div style="grid-column:1/-1; text-align:center; padding:3rem; color:#64748B;">
                <i class="fas fa-images" style="font-size:2.5rem; color:#CBD5E1; margin-bottom:.5rem; display:block;"></i>
                No files uploaded yet. Upload files to get started!
            </div>
            @endforelse
        </div>
    </div>

</div>

@endsection
