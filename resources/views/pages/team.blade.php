@extends('layouts.app')

@section('title', 'Meet Our Expert Team – Brother IT Digital PLC')
@section('meta_description', 'Meet our expert team of five university-level professionals working together to build high-quality web applications and mobile apps.')

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Team Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;"><i class="fas fa-users"></i> Our Team</div>
        <h1 style="font-size: clamp(2.25rem, 5vw, 3.75rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            Expert <span class="gradient-text">Professionals</span>
        </h1>
        <p style="color: rgba(255, 255, 255, 0.7); max-width: 600px; margin: 0 auto 1.5rem; line-height: 1.75;">
            Five university-level experts combining creative design with robust development to deliver state-of-the-art products.
        </p>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span><span style="color: var(--accent);">Our Team</span>
        </nav>
    </div>
</section>

{{-- Team Grid Section --}}
<section class="section-padding" aria-label="Team Members">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 2rem;">
            @forelse($team as $member)
            <article class="team-card reveal">
                {{-- Profile Image with fallbacks --}}
                <div style="aspect-ratio: 1; background: var(--border); overflow: hidden; position: relative;">
                    @if($member->photo)
                        <img src="{{ asset('storage/' . $member->photo) }}" alt="{{ $member->name }}" class="team-card-avatar" loading="lazy">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--accent)); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 4rem; font-weight: 800; font-family: 'Poppins', sans-serif;">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <div style="padding: 1.75rem;">
                    <h3 style="font-size: 1.125rem; font-weight: 700; color: var(--text-main); margin-bottom: .25rem;">{{ $member->name }}</h3>
                    <div style="color: var(--primary); font-weight: 600; font-size: .875rem; margin-bottom: 1rem;">{{ $member->position }}</div>
                    
                    @if($member->bio)
                    <p style="color: var(--text-muted); font-size: .875rem; line-height: 1.6; margin-bottom: 1.25rem;">
                        {{ $member->bio }}
                    </p>
                    @endif

                    {{-- Skills --}}
                    @if($member->skills && count($member->skills))
                    <div style="display: flex; flex-wrap: wrap; gap: .375rem; justify-content: center; margin-bottom: 1.25rem;">
                        @foreach($member->skills as $skill)
                        <span class="badge badge-primary" style="font-size: .7rem; font-weight: 500;">{{ $skill }}</span>
                        @endforeach
                    </div>
                    @endif

                    {{-- Social Icons --}}
                    <div class="team-social" style="display: flex; gap: .625rem; justify-content: center;">
                        @if(isset($member->social_links['github']))
                        <a href="{{ $member->social_links['github'] }}" target="_blank" rel="noopener" aria-label="GitHub"><i class="fab fa-github"></i></a>
                        @endif
                        @if(isset($member->social_links['linkedin']))
                        <a href="{{ $member->social_links['linkedin'] }}" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if(isset($member->social_links['twitter']))
                        <a href="{{ $member->social_links['twitter'] }}" target="_blank" rel="noopener" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        @endif
                        @if(isset($member->social_links['facebook']))
                        <a href="{{ $member->social_links['facebook'] }}" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        @endif
                    </div>
                </div>
            </article>
            @empty
            <div style="grid-column: 1/-1; text-align: center; color: var(--text-muted);">
                Team members are loading soon...
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Join Team CTA --}}
<section style="padding: 5rem 0; background: var(--bg-card); border-top: 1px solid var(--border); border-bottom: 1px solid var(--border);" aria-label="Join Team CTA">
    <div class="container-custom" style="text-align: center;">
        <h2 style="font-size: 1.75rem; font-weight: 800; color: var(--text-main); margin-bottom: 1rem;">Want to join our developer team?</h2>
        <p style="color: var(--text-muted); max-width: 550px; margin: 0 auto 2rem; line-height: 1.6;">
            We are always looking for passionate tech minds. Send us your CV or portfolio link.
        </p>
        <a href="{{ route('contact') }}" class="btn btn-primary" id="join-team-btn"><i class="fas fa-paper-plane"></i> Contact Us</a>
    </div>
</section>

@endsection
