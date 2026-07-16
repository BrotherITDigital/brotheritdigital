@extends('layouts.app')

@section('title', 'About Us – Brother IT Digital PLC')
@section('meta_description', 'Learn about Brother IT Digital PLC – a team of five university-level professionals delivering secure, scalable, and modern digital solutions.')

@section('content')

{{-- Page Hero --}}
<section style="padding:9rem 0 5rem;background:linear-gradient(135deg,#0F172A,#1e3a8a,#0e7490);position:relative;overflow:hidden;" aria-label="About Hero">
    <div style="position:absolute;inset:0;background:url('data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 800 400%22><circle cx=%22700%22 cy=%22100%22 r=%22200%22 fill=%22rgba(37,99,235,.08)%22/><circle cx=%22100%22 cy=%22350%22 r=%22150%22 fill=%22rgba(6,182,212,.06)%22/></svg>');background-size:cover;pointer-events:none;"></div>
    <div class="container-custom" style="position:relative;z-index:1;text-align:center;">
        <div class="hero-badge" style="margin:0 auto 1rem;">About Us</div>
        <h1 style="font-size:clamp(2.5rem,5vw,4rem);font-weight:900;color:#fff;margin-bottom:1rem;letter-spacing:-0.03em;">
            Who We <span class="gradient-text">Are</span>
        </h1>
        <p style="color:rgba(255,255,255,.7);font-size:1.1rem;max-width:600px;margin:0 auto 2rem;line-height:1.75;">A passionate team of digital experts building future-ready software solutions for businesses worldwide.</p>
        <nav aria-label="Breadcrumb" style="display:flex;justify-content:center;gap:.5rem;font-size:.875rem;color:rgba(255,255,255,.5);">
            <a href="{{ route('home') }}" style="color:rgba(255,255,255,.6);text-decoration:none;">Home</a>
            <span>/</span><span style="color:var(--accent);">About Us</span>
        </nav>
    </div>
</section>

{{-- Company Story --}}
<section class="section-padding" aria-label="Company Story">
    <div class="container-custom">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:center;">
            <div class="reveal-left">
                <div class="section-tag"><i class="fas fa-history"></i> Our Story</div>
                <h2 class="section-title" style="margin-bottom:1.5rem;">Building the <span class="text-gradient">Digital Future</span> Together</h2>
                <p style="color:var(--text-muted);line-height:1.9;margin-bottom:1.25rem;">Brother IT Digital PLC was founded by a group of five passionate university-level professionals united by a single vision: to deliver world-class digital solutions that make a real difference for businesses and organizations.</p>
                <p style="color:var(--text-muted);line-height:1.9;margin-bottom:1.25rem;">From day one, we committed to using modern technologies — Laravel, Flutter, Vue.js, and more — to build products that are not just functional, but beautiful, fast, and secure.</p>
                <p style="color:var(--text-muted);line-height:1.9;margin-bottom:2rem;">Today, we proudly serve clients across Bangladesh and internationally, delivering projects ranging from simple corporate websites to complex multi-platform applications.</p>
                <div style="display:flex;gap:1.5rem;flex-wrap:wrap;">
                    <a href="{{ route('contact') }}" class="btn btn-primary" id="about-cta-btn"><i class="fas fa-handshake"></i> Work With Us</a>
                    <a href="{{ route('portfolio') }}" class="btn" style="border:2px solid var(--border);color:var(--text-main);background:transparent;" id="about-portfolio-btn"><i class="fas fa-eye"></i> View Our Work</a>
                </div>
            </div>
            <div class="reveal-right" style="position:relative;">
                <div style="background:linear-gradient(135deg,#1e3a8a,#0e7490);border-radius:var(--radius-xl);padding:3rem;position:relative;overflow:hidden;">
                    <div style="position:absolute;top:-20px;right:-20px;width:120px;height:120px;border-radius:50%;background:rgba(255,255,255,.05);"></div>
                    <div style="position:absolute;bottom:-30px;left:-10px;width:80px;height:80px;border-radius:50%;background:rgba(6,182,212,.1);"></div>
                    @php $highlights = [['fas fa-code','100%','Client Satisfaction'],['fas fa-shield-alt','Enterprise','Grade Security'],['fas fa-rocket','3x Faster','Delivery Speed'],['fas fa-globe','50+','Projects Done']]; @endphp
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;position:relative;z-index:1;">
                        @foreach($highlights as $h)
                        <div style="background:rgba(255,255,255,.08);border-radius:var(--radius-md);padding:1.5rem;text-align:center;border:1px solid rgba(255,255,255,.1);">
                            <i class="{{ $h[0] }}" style="font-size:1.75rem;color:var(--accent);margin-bottom:.75rem;display:block;"></i>
                            <div style="font-size:1.25rem;font-weight:800;color:#fff;font-family:'Poppins',sans-serif;">{{ $h[1] }}</div>
                            <div style="font-size:.8125rem;color:rgba(255,255,255,.6);">{{ $h[2] }}</div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- Mission, Vision, Values --}}
