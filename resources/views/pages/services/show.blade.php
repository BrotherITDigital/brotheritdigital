@extends('layouts.app')

@section('title', $service->meta_title ?? ($service->title . ' – Brother IT Digital PLC'))
@section('meta_description', $service->meta_description ?? $service->short_description)

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Service Detail Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;">
            <i class="{{ $service->icon }}"></i> {{ ucfirst($service->category) }}
        </div>
        <h1 style="font-size: clamp(2.25rem, 5vw, 3.5rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            {{ $service->title }}
        </h1>
        <p style="color: rgba(255, 255, 255, 0.7); max-width: 600px; margin: 0 auto 2rem; line-height: 1.75;">
            {{ $service->short_description }}
        </p>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span>
            <a href="{{ route('services') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Services</a>
            <span>/</span>
            <span style="color: var(--accent);">{{ $service->title }}</span>
        </nav>
    </div>
</section>

{{-- Detail Section --}}
<section class="section-padding">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 4rem; align-items: start;">
            
            {{-- Main Description --}}
            <article class="reveal-left">
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 3rem;">
                    <div style="width: 4.5rem; height: 4.5rem; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(6, 182, 212, 0.15)); display: flex; align-items: center; justify-content: center; font-size: 2rem; color: var(--primary); margin-bottom: 2rem;">
                        <i class="{{ $service->icon }}"></i>
                    </div>
                    
                    <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.5rem;">Service Overview</h2>
                    
                    <div style="color: var(--text-muted); line-height: 1.8; font-size: 1rem; margin-bottom: 2.5rem;">
                        {!! nl2br(e($service->description)) !!}
                    </div>

                    <h3 style="font-size: 1.375rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.25rem;">Why Work With Us For This Service?</h3>
                    <ul style="list-style: none; padding: 0; margin: 0 0 2rem; display: flex; flex-direction: column; gap: 1rem;">
                        <li style="display: flex; align-items: flex-start; gap: .75rem; color: var(--text-muted); line-height: 1.6;">
                            <i class="fas fa-check-circle" style="color: var(--accent); margin-top: .25rem;"></i>
                            <span><strong>Expert Team:</strong> Five university-level software developers and designers working on your project.</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: .75rem; color: var(--text-muted); line-height: 1.6;">
                            <i class="fas fa-check-circle" style="color: var(--accent); margin-top: .25rem;"></i>
                            <span><strong>Modern Stack:</strong> Clean, scalable, and secure architecture matching modern guidelines.</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: .75rem; color: var(--text-muted); line-height: 1.6;">
                            <i class="fas fa-check-circle" style="color: var(--accent); margin-top: .25rem;"></i>
                            <span><strong>SEO Friendly:</strong> Clean markup, mobile responsiveness, and high speed optimization.</span>
                        </li>
                        <li style="display: flex; align-items: flex-start; gap: .75rem; color: var(--text-muted); line-height: 1.6;">
                            <i class="fas fa-check-circle" style="color: var(--accent); margin-top: .25rem;"></i>
                            <span><strong>24/7 Dedicated Support:</strong> Available for any bug fixes, security monitoring, and updates.</span>
                        </li>
                    </ul>
                </div>
            </article>

            {{-- Sidebar --}}
            <aside class="reveal-right" style="display: flex; flex-direction: column; gap: 2rem;">
                
                {{-- CTA Box --}}
                <div style="background: linear-gradient(135deg, var(--secondary), #1e3a8a); border-radius: var(--radius-lg); padding: 2.5rem; text-align: center; color: #fff; box-shadow: var(--shadow-lg);">
                    <h3 style="color: #fff; font-size: 1.375rem; font-weight: 800; margin-bottom: 1rem;">Ready to Get Started?</h3>
                    <p style="color: rgba(255, 255, 255, 0.7); font-size: .9375rem; line-height: 1.6; margin-bottom: 2rem;">
                        Let us build your next digital solution. Send us your requirements for a free estimation.
                    </p>
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="display: block; text-align: center; background: var(--accent); box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);" id="service-quote-btn">
                        Get a Free Quote
                    </a>
                </div>

                {{-- Related Services --}}
                @if($related->count())
                <div style="background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius-lg); padding: 2rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border); padding-bottom: .75rem;">
                        Related Services
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @foreach($related as $rel)
                        <a href="{{ route('services.show', $rel->slug) }}" style="display: flex; align-items: center; gap: 1rem; text-decoration: none;" id="related-service-{{ $rel->id }}">
                            <div style="width: 2.5rem; height: 2.5rem; border-radius: .5rem; background: rgba(37, 99, 235, 0.1); color: var(--primary); display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0;">
                                <i class="{{ $rel->icon }}"></i>
                            </div>
                            <div>
                                <h4 style="font-size: .9375rem; font-weight: 600; color: var(--text-main); margin-bottom: .125rem;">{{ $rel->title }}</h4>
                                <span style="font-size: .75rem; color: var(--text-muted);">View details <i class="fas fa-chevron-right" style="font-size: .6rem;"></i></span>
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
