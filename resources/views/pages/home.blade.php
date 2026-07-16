@extends('layouts.app')

@section('title', 'Brother IT Digital PLC – Building Digital Solutions for the Future')
@section('meta_description', 'Brother IT Digital PLC is a professional software development company specializing in modern websites, web applications, and mobile app development in Bangladesh.')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section class="hero-section hero-bg" id="hero" aria-label="Hero">
    <canvas id="particles-canvas" style="position:absolute;inset:0;width:100%;height:100%;pointer-events:none;"></canvas>

    {{-- Decorative rings --}}
    <div style="position:absolute;top:10%;right:8%;width:400px;height:400px;border-radius:50%;border:1px solid rgba(37,99,235,.15);pointer-events:none;animation:spin-slow 20s linear infinite;"></div>
    <div style="position:absolute;top:15%;right:13%;width:250px;height:250px;border-radius:50%;border:1px solid rgba(6,182,212,.15);pointer-events:none;animation:spin-slow 15s linear infinite reverse;"></div>

    <div class="container-custom" style="position:relative;z-index:1;padding-top:9rem;padding-bottom:7rem;">
        <div style="max-width:720px;">

            {{-- Badge --}}
            <div class="hero-badge">
                <span style="width:.5rem;height:.5rem;border-radius:50%;background:var(--accent);animation:pulse-glow 2s infinite;display:inline-block;"></span>
                {{ $settings['hero_badge_text'] ?? 'Available for New Projects' }}
            </div>

            {{-- Title --}}
            <h1 class="hero-title">
                {!! $settings['hero_title'] ?? 'Building <span class="gradient-text">Digital Solutions</span><br>for the Future.' !!}
            </h1>

            {{-- Description --}}
            <p class="hero-desc">
                {{ $settings['hero_subtitle'] ?? 'We craft modern websites, powerful web applications, and stunning mobile apps that help businesses grow digitally. Secure. Scalable. Beautiful.' }}
            </p>

            {{-- CTA Buttons --}}
            <div class="hero-cta">
                <a href="{{ route('contact') }}" class="btn btn-primary animate-pulse-glow" id="hero-cta-primary">
                    <i class="fas fa-rocket"></i> Get Started Today
                </a>
                <a href="{{ route('portfolio') }}" class="btn btn-outline" id="hero-cta-secondary">
                    <i class="fas fa-eye"></i> View Our Work
                </a>
            </div>

            {{-- Tech Stack Badges --}}
            <div style="display:flex;flex-wrap:wrap;gap:.625rem;margin-top:3rem;animation:fadeInUp .8s ease .8s both;">
                @foreach(['Laravel', 'Flutter', 'Vue.js', 'React Native', 'MySQL', 'Tailwind CSS'] as $tech)
                <span style="background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.7);padding:.3rem .875rem;border-radius:9999px;font-size:.8125rem;font-weight:500;">{{ $tech }}</span>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div style="position:absolute;bottom:2rem;left:50%;transform:translateX(-50%);display:flex;flex-direction:column;align-items:center;gap:.5rem;animation:fadeInUp 1s ease 1.2s both;">
        <span style="font-size:.75rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.1em;">Scroll</span>
        <div style="width:1.5rem;height:2.5rem;border:1.5px solid rgba(255,255,255,.2);border-radius:9999px;display:flex;justify-content:center;padding-top:.375rem;">
            <div style="width:.375rem;height:.375rem;border-radius:50%;background:var(--accent);animation:float 2s ease-in-out infinite;"></div>
        </div>
    </div>
</section>

