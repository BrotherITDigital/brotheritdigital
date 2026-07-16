@extends('layouts.app')

@section('title', 'Our Portfolio – Brother IT Digital PLC')
@section('meta_description', 'Browse our software projects, corporate websites, custom web applications, and mobile apps built with Laravel, Flutter, and Vue.js.')

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Portfolio Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;"><i class="fas fa-folder-open"></i> Portfolio</div>
        <h1 style="font-size: clamp(2.25rem, 5vw, 3.75rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            Our <span class="gradient-text">Projects</span>
        </h1>
        <p style="color: rgba(255, 255, 255, 0.7); max-width: 580px; margin: 0 auto 1.5rem; line-height: 1.75;">
            Discover how we build scalable digital solutions for businesses, startups, and institutions worldwide.
        </p>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span><span style="color: var(--accent);">Portfolio</span>
        </nav>
    </div>
</section>

{{-- Portfolio Grid Section --}}
<section class="section-padding" aria-label="Portfolio Items">
    <div class="container-custom">
        
        {{-- Filter Buttons --}}
        <div style="display: flex; flex-wrap: wrap; gap: .75rem; justify-content: center; margin-bottom: 3.5rem;" id="portfolio-filters">
            <button class="portfolio-filter-btn active" data-filter="all" id="filter-all-btn">All Projects</button>
            <button class="portfolio-filter-btn" data-filter="website" id="filter-website-btn">Website</button>
            <button class="portfolio-filter-btn" data-filter="mobile" id="filter-mobile-btn">Mobile App</button>
            <button class="portfolio-filter-btn" data-filter="uiux" id="filter-uiux-btn">UI/UX Design</button>
            <button class="portfolio-filter-btn" data-filter="wordpress_landing" id="filter-wordpress-btn">WordPress Landing Page</button>
            <button class="portfolio-filter-btn" data-filter="custom_code_landing" id="filter-custom-btn">Custom Code Landing Page</button>
        </div>

        {{-- Grid --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1.5rem;" id="portfolio-grid">
            @forelse($portfolios as $project)
            <article class="portfolio-card reveal" data-category="{{ $project->category }}" style="aspect-ratio: 16/11;">
                @if($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" loading="lazy">
                @else
                    <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #1e3a8a, #0e7490); display: flex; align-items: center; justify-content: center;">
                        <i class="{{ $project->category === 'mobile' ? 'fas fa-mobile-alt' : ($project->category === 'uiux' ? 'fas fa-paint-brush' : ($project->category === 'wordpress_landing' ? 'fab fa-wordpress' : ($project->category === 'custom_code_landing' ? 'fas fa-code' : 'fas fa-globe'))) }}" style="font-size: 3rem; color: rgba(255, 255, 255, 0.3);"></i>
                    </div>
                @endif
                <div class="portfolio-overlay">
                    <div style="margin-bottom: .5rem;">
                        <span class="badge badge-primary" style="font-size: .7rem;">
                            {{ $project->category === 'wordpress_landing' ? 'WordPress Landing Page' : ($project->category === 'custom_code_landing' ? 'Custom Code Landing Page' : ($project->category === 'uiux' ? 'UI/UX Design' : ($project->category === 'mobile' ? 'Mobile App' : 'Website'))) }}
                        </span>
                    </div>
                    <h3 style="color: #fff; font-size: 1.125rem; font-weight: 700; margin-bottom: .5rem;">{{ $project->title }}</h3>
                    <p style="color: rgba(255, 255, 255, 0.75); font-size: .8125rem; margin-bottom: .875rem; line-height: 1.5;">{{ $project->short_description }}</p>
                    <div style="display: flex; gap: .5rem; flex-wrap: wrap; margin-bottom: .875rem;">
                        @foreach(array_slice($project->technologies ?? [], 0, 3) as $tech)
                        <span style="background: rgba(255, 255, 255, 0.15); color: #fff; padding: .15rem .6rem; border-radius: 9999px; font-size: .7rem;">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <div style="display: flex; gap: .75rem;">
                        <a href="{{ route('portfolio.show', $project->slug) }}" style="color: #fff; font-size: .875rem; text-decoration: none; display: flex; align-items: center; gap: .375rem; font-weight: 600;" id="portfolio-show-{{ $project->id }}">
                            <i class="fas fa-eye"></i> Details
                        </a>
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener" style="color: rgba(255, 255, 255, 0.75); font-size: .875rem; text-decoration: none; display: flex; align-items: center; gap: .375rem;">
                            <i class="fas fa-external-link-alt"></i> Live Demo
                        </a>
                        @endif
                    </div>
                </div>
            </article>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 4rem; color: var(--text-muted);">
                <i class="fas fa-folder-open" style="font-size: 3rem; color: var(--border); margin-bottom: 1rem; display: block;"></i>
                <p>No portfolio items found. Keep check back!</p>
            </div>
            @endforelse
        </div>

    </div>
</section>

{{-- Contact CTA --}}
<section style="padding: 5rem 0; background: linear-gradient(135deg, var(--secondary), #1e3a8a); color: #fff; text-align: center;" aria-label="Portfolio CTA">
    <div class="container-custom">
        <h2 style="color: #fff; font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Interested in building something similar?</h2>
        <p style="color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto 2.5rem; line-height: 1.6;">Let's team up to build a high-performance, responsive solution for your business.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary" style="background: var(--accent); box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);" id="portfolio-contact-btn">
            Start Your Project
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('.portfolio-filter-btn');
    const portfolioItems = document.querySelectorAll('#portfolio-grid article');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            const filter = btn.dataset.filter;
            
            portfolioItems.forEach(item => {
                const show = filter === 'all' || item.dataset.category === filter;
                item.style.display = show ? '' : 'none';
                if (show) {
                    setTimeout(() => item.classList.add('visible'), 50);
                }
            });
        });
    });
});
</script>
@endpush