<section class="section-padding" style="background:var(--bg-card);" aria-label="Mission Vision Values">
    <div class="container-custom">
        <div style="text-align:center;margin-bottom:3.5rem;">
            <div class="section-tag reveal"><i class="fas fa-bullseye"></i> Core Principles</div>
            <h2 class="section-title reveal">Our <span class="text-gradient">Mission & Vision</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem;">
            @php $mvv = [['fas fa-rocket','#2563EB','Mission','To deliver secure, scalable, and beautiful digital solutions that empower businesses to grow, compete, and succeed in the digital era.'],['fas fa-eye','#06B6D4','Vision','To become the most trusted software development partner for businesses across South Asia and beyond, known for quality and innovation.'],['fas fa-heart','#F59E0B','Values','Integrity, Innovation, Excellence, Collaboration, and Client-First thinking guide every decision and every line of code we write.']]; @endphp
            @foreach($mvv as $i => [$icon,$color,$title,$desc])
            <div class="reveal" style="background:var(--bg-light);border:1px solid var(--border);border-radius:var(--radius-lg);padding:2.5rem;text-align:center;transition:all .3s ease;" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='var(--shadow-lg)'" onmouseout="this.style.transform='none';this.style.boxShadow='none'">
                <div style="width:4rem;height:4rem;border-radius:50%;background:{{ $color }}20;border:2px solid {{ $color }}40;display:flex;align-items:center;justify-content:center;margin:0 auto 1.5rem;font-size:1.5rem;color:{{ $color }};">
                    <i class="{{ $icon }}"></i>
                </div>
                <h3 style="font-size:1.25rem;font-weight:700;margin-bottom:.875rem;color:var(--text-main);">{{ $title }}</h3>
                <p style="color:var(--text-muted);line-height:1.8;font-size:.9375rem;margin:0;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- Stats Row --}}
<section style="padding:4rem 0;background:linear-gradient(135deg,var(--secondary),#1e3a8a);" aria-label="Company stats">
    <div class="container-custom">
        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;text-align:center;">
            @php $stats=[['50+','Projects Completed'],['30+','Happy Clients'],['5','Expert Team Members'],['3+','Years Experience']]; @endphp
            @foreach($stats as [$num,$label])
            <div class="reveal">
                <div style="font-size:clamp(2rem,4vw,3rem);font-weight:900;color:#fff;font-family:'Poppins',sans-serif;margin-bottom:.25rem;">{{ $num }}</div>
                <div style="color:rgba(255,255,255,.6);font-size:.9375rem;">{{ $label }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<div class="section-divider"></div>

{{-- Team Preview --}}
<section class="section-padding" aria-label="Team preview">
    <div class="container-custom" style="text-align:center;">
        <div class="section-tag reveal"><i class="fas fa-users"></i> The Team</div>
        <h2 class="section-title reveal">Meet Our <span class="text-gradient">Expert Team</span></h2>
        <p class="section-subtitle reveal" style="margin-bottom:2.5rem;">Five university-level professionals combining deep technical expertise with creative problem-solving to deliver exceptional digital products.</p>
        <a href="{{ route('team') }}" class="btn btn-primary reveal" id="meet-team-btn"><i class="fas fa-users"></i> Meet the Team</a>
    </div>
</section>

@endsection