{{-- ===== STATS SECTION ===== --}}
<section style="background:var(--bg-card);border-bottom:1px solid var(--border);" aria-label="Statistics">
    <div class="container-custom">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:0;">
            @php
            if (!function_exists('parseStatValue')) {
                function parseStatValue($value, $defaultNum, $defaultSuffix) {
                    if (!$value) return ['number' => $defaultNum, 'suffix' => $defaultSuffix];
                    preg_match('/^([0-9]+)(.*)$/', trim($value), $matches);
                    return [
                        'number' => isset($matches[1]) && $matches[1] !== '' ? $matches[1] : $defaultNum,
                        'suffix' => isset($matches[2]) ? $matches[2] : $defaultSuffix
                    ];
                }
            }

            $projectsStat = parseStatValue($settings['stats_projects'] ?? '50+', '50', '+');
            $clientsStat  = parseStatValue($settings['stats_clients'] ?? '30+', '30', '+');
            $teamStat     = parseStatValue($settings['stats_team'] ?? '5', '5', '');
            $yearsStat    = parseStatValue($settings['stats_years'] ?? '3+', '3', '+');

            $stats = [
                ['icon'=>'fas fa-project-diagram', 'number'=>$projectsStat['number'], 'suffix'=>$projectsStat['suffix'], 'label'=>'Projects Completed'],
                ['icon'=>'fas fa-users',           'number'=>$clientsStat['number'],  'suffix'=>$clientsStat['suffix'],  'label'=>'Happy Clients'],
                ['icon'=>'fas fa-user-tie',        'number'=>$teamStat['number'],     'suffix'=>$teamStat['suffix'],     'label'=>'Expert Team Members'],
                ['icon'=>'fas fa-calendar-alt',    'number'=>$yearsStat['number'],    'suffix'=>$yearsStat['suffix'],    'label'=>'Years Experience'],
            ];
            @endphp
            @foreach($stats as $i => $stat)
            <div class="stat-card reveal" style="border-right:{{ $i < 3 ? '1px solid var(--border)' : 'none' }};{{ $i > 0 ? 'border-left:none' : '' }}">
                <div style="width:3rem;height:3rem;border-radius:var(--radius-md);background:linear-gradient(135deg,rgba(37,99,235,.15),rgba(6,182,212,.15));display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.25rem;color:var(--primary);">
                    <i class="{{ $stat['icon'] }}"></i>
                </div>
                <div class="stat-number">
                    <span class="counter-value" data-target="{{ $stat['number'] }}" data-suffix="{{ $stat['suffix'] }}">0</span>
                </div>
                <p style="color:var(--text-muted);font-size:.9375rem;margin:0;">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== CLIENTS SECTION ===== --}}
@if($clients->count())
@php
    // Duplicate clients list to make sure rows are long enough for the infinite marquee
    $repeated = $clients;
    while ($repeated->count() < 18) {
        $repeated = $repeated->concat($clients);
    }
    // Split into 3 rows
    $chunks = $repeated->chunk(ceil($repeated->count() / 3));
@endphp
<section style="padding: 5rem 0; background: var(--bg-light); border-bottom: 1px solid var(--border); overflow: hidden;" aria-label="Clients">
    <div class="container-custom">
        
        {{-- Header & Subtitle --}}
        <div style="text-align: center; margin-bottom: 3.5rem;">
            <h2 style="font-size: clamp(2rem, 4vw, 2.75rem); font-weight: 900; color: var(--text-main); margin-bottom: 1rem; font-family: 'Poppins', sans-serif;">Our Clients</h2>
            <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 650px; margin: 0 auto; line-height: 1.75;">
                Forward-thinking brands trust Brother IT Digital to drive scalable growth and engagement. We partner with companies ready to embrace the future of digital solutions.
            </p>
        </div>

        {{-- Row 1: Scroll Left --}}
        @if(isset($chunks[0]))
        <div class="client-marquee-wrapper scroll-left">
            <div class="client-marquee-track">
                @foreach($chunks[0] as $client)
                <a href="{{ $client->website_url ?? '#' }}" target="{{ $client->website_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="client-logo-pill" style="text-decoration: none;">
                    <div class="client-logo-icon">
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}">
                        @else
                            <i class="fas fa-briefcase" style="color: var(--primary); font-size: 1rem;"></i>
                        @endif
                    </div>
                    <span class="client-logo-name">{{ $client->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Row 2: Scroll Right --}}
        @if(isset($chunks[1]))
        <div class="client-marquee-wrapper scroll-right" style="margin-top: 1.25rem;">
            <div class="client-marquee-track">
                @foreach($chunks[1] as $client)
                <a href="{{ $client->website_url ?? '#' }}" target="{{ $client->website_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="client-logo-pill" style="text-decoration: none;">
                    <div class="client-logo-icon">
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}">
                        @else
                            <i class="fas fa-building" style="color: var(--accent); font-size: 1rem;"></i>
                        @endif
                    </div>
                    <span class="client-logo-name">{{ $client->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Row 3: Scroll Left --}}
        @if(isset($chunks[2]))
        <div class="client-marquee-wrapper scroll-left" style="margin-top: 1.25rem;">
            <div class="client-marquee-track">
                @foreach($chunks[2] as $client)
                <a href="{{ $client->website_url ?? '#' }}" target="{{ $client->website_url ? '_blank' : '_self' }}" rel="noopener noreferrer" class="client-logo-pill" style="text-decoration: none;">
                    <div class="client-logo-icon">
                        @if($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="{{ $client->name }}">
                        @else
                            <i class="fas fa-globe" style="color: #F59E0B; font-size: 1rem;"></i>
                        @endif
                    </div>
                    <span class="client-logo-name">{{ $client->name }}</span>
                </a>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

<style>
@keyframes marquee-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-33.33%); }
}
@keyframes marquee-right {
    0% { transform: translateX(-33.33%); }
    100% { transform: translateX(0); }
}
.client-marquee-wrapper {
    overflow: hidden;
    user-select: none;
    display: flex;
    mask-image: linear-gradient(to right, transparent, #000 15%, #000 85%, transparent);
    -webkit-mask-image: linear-gradient(to right, transparent, #000 15%, #000 85%, transparent);
}
.client-marquee-track {
    display: flex;
    gap: 1.25rem;
    width: max-content;
}
.client-marquee-wrapper.scroll-left .client-marquee-track {
    animation: marquee-left 35s linear infinite;
}
.client-marquee-wrapper.scroll-right .client-marquee-track {
    animation: marquee-right 35s linear infinite;
}
.client-marquee-wrapper:hover .client-marquee-track {
    animation-play-state: paused;
}
.client-logo-pill {
    display: flex;
    align-items: center;
    padding: 0.625rem 1.5rem;
    border-radius: 0.75rem;
    background: var(--bg-card);
    border: 1px solid var(--border);
    box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.02);
    min-width: max-content;
    transition: all 0.3s ease;
    cursor: pointer;
}
.client-logo-pill:hover {
    border-color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 10px 20px -5px rgba(37,99,235,0.12);
}
.client-logo-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.5rem;
    background: #fff;
    border: 1px solid rgba(0,0,0,0.06);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    overflow: hidden;
}
.client-logo-icon img {
    max-width: 85%;
    max-height: 85%;
    object-fit: contain;
}
.client-logo-name {
    margin-left: 0.875rem;
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text-main);
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.01em;
}
</style>
@endif

