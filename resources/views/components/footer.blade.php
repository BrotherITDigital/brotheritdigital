<footer class="footer" role="contentinfo">
    {{-- Main Footer --}}
    <div class="container-custom" style="padding-top:5rem;padding-bottom:3rem;">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:3rem;">

            {{-- Company Info --}}
            <div style="grid-column:span 1;">
                <a href="{{ route('home') }}" style="display:flex;align-items:center;gap:.75rem;text-decoration:none;margin-bottom:1.5rem;">
                    <div style="width:2.5rem;height:2.5rem;background:linear-gradient(135deg,#2563EB,#06B6D4);border-radius:.625rem;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#fff;font-weight:800;font-family:'Poppins',sans-serif;">B</div>
                    <div>
                        <div style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.1rem;color:#fff;">{{ $settings['site_name'] ?? 'Brother IT Digital PLC' }}</div>
                        <div style="font-size:.65rem;color:rgba(255,255,255,.5);letter-spacing:.1em;text-transform:uppercase;">{{ $settings['site_tagline'] ?? 'Building Digital Solutions' }}</div>
                    </div>
                </a>
                <p style="color:rgba(255,255,255,.55);line-height:1.75;font-size:.9375rem;margin-bottom:1.5rem;">
                    {{ $settings['site_description'] ?? 'We deliver secure, scalable, and business-focused software solutions that help organizations grow digitally.' }}
                </p>
                {{-- Social Links --}}
                <div style="display:flex;gap:.75rem;">
                    @foreach([
                        ['fab fa-facebook-f', $settings['facebook_url'] ?? 'https://facebook.com'],
                        ['fab fa-linkedin-in', $settings['linkedin_url'] ?? 'https://linkedin.com'],
                        ['fab fa-github', $settings['github_url'] ?? 'https://github.com'],
                        ['fab fa-twitter', $settings['twitter_url'] ?? 'https://twitter.com']
                    ] as [$icon,$url])
                    <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $icon }}"
                        style="width:2.25rem;height:2.25rem;border-radius:50%;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);color:rgba(255,255,255,.6);display:flex;align-items:center;justify-content:center;font-size:.875rem;transition:all .25s ease;text-decoration:none;"
                        onmouseover="this.style.background='#2563EB';this.style.borderColor='#2563EB';this.style.color='#fff';this.style.transform='translateY(-3px)'"
                        onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.borderColor='rgba(255,255,255,.12)';this.style.color='rgba(255,255,255,.6)';this.style.transform='none'">
                        <i class="{{ $icon }}"></i>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 style="color:#fff;font-size:1rem;font-weight:700;margin-bottom:1.25rem;font-family:'Poppins',sans-serif;">Quick Links</h3>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.625rem;">
                    @foreach([['Home',route('home')],['About Us',route('about')],['Services',route('services')],['Portfolio',route('portfolio')],['Our Team',route('team')],['Blog',route('blog')],['Contact',route('contact')]] as [$label,$url])
                    <li>
                        <a href="{{ $url }}" class="footer-link">
                            <i class="fas fa-chevron-right" style="font-size:.625rem;color:var(--accent);"></i>
                            {{ $label }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h3 style="color:#fff;font-size:1rem;font-weight:700;margin-bottom:1.25rem;font-family:'Poppins',sans-serif;">Our Services</h3>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:.625rem;">
                    @foreach(['Website Development','Mobile App Development','UI/UX Design','E-commerce Solutions','SEO Optimization','API Integration'] as $service)
                    <li>
                        <a href="{{ route('services') }}" class="footer-link">
                            <i class="fas fa-chevron-right" style="font-size:.625rem;color:var(--accent);"></i>
                            {{ $service }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 style="color:#fff;font-size:1rem;font-weight:700;margin-bottom:1.25rem;font-family:'Poppins',sans-serif;">Contact Us</h3>
                <div style="display:flex;flex-direction:column;gap:1rem;">
                    <div style="display:flex;align-items:flex-start;gap:.875rem;">
                        <div style="width:2rem;height:2rem;border-radius:.5rem;background:rgba(37,99,235,.2);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:.875rem;flex-shrink:0;margin-top:.125rem;">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.125rem;">Phone</div>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['contact_phone'] ?? '01609113112') }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:.9375rem;transition:color .2s;"
                               onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='rgba(255,255,255,.8)'">
                                {{ $settings['contact_phone'] ?? '+88016-09113112' }}
                            </a>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:.875rem;">
                        <div style="width:2rem;height:2rem;border-radius:.5rem;background:rgba(37,99,235,.2);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:.875rem;flex-shrink:0;margin-top:.125rem;">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.125rem;">WhatsApp</div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '8801609113112') }}" target="_blank" rel="noopener noreferrer" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:.9375rem;transition:color .2s;"
                               onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='rgba(255,255,255,.8)'">
                                {{ $settings['whatsapp_number'] ?? '+88016-09113112' }}
                            </a>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:.875rem;">
                        <div style="width:2rem;height:2rem;border-radius:.5rem;background:rgba(37,99,235,.2);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:.875rem;flex-shrink:0;margin-top:.125rem;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.125rem;">Email</div>
                            <a href="mailto:{{ $settings['contact_email'] ?? 'brotheritdigital@gmail.com' }}" style="color:rgba(255,255,255,.8);text-decoration:none;font-size:.875rem;transition:color .2s;word-break:break-all;"
                               onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='rgba(255,255,255,.8)'">
                                {{ $settings['contact_email'] ?? 'brotheritdigital@gmail.com' }}
                            </a>
                        </div>
                    </div>
                    <div style="display:flex;align-items:flex-start;gap:.875rem;">
                        <div style="width:2rem;height:2rem;border-radius:.5rem;background:rgba(37,99,235,.2);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:.875rem;flex-shrink:0;margin-top:.125rem;">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <div style="font-size:.75rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.125rem;">Office Address</div>
                            <span style="color:rgba(255,255,255,.8);font-size:.9375rem;display:block;">{{ $settings['contact_address'] ?? 'Dhaka, Bangladesh' }}</span>
                            @if(!empty($settings['contact_address_2']))
                            <div style="font-size:.75rem;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em;margin-bottom:.125rem;margin-top:.75rem;">Second Office Address</div>
                            <span style="color:rgba(255,255,255,.8);font-size:.9375rem;display:block;">{{ $settings['contact_address_2'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div style="border-top:1px solid rgba(255,255,255,.08);padding:1.5rem 0;">
        <div class="container-custom" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
            <p style="color:rgba(255,255,255,.4);font-size:.875rem;margin:0;">
                &copy; {{ date('Y') }} Brother IT Digital PLC. All rights reserved.
            </p>
            <div style="display:flex;gap:1.5rem;">
                <a href="#" class="footer-link" style="font-size:.875rem;">Privacy Policy</a>
                <a href="#" class="footer-link" style="font-size:.875rem;">Terms of Service</a>
                <a href="{{ route('sitemap') }}" class="footer-link" style="font-size:.875rem;">Sitemap</a>
            </div>
        </div>
    </div>
</footer>
