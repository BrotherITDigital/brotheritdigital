<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') – Brother IT Digital PLC</title>

    {{-- Fonts & CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')
</head>
<body style="background: #F1F5F9; color: #0F172A; font-family: 'Inter', sans-serif;">

    {{-- Admin Sidebar --}}
    <aside id="admin-sidebar" class="admin-sidebar" role="navigation" aria-label="Admin sidebar">
        {{-- Brand Logo --}}
        <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255, 255, 255, 0.08); display: flex; align-items: center; gap: .75rem;">
            <div style="width: 2.25rem; height: 2.25rem; background: linear-gradient(135deg, #2563EB, #06B6D4); border-radius: .5rem; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #fff; font-family: 'Poppins', sans-serif; font-size: 1.1rem;">B</div>
            <div>
                <div style="font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 1rem; color: #fff; line-height: 1.1;">Brother IT</div>
                <div style="font-size: .65rem; color: rgba(255,255,255,.5); text-transform: uppercase; letter-spacing: .05em;">Admin Control</div>
            </div>
        </div>

        {{-- Navigation links --}}
        <div style="flex: 1; overflow-y: auto; padding: 1.25rem 0;">
            <div style="font-size: .65rem; text-transform: uppercase; color: rgba(255,255,255,.4); letter-spacing: .08em; font-weight: 700; padding: 0 1.25rem; margin-bottom: .5rem;">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="admin-sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-pie" style="width:1.25rem;"></i> Dashboard
            </a>

            <div style="font-size: .65rem; text-transform: uppercase; color: rgba(255,255,255,.4); letter-spacing: .08em; font-weight: 700; padding: 0 1.25rem; margin: 1.5rem 0 .5rem;">Content</div>
            <a href="{{ route('admin.services.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.services*') ? 'active' : '' }}">
                <i class="fas fa-cogs" style="width:1.25rem;"></i> Services
            </a>
            <a href="{{ route('admin.portfolios.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.portfolios*') ? 'active' : '' }}">
                <i class="fas fa-folder-open" style="width:1.25rem;"></i> Portfolios
            </a>
            <a href="{{ route('admin.team.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.team*') ? 'active' : '' }}">
                <i class="fas fa-users" style="width:1.25rem;"></i> Team
            </a>
            <a href="{{ route('admin.blog.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.blog*') ? 'active' : '' }}">
                <i class="fas fa-edit" style="width:1.25rem;"></i> Blog
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <i class="fas fa-quote-left" style="width:1.25rem;"></i> Testimonials
            </a>
            <a href="{{ route('admin.faqs.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.faqs*') ? 'active' : '' }}">
                <i class="fas fa-question-circle" style="width:1.25rem;"></i> FAQs
            </a>
            <a href="{{ route('admin.clients.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.clients*') ? 'active' : '' }}">
                <i class="fas fa-handshake" style="width:1.25rem;"></i> Clients
            </a>

            <div style="font-size: .65rem; text-transform: uppercase; color: rgba(255,255,255,.4); letter-spacing: .08em; font-weight: 700; padding: 0 1.25rem; margin: 1.5rem 0 .5rem;">Messages</div>
            <a href="{{ route('admin.contacts.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" style="display:flex; justify-content:space-between; align-items:center;">
                <div><i class="fas fa-envelope" style="width:1.25rem;"></i> Messages</div>
                @php $unreadCount = \App\Models\ContactMessage::unread()->count(); @endphp
                @if($unreadCount > 0)
                <span class="badge badge-danger" style="background:#EF4444; color:#fff; font-size:.65rem;">{{ $unreadCount }}</span>
                @endif
            </a>

            <div style="font-size: .65rem; text-transform: uppercase; color: rgba(255,255,255,.4); letter-spacing: .08em; font-weight: 700; padding: 0 1.25rem; margin: 1.5rem 0 .5rem;">Settings</div>
            <a href="{{ route('admin.settings.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fas fa-sliders-h" style="width:1.25rem;"></i> Site Settings
            </a>
            <a href="{{ route('admin.users.index') }}" class="admin-sidebar-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="fas fa-user-shield" style="width:1.25rem;"></i> Users
            </a>
            <a href="{{ route('admin.media') }}" class="admin-sidebar-link {{ request()->routeIs('admin.media*') ? 'active' : '' }}">
                <i class="fas fa-images" style="width:1.25rem;"></i> Media Manager
            </a>
        </div>

        {{-- Sidebar Footer Profile --}}
        <div style="padding: 1.25rem; border-top: 1px solid rgba(255, 255, 255, 0.08); display: flex; align-items: center; justify-content: space-between; gap: .75rem;">
            <div style="display: flex; align-items: center; gap: .625rem; overflow: hidden;">
                <div style="width: 2.25rem; height: 2.25rem; border-radius: 50%; background: var(--primary); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: .9rem; flex-shrink: 0;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <div style="font-weight: 600; font-size: .875rem; color: #fff; line-height: 1.2;">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div style="font-size: .75rem; color: rgba(255,255,255,.5);">{{ auth()->user()->email ?? 'admin@brotherit.com' }}</div>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background: none; border: none; color: rgba(255,255,255,.5); cursor: pointer; font-size: .9375rem; transition: color .2s;" onmouseover="this.style.color='#EF4444'" onmouseout="this.style.color='rgba(255,255,255,.5)'" id="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </aside>

    {{-- Main Area --}}
    <div class="admin-content">
        {{-- Topbar --}}
        <header class="admin-topbar">
            <div style="display: flex; align-items: center; gap: .75rem;">
                <button onclick="toggleAdminSidebar()" style="background: none; border: none; font-size: 1.25rem; color: #0F172A; cursor: pointer; display: none;" id="sidebar-toggle-btn">
                    <i class="fas fa-bars"></i>
                </button>
                <div style="font-size: .875rem; color: #64748B; font-weight: 500;">
                    @yield('breadcrumb')
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 1rem;">
                <a href="{{ route('home') }}" target="_blank" class="btn btn-primary" style="padding: .5rem 1.25rem; font-size: .8125rem;" id="visit-site-btn">
                    <i class="fas fa-external-link-alt"></i> Visit Site
                </a>
            </div>
        </header>

        {{-- Content View --}}
        <main style="padding: 2.25rem;">
            @if(session('success'))
            <div style="background: #D1E7DD; color: #0F5132; border: 1px solid #BADBCC; border-radius: var(--radius-sm); padding: .75rem 1.25rem; margin-bottom: 1.5rem; font-size: .875rem; display: flex; align-items: center; gap: .5rem;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div style="background: #F8D7DA; color: #842029; border: 1px solid #F5C2C7; border-radius: var(--radius-sm); padding: .75rem 1.25rem; margin-bottom: 1.5rem; font-size: .875rem; display: flex; align-items: center; gap: .5rem;">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    <style>
    @media (max-width: 768px) {
        #sidebar-toggle-btn { display: block !important; }
    }
    </style>

    @livewireScripts
    @stack('scripts')
</body>
</html>