{{-- ===== FEATURED SERVICES ===== --}}
<section class="section-padding" id="services" aria-label="Services">
    <div class="container-custom">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <div class="section-tag reveal"><i class="fas fa-cogs"></i> What We Offer</div>
            <h2 class="section-title reveal">Our Core <span class="text-gradient">Services</span></h2>
            <p class="section-subtitle reveal">We deliver end-to-end digital solutions — from stunning websites to powerful mobile apps and intuitive UI/UX design.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem;margin-bottom:3rem;">
            @forelse($services as $service)
            <article class="service-card reveal">
                <div class="card-icon">
                    <i class="{{ $service->icon }}"></i>
                </div>
                <h3 style="font-size:1.125rem;font-weight:700;margin-bottom:.75rem;color:var(--text-main);">{{ $service->title }}</h3>
                <p style="color:var(--text-muted);line-height:1.7;font-size:.9375rem;margin-bottom:1.25rem;">{{ $service->short_description }}</p>
                <a href="{{ route('services.show', $service->slug) }}" style="display:inline-flex;align-items:center;gap:.5rem;color:var(--primary);font-weight:600;font-size:.875rem;text-decoration:none;transition:gap .2s ease;" onmouseover="this.style.gap='.75rem'" onmouseout="this.style.gap='.5rem'">
                    Learn More <i class="fas fa-arrow-right"></i>
                </a>
            </article>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--text-muted);">Services loading soon…</div>
            @endforelse
        </div>

        <div style="text-align:center;">
            <a href="{{ route('services') }}" class="btn btn-primary" id="view-all-services-btn">
                <i class="fas fa-th-large"></i> View All Services
            </a>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ===== FEATURED PORTFOLIO ===== --}}
