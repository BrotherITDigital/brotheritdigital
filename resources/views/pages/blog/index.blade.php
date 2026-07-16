@extends('layouts.app')

@section('title', 'Our Blog – Brother IT Digital PLC')
@section('meta_description', 'Read updates, tutorials, UI/UX tips, and technical news from the Brother IT Digital team.')

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Blog Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;"><i class="fas fa-edit"></i> Blog</div>
        <h1 style="font-size: clamp(2.25rem, 5vw, 3.75rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            Tech <span class="gradient-text">Insights</span>
        </h1>
        <p style="color: rgba(255, 255, 255, 0.7); max-width: 580px; margin: 0 auto 1.5rem; line-height: 1.75;">
            Guides, development updates, and tips on building premium websites and mobile apps.
        </p>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span><span style="color: var(--accent);">Blog</span>
        </nav>
    </div>
</section>

{{-- Main Content Section --}}
<section class="section-padding">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 4rem; align-items: start;">
            
            {{-- Left column - Posts List --}}
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                    @forelse($posts as $post)
                    <article class="service-card reveal" style="padding: 0; display: flex; flex-direction: column; height: 100%;">
                        {{-- Image --}}
                        <div style="aspect-ratio: 16/10; overflow: hidden; background: var(--border);">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--accent)); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-edit" style="font-size: 2.5rem; color: rgba(255,255,255,.35);"></i>
                                </div>
                            @endif
                        </div>
                        {{-- Content --}}
                        <div style="padding: 1.5rem; flex: 1; display: flex; flex-direction: column;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: .75rem; font-size: .75rem; color: var(--text-muted);">
                                <span><i class="far fa-calendar-alt"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                                <span><i class="far fa-clock"></i> {{ $post->reading_time }} min read</span>
                            </div>
                            <h2 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin-bottom: .75rem; line-height: 1.35;">
                                <a href="{{ route('blog.show', $post->slug) }}" style="color: inherit; text-decoration: none;" id="blog-link-{{ $post->id }}">{{ $post->title }}</a>
                            </h2>
                            <p style="color: var(--text-muted); font-size: .875rem; line-height: 1.6; margin-bottom: 1.25rem; flex: 1;">
                                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}" style="color: var(--primary); font-weight: 600; font-size: .875rem; text-decoration: none; display: inline-flex; align-items: center; gap: .375rem;" id="blog-readmore-{{ $post->id }}">
                                Read Article <i class="fas fa-arrow-right" style="font-size: .75rem;"></i>
                            </a>
                        </div>
                    </article>
                    @empty
                    <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted); padding: 4rem;">
                        <i class="fas fa-newspaper" style="font-size: 3rem; color: var(--border); margin-bottom: 1rem; display: block;"></i>
                        <p>No blog posts found. Keep check back!</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                <div style="margin-top: 2rem;">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- Right column - Sidebar --}}
            <aside style="display: flex; flex-direction: column; gap: 2.5rem;" class="reveal-right">
                
                {{-- Live Search --}}
                @livewire('blog-search')

                {{-- Categories --}}
                @if($categories->count())
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border); padding-bottom: .75rem;">Categories</h3>
                    <div style="display: flex; flex-direction: column; gap: .75rem;">
                        @foreach($categories as $category)
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: .9375rem;">
                            <span style="color: var(--text-muted);">{{ $category->name }}</span>
                            <span class="badge badge-primary" style="font-size: .75rem;">{{ $category->posts_count }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Recent Posts --}}
                @if($recent->count())
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border); padding-bottom: .75rem;">Recent Posts</h3>
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        @foreach($recent as $rec)
                        <a href="{{ route('blog.show', $rec->slug) }}" style="display: flex; gap: 1rem; text-decoration: none;" id="recent-blog-{{ $rec->id }}">
                            <div style="width: 3.5rem; height: 3.5rem; border-radius: .375rem; overflow: hidden; background: var(--border); flex-shrink: 0;">
                                @if($rec->featured_image)
                                    <img src="{{ asset('storage/' . $rec->featured_image) }}" alt="{{ $rec->title }}" style="width:100%; height:100%; object-fit:cover;">
                                @else
                                    <div style="width:100%; height:100%; background:linear-gradient(135deg,var(--primary),var(--accent));"></div>
                                @endif
                            </div>
                            <div>
                                <h4 style="font-size: .875rem; font-weight: 600; color: var(--text-main); line-height: 1.35; margin-bottom: .25rem;">{{ Str::limit($rec->title, 45) }}</h4>
                                <span style="font-size: .75rem; color: var(--text-muted);">{{ $rec->published_at ? $rec->published_at->format('M d, Y') : $rec->created_at->format('M d, Y') }}</span>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </aside>

        </div>
    </div>
</section>

@endsection
