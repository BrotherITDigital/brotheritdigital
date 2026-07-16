@extends('layouts.app')

@section('title', $portfolio->meta_title ?? ($portfolio->title . ' – Brother IT Digital PLC'))
@section('meta_description', $portfolio->meta_description ?? $portfolio->short_description)

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Portfolio Detail Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;">
            <i class="fas fa-layer-group"></i> {{ ucfirst($portfolio->category) }}
        </div>
        <h1 style="font-size: clamp(2rem, 5vw, 3rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            {{ $portfolio->title }}
        </h1>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span>
            <a href="{{ route('portfolio') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Portfolio</a>
            <span>/</span>
            <span style="color: var(--accent);">{{ $portfolio->title }}</span>
        </nav>
    </div>
</section>

{{-- Detail Section --}}
<section class="section-padding">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: 2.2fr 1fr; gap: 4rem; align-items: start;">
            
            {{-- Main Description --}}
            <article class="reveal-left" style="display: flex; flex-direction: column; gap: 2.5rem;">
                
                {{-- Banner/Thumbnail --}}
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); box-shadow: var(--shadow-sm); aspect-ratio: 16/9; background: var(--border);">
                    @if($portfolio->thumbnail)
                        <img src="{{ asset('storage/' . $portfolio->thumbnail) }}" alt="{{ $portfolio->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e3a8a, #0e7490); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-image" style="font-size: 4rem; color: rgba(255,255,255,.3);"></i>
                        </div>
                    @endif
                </div>

                {{-- Full Description --}}
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 3rem;">
                    <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.25rem;">Project Overview</h2>
                    <div style="color: var(--text-muted); line-height: 1.8; font-size: 1rem; margin-bottom: 2rem;">
                        {!! nl2br(e($portfolio->description)) !!}
                    </div>
                </div>

                {{-- Image Gallery --}}
                @if($portfolio->gallery && count($portfolio->gallery))
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 3rem;">
                    <h3 style="font-size: 1.5rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.5rem;">Project Gallery</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 1rem;">
                        @foreach($portfolio->gallery as $image)
                        <div style="border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border); aspect-ratio: 4/3;">
                            <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover;" loading="lazy">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </article>

            {{-- Info Sidebar --}}
            <aside class="reveal-right" style="display: flex; flex-direction: column; gap: 2rem;">
                
                {{-- Project Specs --}}
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2.5rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.5rem; border-bottom: 1px solid var(--border); padding-bottom: .75rem;">
                        Project Details
                    </h3>
                    
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        
                        <div>
                            <span style="font-size: .75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .05em; display: block; margin-bottom: .25rem;">Client</span>
                            <span style="font-weight: 600; color: var(--text-main); font-size: .9375rem;">{{ $portfolio->client ?? 'N/A' }}</span>
                        </div>
                        
                        <div>
                            <span style="font-size: .75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .05em; display: block; margin-bottom: .25rem;">Category</span>
                            <span style="font-weight: 600; color: var(--text-main); font-size: .9375rem;">
                                {{ $portfolio->category === 'wordpress_landing' ? 'WordPress Landing Page' : ($portfolio->category === 'custom_code_landing' ? 'Custom Code Landing Page' : ($portfolio->category === 'uiux' ? 'UI/UX Design' : ($portfolio->category === 'mobile' ? 'Mobile App' : 'Website'))) }}
                            </span>
                        </div>

                        @if($portfolio->completed_at)
                        <div>
                            <span style="font-size: .75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .05em; display: block; margin-bottom: .25rem;">Completed Date</span>
                            <span style="font-weight: 600; color: var(--text-main); font-size: .9375rem;">{{ $portfolio->completed_at->format('M d, Y') }}</span>
                        </div>
                        @endif

                        <div>
                            <span style="font-size: .75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: .05em; display: block; margin-bottom: .5rem;">Technologies Used</span>
                            <div style="display: flex; gap: .375rem; flex-wrap: wrap;">
                                @foreach($portfolio->technologies ?? [] as $tech)
                                <span class="badge badge-primary" style="font-size: .75rem; font-weight: 500;">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    {{-- Actions --}}
                    <div style="display: flex; flex-direction: column; gap: .75rem; margin-top: 2rem;">
                        @if($portfolio->pdf_file)
                        <a href="{{ asset('storage/' . $portfolio->pdf_file) }}" target="_blank" rel="noopener" class="btn" style="display: flex; justify-content: center; text-align: center; gap: .5rem; background: #EF4444; border: 1px solid #EF4444; color: #fff;" id="portfolio-pdf-btn">
                            <i class="fas fa-file-pdf"></i> View High-Res PDF Demo
                        </a>
                        @endif
                        @if($portfolio->live_url)
                        <a href="{{ $portfolio->live_url }}" target="_blank" rel="noopener" class="btn btn-primary" style="display: flex; justify-content: center; text-align: center;" id="portfolio-live-btn">
                            <i class="fas fa-external-link-alt"></i> Visit Live Website
                        </a>
                        @endif
                        @if($portfolio->github_url)
                        <a href="{{ $portfolio->github_url }}" target="_blank" rel="noopener" class="btn" style="border: 2px solid var(--border); color: var(--text-main); display: flex; justify-content: center; text-align: center; background: transparent;" id="portfolio-github-btn">
                            <i class="fab fa-github"></i> View GitHub Code
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Call to action --}}
                <div style="background: linear-gradient(135deg, var(--primary), var(--accent)); border-radius: var(--radius-lg); padding: 2.5rem; text-align: center; color: #fff;">
                    <h3 style="color: #fff; font-size: 1.25rem; font-weight: 800; margin-bottom: .75rem;">Need a similar solution?</h3>
                    <p style="color: rgba(255, 255, 255, 0.85); font-size: .875rem; line-height: 1.6; margin-bottom: 1.5rem;">
                        Let us design and deploy your custom solution with modern standards.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-outline" style="border-color: #fff; background: rgba(255,255,255,.15); display: block;" id="portfolio-quote-btn">
                        Get In Touch
                    </a>
                </div>
            </aside>
            
        </div>
    </div>
</section>

@endsection
