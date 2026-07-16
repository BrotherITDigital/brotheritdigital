<div style="position: relative; background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2rem;">
    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border); padding-bottom: .75rem;">
        Search Articles
    </h3>
    
    <div style="position: relative;">
        <input type="text" wire:model.live.debounce.300ms="query" class="form-control" placeholder="Search keywords..." style="padding-left: 2.75rem;" id="blog-search-input">
        <i class="fas fa-search" style="position: absolute; left: 1.1rem; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
    </div>

    {{-- Dropdown Results --}}
    @if(strlen($query) >= 2)
    <div style="position: absolute; left: 0; right: 0; top: calc(100% + .5rem); background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-md); box-shadow: var(--shadow-lg); z-index: 10; max-height: 320px; overflow-y: auto;">
        @forelse($results as $res)
        <a href="{{ route('blog.show', $res->slug) }}" style="display: block; padding: 1rem; border-bottom: 1px solid var(--border); text-decoration: none; transition: background .2s;" onmouseover="this.style.background='var(--bg-light)'" onmouseout="this.style.background='transparent'" id="search-result-{{ $res->id }}">
            <h4 style="font-size: .9375rem; font-weight: 600; color: var(--text-main); margin-bottom: .25rem; line-height: 1.35;">{{ $res->title }}</h4>
            <div style="display: flex; gap: .75rem; font-size: .75rem; color: var(--text-muted);">
                <span><i class="far fa-calendar"></i> {{ $res->published_at ? $res->published_at->format('M d, Y') : $res->created_at->format('M d, Y') }}</span>
                @if($res->category)
                <span><i class="fas fa-folder"></i> {{ $res->category->name }}</span>
                @endif
            </div>
        </a>
        @empty
        <div style="padding: 1.5rem; text-align: center; color: var(--text-muted); font-size: .875rem;">
            No articles match your query.
        </div>
        @endforelse
    </div>
    @endif

</div>