<section class="section-padding" id="portfolio-section" aria-label="Portfolio">
    <div class="container-custom">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <div class="section-tag reveal"><i class="fas fa-layer-group"></i> Our Work</div>
            <h2 class="section-title reveal">Featured <span class="text-gradient">Projects</span></h2>
            <p class="section-subtitle reveal">A selection of our best work across web development, mobile apps, and UI/UX design.</p>
        </div>

        {{-- Filter Buttons --}}
        <div style="display:flex;flex-wrap:wrap;gap:.75rem;justify-content:center;margin-bottom:2.5rem;" id="portfolio-filters">
            <button class="portfolio-filter-btn active" data-filter="all" id="filter-all-btn">All Projects</button>
            <button class="portfolio-filter-btn" data-filter="website" id="filter-website-btn">Website</button>
            <button class="portfolio-filter-btn" data-filter="mobile" id="filter-mobile-btn">Mobile App</button>
            <button class="portfolio-filter-btn" data-filter="uiux" id="filter-uiux-btn">UI/UX</button>
            <button class="portfolio-filter-btn" data-filter="wordpress_landing" id="filter-wordpress-btn">WordPress Landing Page</button>
            <button class="portfolio-filter-btn" data-filter="custom_code_landing" id="filter-custom-btn">Custom Code Landing Page</button>
        </div>

        {{-- Portfolio Grid --}}
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:1.5rem;" id="portfolio-grid">
            @forelse($portfolios as $project)
            <article class="portfolio-card reveal" data-category="{{ $project->category }}">
                @if($project->thumbnail)
                    <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" loading="lazy">
                @else
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,#1e3a8a,#0e7490);display:flex;align-items:center;justify-content:center;">
                        <i class="{{ $project->category === 'mobile' ? 'fas fa-mobile-alt' : ($project->category === 'uiux' ? 'fas fa-paint-brush' : ($project->category === 'wordpress_landing' ? 'fab fa-wordpress' : ($project->category === 'custom_code_landing' ? 'fas fa-code' : 'fas fa-globe'))) }}" style="font-size:3rem;color:rgba(255,255,255,.3);"></i>
                    </div>
                @endif
                <div class="portfolio-overlay">
                    <div style="margin-bottom:.5rem;">
                        <span class="badge badge-primary" style="font-size:.7rem;">
                            {{ $project->category === 'wordpress_landing' ? 'WordPress Landing Page' : ($project->category === 'custom_code_landing' ? 'Custom Code Landing Page' : ($project->category === 'uiux' ? 'UI/UX Design' : ($project->category === 'mobile' ? 'Mobile App' : 'Website'))) }}
                        </span>
                    </div>
                    <h3 style="color:#fff;font-size:1.1rem;font-weight:700;margin-bottom:.5rem;">{{ $project->title }}</h3>
                    <p style="color:rgba(255,255,255,.75);font-size:.8125rem;margin-bottom:.875rem;line-height:1.5;">{{ $project->short_description }}</p>
                    <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:.875rem;">
                        @foreach(array_slice($project->technologies ?? [], 0, 3) as $tech)
                        <span style="background:rgba(255,255,255,.15);color:#fff;padding:.15rem .6rem;border-radius:9999px;font-size:.7rem;">{{ $tech }}</span>
                        @endforeach
                    </div>
                    <div style="display:flex;gap:.75rem;">
                        <a href="{{ route('portfolio.show', $project->slug) }}" style="color:#fff;font-size:.875rem;text-decoration:none;display:flex;align-items:center;gap:.375rem;font-weight:600;" id="portfolio-detail-{{ $project->id }}">
                            <i class="fas fa-eye"></i> Details
                        </a>
                        @if($project->live_url)
                        <a href="{{ $project->live_url }}" target="_blank" rel="noopener" style="color:rgba(255,255,255,.75);font-size:.875rem;text-decoration:none;display:flex;align-items:center;gap:.375rem;">
                            <i class="fas fa-external-link-alt"></i> Live Demo
                        </a>
                        @endif
                    </div>
                </div>
            </article>
            @empty
            <div style="grid-column:1/-1;text-align:center;padding:3rem;color:var(--text-muted);">Portfolio coming soon…</div>
            @endforelse
        </div>

        <div style="text-align:center;margin-top:3rem;">
            <a href="{{ route('portfolio') }}" class="btn btn-primary" id="view-all-portfolio-btn">
                <i class="fas fa-folder-open"></i> View All Projects
            </a>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ===== WHY CHOOSE US ===== --}}
