@extends('layouts.app')

@section('title', 'Frequently Asked Questions – Brother IT Digital PLC')
@section('meta_description', 'Find answers to common questions about Brother IT Digital PLC, our development timelines, pricing models, and tech stack.')

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="FAQ Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;"><i class="fas fa-question-circle"></i> FAQ</div>
        <h1 style="font-size: clamp(2.25rem, 5vw, 3.75rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            Help <span class="gradient-text">Center</span>
        </h1>
        <p style="color: rgba(255, 255, 255, 0.7); max-width: 580px; margin: 0 auto 1.5rem; line-height: 1.75;">
            Frequently asked questions about our software development lifecycle, web applications, and mobile apps.
        </p>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span><span style="color: var(--accent);">FAQ</span>
        </nav>
    </div>
</section>

{{-- FAQ List Section --}}
<section class="section-padding">
    <div class="container-custom" x-data="{ tab: 'all' }">
        
        {{-- Category Tabs --}}
        <div style="display: flex; flex-wrap: wrap; gap: .75rem; justify-content: center; margin-bottom: 3.5rem;">
            <button @click="tab='all'" :class="tab==='all' ? 'active' : ''" class="portfolio-filter-btn" id="faq-all-btn">All FAQs</button>
            @foreach($grouped as $catKey => $items)
            <button @click="tab='{{ $catKey }}'" :class="tab==='{{ $catKey }}' ? 'active' : ''" class="portfolio-filter-btn" id="faq-cat-{{ $catKey }}-btn">
                {{ ucfirst($catKey) }}
            </button>
            @endforeach
        </div>

        {{-- FAQs Group Accordion --}}
        <div style="max-width: 800px; margin: 0 auto; display: flex; flex-direction: column; gap: 2rem;">
            @foreach($grouped as $catKey => $items)
            <div x-show="tab==='all' || tab==='{{ $catKey }}'" class="reveal">
                <h2 style="font-size: 1.25rem; font-weight: 800; color: var(--text-main); margin-bottom: 1.25rem; border-bottom: 1px solid var(--border); padding-bottom: .5rem; display: flex; justify-content: space-between;">
                    <span>{{ ucfirst($catKey) }}</span>
                    <span style="font-size: .8rem; font-weight: 500; color: var(--primary);">{{ $items->count() }} items</span>
                </h2>
                <div style="display: flex; flex-direction: column; gap: .75rem;">
                    @foreach($items as $faq)
                    <div class="faq-item">
                        <div class="faq-question" id="faq-q-{{ $faq->id }}">
                            <span>{{ $faq->question }}</span>
                            <div class="faq-icon"><i class="fas fa-plus"></i></div>
                        </div>
                        <div class="faq-answer" id="faq-a-{{ $faq->id }}">{{ $faq->answer }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- Contact CTA --}}
<section style="padding: 5rem 0; background: linear-gradient(135deg, var(--secondary), #1e3a8a); color: #fff; text-align: center;" aria-label="FAQ Contact CTA">
    <div class="container-custom">
        <h2 style="color: #fff; font-size: 2rem; font-weight: 800; margin-bottom: 1rem;">Still have questions?</h2>
        <p style="color: rgba(255,255,255,0.7); max-width: 600px; margin: 0 auto 2.5rem; line-height: 1.6;">Contact our customer support team directly. We are always happy to help.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary" style="background: var(--accent); box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);" id="faq-contact-btn">
            Send Us a Message
        </a>
    </div>
</section>

@endsection
