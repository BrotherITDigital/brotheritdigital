@extends('layouts.app')
@section('title','Services – Brother IT Digital PLC')
@section('meta_description','Explore all our services: website development, mobile apps, UI/UX design, and digital services tailored for your business.')
@section('content')

{{-- Hero --}}
<section style="padding:9rem 0 5rem;background:linear-gradient(135deg,#0F172A,#1e3a8a);position:relative;overflow:hidden;" aria-label="Services Hero">
    <div class="container-custom" style="position:relative;z-index:1;text-align:center;">
        <div class="hero-badge" style="margin:0 auto 1rem;"><i class="fas fa-cogs"></i> What We Offer</div>
        <h1 style="font-size:clamp(2.25rem,5vw,3.75rem);font-weight:900;color:#fff;margin-bottom:1rem;">Our <span class="gradient-text">Services</span></h1>
        <p style="color:rgba(255,255,255,.7);max-width:580px;margin:0 auto 1.5rem;line-height:1.75;">End-to-end digital solutions from web and mobile development to UI/UX design and ongoing digital support.</p>
        <nav aria-label="Breadcrumb" style="display:flex;justify-content:center;gap:.5rem;font-size:.875rem;color:rgba(255,255,255,.5);">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);text-decoration:none;">Home</a>
            <span>/</span><span style="color:var(--accent);">Services</span>
        </nav>
    </div>
</section>

{{-- Category Tabs --}}
<section class="section-padding" aria-label="Services listing">
<div class="container-custom" x-data="{ tab: 'all' }">

    {{-- Tab Buttons --}}
    <div style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center;margin-bottom:3rem;">
        @php $tabs = ['all'=>'All Services','website'=>'Website Development','mobile'=>'Mobile Apps','uiux'=>'UI/UX Design','digital'=>'Digital Services']; @endphp
        @foreach($tabs as $key=>$label)
        <button @click="tab='{{ $key }}'" :class="tab==='{{ $key }}' ? 'active' : ''" class="portfolio-filter-btn" id="tab-{{ $key }}-btn">
            {{ $label }}
        </button>
        @endforeach
    </div>

    {{-- Services Grid --}}
    @php $categories = ['website'=>'Website Development','mobile'=>'Mobile App Development','uiux'=>'UI/UX Design','digital'=>'Digital Services']; @endphp
    @foreach($categories as $catKey => $catLabel)
    <div x-show="tab==='all' || tab==='{{ $catKey }}'" style="margin-bottom:3rem;">
        <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1.75rem;">
            <h2 style="font-size:1.375rem;font-weight:800;color:var(--text-main);">{{ $catLabel }}</h2>
            <div style="flex:1;height:1px;background:var(--border);"></div>
            <span class="badge badge-primary">{{ $grouped->get($catKey, collect())->count() }} services</span>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.25rem;">
            @forelse($grouped->get($catKey, collect()) as $service)
            <a href="{{ route('services.show', $service->slug) }}" style="text-decoration:none;" class="reveal" id="service-card-{{ $service->id }}">
                <div class="service-card" style="height:100%;">
                    <div class="card-icon"><i class="{{ $service->icon }}"></i></div>
                    <h3 style="font-size:1rem;font-weight:700;margin-bottom:.625rem;color:var(--text-main);">{{ $service->title }}</h3>
                    <p style="color:var(--text-muted);font-size:.875rem;line-height:1.7;margin-bottom:1rem;">{{ $service->short_description }}</p>
                    <span style="color:var(--primary);font-size:.875rem;font-weight:600;display:flex;align-items:center;gap:.375rem;">Learn More <i class="fas fa-arrow-right" style="font-size:.75rem;"></i></span>
                </div>
            </a>
            @empty
            <p style="color:var(--text-muted);">No services in this category yet.</p>
            @endforelse
        </div>
    </div>
    @endforeach
</div>
</section>

{{-- CTA --}}
<section style="padding:4rem 0;background:linear-gradient(135deg,var(--secondary),#1e3a8a);" aria-label="Service CTA">
    <div class="container-custom" style="text-align:center;">
        <h2 style="color:#fff;font-size:1.75rem;font-weight:800;margin-bottom:1rem;">Don't see what you need?</h2>
        <p style="color:rgba(255,255,255,.7);margin-bottom:2rem;">We build custom solutions. Tell us your idea and we'll make it happen.</p>
        <a href="{{ route('contact') }}" class="btn btn-primary" id="service-contact-btn"><i class="fas fa-comments"></i> Discuss Your Project</a>
    </div>
</section>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