<section class="section-padding" style="background:var(--bg-card);" aria-label="Why Choose Us">
    <div class="container-custom">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;">
            <div>
                <div class="section-tag reveal-left"><i class="fas fa-star"></i> Why Us</div>
                <h2 class="section-title reveal-left" style="margin-bottom:1.5rem;">Why Choose <span class="text-gradient">Brother IT Digital?</span></h2>
                <p style="color:var(--text-muted);line-height:1.8;margin-bottom:2rem;" class="reveal-left">
                    We are a team of five university-level professionals dedicated to delivering premium digital solutions that drive real business results.
                </p>
                <a href="{{ route('about') }}" class="btn btn-primary reveal-left" id="learn-more-btn">
                    <i class="fas fa-info-circle"></i> Learn About Us
                </a>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
                @php
                $reasons = [
                    ['icon'=>'fas fa-rocket',       'color'=>'#2563EB','title'=>'Modern Technologies','desc'=>'We use the latest frameworks and tools for future-proof solutions.'],
                    ['icon'=>'fas fa-clock',         'color'=>'#10B981','title'=>'On-Time Delivery',  'desc'=>'We respect deadlines and deliver projects as promised, every time.'],
                    ['icon'=>'fas fa-headset',       'color'=>'#F59E0B','title'=>'24/7 Support',      'desc'=>'Round-the-clock support to keep your digital products running smoothly.'],
                    ['icon'=>'fas fa-shield-alt',    'color'=>'#8B5CF6','title'=>'Secure & Scalable', 'desc'=>'Enterprise-grade security and scalable architecture built in from day one.'],
                    ['icon'=>'fas fa-search',        'color'=>'#06B6D4','title'=>'SEO Optimized',     'desc'=>'All websites are built with SEO best practices for better Google rankings.'],
                    ['icon'=>'fas fa-hand-holding-usd','color'=>'#EF4444','title'=>'Affordable Pricing','desc'=>'Premium quality at competitive prices tailored for businesses of all sizes.'],
                ];
                @endphp
                @foreach($reasons as $i => $reason)
                <div class="reveal" style="background:var(--bg-light);border:1px solid var(--border);border-radius:var(--radius-md);padding:1.5rem;transition:all .3s ease;" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='var(--shadow-md)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                    <div style="width:2.75rem;height:2.75rem;border-radius:.625rem;background:{{ $reason['color'] }}20;display:flex;align-items:center;justify-content:center;margin-bottom:1rem;font-size:1.1rem;color:{{ $reason['color'] }};">
                        <i class="{{ $reason['icon'] }}"></i>
                    </div>
                    <h3 style="font-size:.9375rem;font-weight:700;margin-bottom:.375rem;color:var(--text-main);">{{ $reason['title'] }}</h3>
                    <p style="font-size:.8125rem;color:var(--text-muted);line-height:1.6;margin:0;">{{ $reason['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- ===== TESTIMONIALS ===== --}}
<section class="section-padding" id="testimonials" aria-label="Testimonials">
    <div class="container-custom">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <div class="section-tag reveal"><i class="fas fa-quote-left"></i> Client Love</div>
            <h2 class="section-title reveal">What Our <span class="text-gradient">Clients Say</span></h2>
            <p class="section-subtitle reveal">Real feedback from businesses and organizations we've helped grow digitally.</p>
        </div>

        @if($testimonials->count())
        <div class="swiper testimonialSwiper reveal" style="padding-bottom:3rem;">
            <div class="swiper-wrapper">
                @foreach($testimonials as $testimonial)
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        {{-- Stars --}}
                        <div style="display:flex;gap:.25rem;margin-bottom:1.25rem;">
                            @for($s=1;$s<=5;$s++)
                            <i class="fas fa-star" style="color:{{ $s <= $testimonial->rating ? '#F59E0B' : 'var(--border)' }};font-size:.875rem;"></i>
                            @endfor
                        </div>
                        <p style="color:var(--text-muted);line-height:1.8;font-size:.9375rem;margin-bottom:1.5rem;font-style:italic;">"{{ $testimonial->review }}"</p>
                        <div style="display:flex;align-items:center;gap:.875rem;">
                            @if($testimonial->photo)
                                <img src="{{ asset('storage/'.$testimonial->photo) }}" alt="{{ $testimonial->client_name }}" style="width:3rem;height:3rem;border-radius:50%;object-fit:cover;">
                            @else
                                <div style="width:3rem;height:3rem;border-radius:50%;background:linear-gradient(135deg,var(--primary),var(--accent));display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:1.1rem;flex-shrink:0;">
                                    {{ strtoupper(substr($testimonial->client_name,0,1)) }}
                                </div>
                            @endif
                            <div>
                                <div style="font-weight:700;font-size:.9375rem;color:var(--text-main);">{{ $testimonial->client_name }}</div>
                                <div style="font-size:.8125rem;color:var(--text-muted);">{{ $testimonial->position }}{{ $testimonial->company ? ', '.$testimonial->company : '' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination" style="margin-top:1.5rem;"></div>
        </div>
        @endif
    </div>
</section>

<div class="section-divider"></div>

{{-- ===== FAQ ===== --}}
<section class="section-padding" style="background:var(--bg-card);" id="faq" aria-label="FAQ">
    <div class="container-custom">
        <div style="display:grid;grid-template-columns:1fr 1.5fr;gap:4rem;align-items:start;">
            <div>
                <div class="section-tag reveal-left"><i class="fas fa-question-circle"></i> FAQ</div>
                <h2 class="section-title reveal-left" style="margin-bottom:1.25rem;">Frequently Asked <span class="text-gradient">Questions</span></h2>
                <p style="color:var(--text-muted);line-height:1.8;margin-bottom:2rem;" class="reveal-left">Find answers to common questions about our services, pricing, and process.</p>
                <a href="{{ route('faq') }}" class="btn btn-primary reveal-left" id="all-faqs-btn">
                    <i class="fas fa-list"></i> View All FAQs
                </a>
            </div>
            <div style="display:flex;flex-direction:column;gap:.75rem;">
                @foreach($faqs as $faq)
                <div class="faq-item reveal">
                    <div class="faq-question" id="faq-q-{{ $faq->id }}">
                        <span>{{ $faq->question }}</span>
                        <div class="faq-icon"><i class="fas fa-plus"></i></div>
                    </div>
                    <div class="faq-answer" id="faq-a-{{ $faq->id }}">{{ $faq->answer }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ===== CONTACT CTA ===== --}}
<section aria-label="Contact CTA" style="padding:5rem 0;background:linear-gradient(135deg,#0F172A 0%,#1e3a8a 50%,#0e7490 100%);position:relative;overflow:hidden;">
    <div style="position:absolute;top:-50%;right:-10%;width:500px;height:500px;border-radius:50%;background:rgba(37,99,235,.1);filter:blur(60px);pointer-events:none;"></div>
    <div class="container-custom" style="text-align:center;position:relative;z-index:1;">
        <div class="section-tag reveal" style="background:rgba(6,182,212,.15);color:var(--accent);margin:0 auto 1rem;"><i class="fas fa-comments"></i> Let's Talk</div>
        <h2 style="font-size:clamp(1.75rem,4vw,3rem);font-weight:900;color:#fff;margin-bottom:1rem;" class="reveal">Ready to Start Your <span class="gradient-text">Digital Journey?</span></h2>
        <p style="color:rgba(255,255,255,.7);font-size:1.1rem;max-width:550px;margin:0 auto 2.5rem;line-height:1.75;" class="reveal">Let's build something amazing together. Get a free consultation and quote today.</p>
        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;" class="reveal">
            <a href="{{ route('contact') }}" class="btn btn-primary" id="cta-contact-btn">
                <i class="fas fa-envelope"></i> Get In Touch
            </a>
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '8801609113112') }}" target="_blank" rel="noopener noreferrer" class="btn" style="background:#25D366; color:#fff; border:none; display:inline-flex; align-items:center; gap:0.5rem;" id="cta-whatsapp-btn">
                <i class="fab fa-whatsapp" style="font-size:1.1rem;"></i> WhatsApp
            </a>
            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone'] ?? '01609113112') }}" class="btn btn-outline" id="cta-phone-btn">
                <i class="fas fa-phone"></i> {{ $settings['contact_phone'] ?? '+88016-09113112' }}
            </a>
        </div>
        <div style="margin-top:2rem;color:rgba(255,255,255,.5);font-size:.875rem;" class="reveal">
            <i class="fas fa-envelope" style="color:var(--accent);margin-right:.375rem;"></i>
            brotheritdigital@gmail.com
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Testimonial Swiper
const swiper = new Swiper('.testimonialSwiper', {
    slidesPerView: 1,
    spaceBetween: 24,
    loop: true,
    autoplay: { delay: 5000, disableOnInteraction: false },
    pagination: { el: '.swiper-pagination', clickable: true },
    breakpoints: {
        768:  { slidesPerView: 2 },
        1024: { slidesPerView: 3 },
    },
});

// Portfolio Filter
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
            if (show) setTimeout(() => item.classList.add('visible'), 50);
        });
    });
});
</script>
@endpush
