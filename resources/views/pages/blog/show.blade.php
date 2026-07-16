@extends('layouts.app')

@section('title', $post->meta_title ?? ($post->title . ' – Brother IT Digital PLC'))
@section('meta_description', $post->meta_description ?? $post->excerpt)

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Blog Detail Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        @if($post->category)
        <div class="hero-badge" style="margin: 0 auto 1rem;"><i class="fas fa-tags"></i> {{ $post->category->name }}</div>
        @endif
        <h1 style="font-size: clamp(2rem, 5vw, 3rem); font-weight: 900; color: #fff; margin-bottom: 1rem; line-height: 1.25;">
            {{ $post->title }}
        </h1>
        
        <div style="display: flex; justify-content: center; gap: 1.5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.7); margin-bottom: 2rem;">
            <span><i class="far fa-user"></i> By {{ $post->author }}</span>
            <span><i class="far fa-calendar-alt"></i> {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
            <span><i class="far fa-eye"></i> {{ $post->views }} Views</span>
        </div>

        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span>
            <a href="{{ route('blog') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Blog</a>
            <span>/</span>
            <span style="color: var(--accent);">{{ Str::limit($post->title, 30) }}</span>
        </nav>
    </div>
</section>

{{-- Detail Section --}}
<section class="section-padding">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 4rem; align-items: start;">
            
            {{-- Main Post Content --}}
            <article class="reveal-left" style="display: flex; flex-direction: column; gap: 2.5rem;">
                
                {{-- Featured Image --}}
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); aspect-ratio: 16/9; background: var(--border);">
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--accent));"></div>
                    @endif
                </div>

                {{-- Post Body --}}
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 3rem;">
                    
                    {{-- Excerpt --}}
                    @if($post->excerpt)
                    <div style="font-size: 1.1rem; color: var(--text-main); font-weight: 500; line-height: 1.7; border-left: 4px solid var(--primary); padding-left: 1.5rem; margin-bottom: 2rem; font-style: italic;">
                        {{ $post->excerpt }}
                    </div>
                    @endif

                    {{-- Main Content --}}
                    <div style="color: var(--text-muted); line-height: 1.8; font-size: 1rem;" class="blog-rich-content">
                        {!! $post->content !!}
                    </div>

                    {{-- Tags --}}
                    @if($post->tags && count($post->tags))
                    <div style="margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid var(--border); display: flex; gap: .5rem; align-items: center; flex-wrap: wrap;">
                        <span style="font-weight: 700; font-size: .875rem; color: var(--text-main); margin-right: .5rem;"><i class="fas fa-tags"></i> Tags:</span>
                        @foreach($post->tags as $tag)
                        <span class="badge badge-primary" style="font-size: .75rem;">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif

                </div>

            </article>

            {{-- Sidebar --}}
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
                        <a href="{{ route('blog.show', $rec->slug) }}" style="display: flex; gap: 1rem; text-decoration: none;" id="recent-post-link-{{ $rec->id }}">
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
