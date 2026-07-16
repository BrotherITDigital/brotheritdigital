@extends('layouts.app')

@section('title', 'Contact Us – Brother IT Digital PLC')
@section('meta_description', 'Get in touch with Brother IT Digital PLC. Send us a message or request a free quote for your next web or mobile app development project.')

@section('content')

{{-- Hero Section --}}
<section style="padding: 9rem 0 5rem; background: linear-gradient(135deg, #0F172A, #1e3a8a); position: relative; overflow: hidden;" aria-label="Contact Hero">
    <div class="container-custom" style="position: relative; z-index: 1; text-align: center;">
        <div class="hero-badge" style="margin: 0 auto 1rem;"><i class="fas fa-envelope"></i> Contact</div>
        <h1 style="font-size: clamp(2.25rem, 5vw, 3.75rem); font-weight: 900; color: #fff; margin-bottom: 1rem;">
            Get In <span class="gradient-text">Touch</span>
        </h1>
        <p style="color: rgba(255, 255, 255, 0.7); max-width: 580px; margin: 0 auto 1.5rem; line-height: 1.75;">
            Have a project in mind or want to learn more about our services? Send us a message today.
        </p>
        <nav aria-label="Breadcrumb" style="display: flex; justify-content: center; gap: .5rem; font-size: .875rem; color: rgba(255, 255, 255, 0.5);">
            <a href="{{ route('home') }}" style="color: rgba(255, 255, 255, 0.6); text-decoration: none;">Home</a>
            <span>/</span><span style="color: var(--accent);">Contact</span>
        </nav>
    </div>
</section>

{{-- Contact Forms and Details --}}
<section class="section-padding">
    <div class="container-custom">
        <div style="display: grid; grid-template-columns: 1fr 1.3fr; gap: 4rem; align-items: start;">
            
            {{-- Left column - details & map --}}
            <div class="reveal-left" style="display: flex; flex-direction: column; gap: 2.5rem;">
                
                <div>
                    <div class="section-tag" style="margin-bottom: 1rem;"><i class="fas fa-phone"></i> Contact Details</div>
                    <h2 class="section-title" style="font-size: 1.75rem; margin-bottom: 1rem; text-align: left;">Let's discuss your project!</h2>
                    <p style="color: var(--text-muted); line-height: 1.75; font-size: .9375rem;">
                        Reach out to us directly or fill out the contact form. Our team will get back to you within 24 hours.
                    </p>
                </div>

                {{-- Contact Info Cards --}}
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    
                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="width: 3rem; height: 3rem; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(6, 182, 212, 0.15)); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: var(--primary); flex-shrink: 0;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-main); margin-bottom: .25rem;">Phone Number</h3>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone'] ?? '01609113112') }}" style="color: var(--text-muted); text-decoration: none; font-size: .9375rem; transition: color .2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                                {{ $settings['contact_phone'] ?? '+88016-09113112' }}
                            </a>
                        </div>
                    </div>

                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="width: 3rem; height: 3rem; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(6, 182, 212, 0.15)); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: #25D366; flex-shrink: 0; background-color: rgba(37, 211, 102, 0.1);">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-main); margin-bottom: .25rem;">WhatsApp</h3>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '8801609113112') }}" target="_blank" rel="noopener noreferrer" style="color: var(--text-muted); text-decoration: none; font-size: .9375rem; transition: color .2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                                {{ $settings['whatsapp_number'] ?? '+88016-09113112' }}
                            </a>
                        </div>
                    </div>
 
                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="width: 3rem; height: 3rem; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(6, 182, 212, 0.15)); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: var(--primary); flex-shrink: 0;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-main); margin-bottom: .25rem;">Email Address</h3>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'brotheritdigital@gmail.com' }}" style="color: var(--text-muted); text-decoration: none; font-size: .9375rem; transition: color .2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-muted)'">
                                {{ $settings['contact_email'] ?? 'brotheritdigital@gmail.com' }}
                            </a>
                        </div>
                    </div>
 
                    <div style="display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="width: 3rem; height: 3rem; border-radius: var(--radius-md); background: linear-gradient(135deg, rgba(37, 99, 235, 0.15), rgba(6, 182, 212, 0.15)); display: flex; align-items: center; justify-content: center; font-size: 1.25rem; color: var(--primary); flex-shrink: 0;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-main); margin-bottom: .25rem;">Office Address</h3>
                            <p style="color: var(--text-muted); font-size: .9375rem; margin: 0; line-height: 1.5;">
                                {{ $settings['contact_address'] ?? 'Dhaka, Bangladesh' }}
                            </p>
                            @if(!empty($settings['contact_address_2']))
                                <h3 style="font-size: 1rem; font-weight: 700; color: var(--text-main); margin-bottom: .25rem; margin-top: 1rem;">Second Office Address</h3>
                                <p style="color: var(--text-muted); font-size: .9375rem; margin: 0; line-height: 1.5;">
                                    {{ $settings['contact_address_2'] }}
                                </p>
                            @endif
                        </div>
                    </div>

                </div>

                {{-- Map --}}
                <div style="border-radius: var(--radius-lg); overflow: hidden; border: 1px solid var(--border); aspect-ratio: 16/10;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116833.9730352447!2d90.3372880467554!3d23.780818635562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa5020a7b016e11!2sDhaka!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd" style="border:0; width:100%; height:100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

            </div>

            {{-- Right column - Livewire Form --}}
            <div class="reveal-right">
                @livewire('contact-form')
            </div>

        </div>
    </div>
</section>

@endsection
