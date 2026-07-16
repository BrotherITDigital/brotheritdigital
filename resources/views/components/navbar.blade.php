<nav id="navbar" class="navbar" role="navigation" aria-label="Main navigation">
    <div class="container-custom">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:2rem;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3" style="display:flex;align-items:center;gap:.75rem;text-decoration:none;">
                <div style="width:2.5rem;height:2.5rem;background:linear-gradient(135deg,#2563EB,#06B6D4);border-radius:.625rem;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#fff;font-weight:800;font-family:'Poppins',sans-serif;">B</div>
                <div>
                    <div style="font-family:'Poppins',sans-serif;font-weight:800;font-size:1.1rem;color:#fff;line-height:1.1;">Brother IT</div>
                    <div style="font-size:.65rem;color:rgba(255,255,255,.6);letter-spacing:.1em;text-transform:uppercase;">Digital PLC</div>
                </div>
            </a>

            {{-- Desktop Nav --}}
            <div id="desktop-nav" style="display:flex;align-items:center;gap:2rem;" class="hidden-mobile">
                <a href="{{ route('home') }}"      class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}"     class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">{{ __('messages.about') }}</a>
                <a href="{{ route('services') }}"  class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}">{{ __('messages.services') }}</a>
                <a href="{{ route('portfolio') }}" class="nav-link {{ request()->routeIs('portfolio*') ? 'active' : '' }}">{{ __('messages.portfolio') }}</a>
                <a href="{{ route('team') }}"      class="nav-link {{ request()->routeIs('team') ? 'active' : '' }}">{{ __('messages.team') }}</a>
                <a href="{{ route('blog') }}"      class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}">{{ __('messages.blog') }}</a>
                <a href="{{ route('contact') }}"   class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">{{ __('messages.contact') }}</a>
            </div>

            {{-- Right Actions --}}
            <div style="display:flex;align-items:center;gap:1rem;">
                
                {{-- Language Selector --}}
                <div style="position:relative;" x-data="{ open: false }">
                    <button @click="open = !open" style="background:rgba(255,255,255,.1); border:1px solid rgba(255,255,255,.2); color:#fff; padding:.4rem .75rem; border-radius:.5rem; cursor:pointer; font-size:.8rem; display:flex; align-items:center; gap:.375rem; font-weight:600; min-height: 2.25rem;" id="lang-menu-btn">
                        @if(app()->getLocale() === 'bn')
                            <img src="https://flagcdn.com/w20/bd.png" alt="BD" style="width:16px; height:12px; object-fit:cover; border-radius:1px;"> <span>BN</span>
                        @elseif(app()->getLocale() === 'ar')
                            <img src="https://flagcdn.com/w20/ae.png" alt="AE" style="width:16px; height:12px; object-fit:cover; border-radius:1px;"> <span>AR</span>
                        @else
                            <img src="https://flagcdn.com/w20/us.png" alt="US" style="width:16px; height:12px; object-fit:cover; border-radius:1px;"> <span>EN</span>
                        @endif
                        <i class="fas fa-chevron-down" style="font-size:.6rem; opacity: 0.7; margin-left: 2px;"></i>
                    </button>
                    <div x-show="open" @click.outside="open = false" style="position:absolute; right:0; top:calc(100% + .5rem); background:var(--bg-card); border:1px solid var(--border); border-radius:.5rem; box-shadow:var(--shadow-lg); z-index:100; min-width:140px; overflow:hidden;">
                        <a href="{{ route('lang.switch', 'en') }}" style="display:flex; align-items:center; gap:.5rem; padding:.5rem 1rem; color:var(--text-main); font-size:.8125rem; text-decoration:none; font-weight:500;" id="lang-switch-en">
                            <img src="https://flagcdn.com/w20/us.png" alt="US" style="width:16px; height:12px; object-fit:cover; border-radius:1px;"> English
                        </a>
                        <a href="{{ route('lang.switch', 'bn') }}" style="display:flex; align-items:center; gap:.5rem; padding:.5rem 1rem; color:var(--text-main); font-size:.8125rem; text-decoration:none; font-weight:500;" id="lang-switch-bn">
                            <img src="https://flagcdn.com/w20/bd.png" alt="BD" style="width:16px; height:12px; object-fit:cover; border-radius:1px;"> বাংলা
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}" style="display:flex; align-items:center; gap:.5rem; padding:.5rem 1rem; color:var(--text-main); font-size:.8125rem; text-decoration:none; font-weight:500;" id="lang-switch-ar">
                            <img src="https://flagcdn.com/w20/ae.png" alt="AE" style="width:16px; height:12px; object-fit:cover; border-radius:1px;"> العربية (UAE)
                        </a>
                    </div>
                </div>

                {{-- CTA --}}
                <a href="{{ route('contact') }}" class="btn btn-primary" style="padding:.6rem 1.25rem;font-size:.875rem;" id="nav-cta-btn">
                    {{ __('messages.get_quote') }}
                </a>

                {{-- Mobile Hamburger --}}
                <button onclick="toggleMobileMenu()" id="hamburger-btn" aria-label="Open menu"
                    style="display:none;width:2.25rem;height:2.25rem;border-radius:.5rem;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.2);color:#fff;cursor:pointer;align-items:center;justify-content:center;">
                    <i id="menu-icon" class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden" style="padding:1.5rem 0;border-top:1px solid rgba(255,255,255,.1);margin-top:1rem;">
            <div style="display:flex;flex-direction:column;gap:.5rem;">
                <a href="{{ route('home') }}"      class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.home') }}</a>
                <a href="{{ route('about') }}"     class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.about') }}</a>
                <a href="{{ route('services') }}"  class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.services') }}</a>
                <a href="{{ route('portfolio') }}" class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.portfolio') }}</a>
                <a href="{{ route('team') }}"      class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.team') }}</a>
                <a href="{{ route('blog') }}"      class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.blog') }}</a>
                <a href="{{ route('contact') }}"   class="nav-link" style="padding:.75rem;border-radius:.5rem;">{{ __('messages.contact') }}</a>
                @auth
                <a href="{{ route('admin.dashboard') }}" class="nav-link" style="padding:.75rem;border-radius:.5rem;color:var(--accent);">Admin</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
@media (max-width: 1024px) {
    #desktop-nav { display: none !important; }
    #hamburger-btn { display: flex !important; }
    #nav-cta-btn { display: none !important; }
    .hidden-mobile { display: none !important; }
}
</style>
