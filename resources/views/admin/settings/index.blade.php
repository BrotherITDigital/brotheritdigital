@extends('layouts.admin')

@section('title', 'Site Settings')

@section('breadcrumb')
<a href="{{ route('admin.dashboard') }}" style="color:#64748B; text-decoration:none;">Dashboard</a>
<span style="color:#64748B; margin: 0 .5rem;">/</span>
<span style="color:#0F172A; font-weight: 600;">Settings</span>
@endsection

@section('content')

<div class="admin-card" x-data="{ tab: 'general' }">
    <div style="border-bottom:1px solid #E2E8F0; padding-bottom:.75rem; margin-bottom:1.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1rem;">
        <h2 style="font-size: 1.125rem; font-weight: 700; color: #0F172A; margin: 0;">Configuration Settings</h2>
        
        {{-- Navigation tabs --}}
        <div style="display:flex; gap:.5rem;">
            @foreach(['general'=>'General','contact'=>'Contact','social'=>'Social','seo'=>'SEO','homepage'=>'Homepage'] as $key=>$lbl)
            <button @click="tab='{{ $key }}'" :class="tab==='{{ $key }}' ? 'active' : ''" class="portfolio-filter-btn" style="padding:.35rem 1rem; font-size:.8125rem;" id="settings-tab-{{ $key }}-btn">
                {{ $lbl }}
            </button>
            @endforeach
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ===== GENERAL TAB ===== --}}
        <div x-show="tab==='general'" style="display:flex; flex-direction:column; gap:1.25rem;">
            <div class="form-group">
                <label for="site_name">Site Name</label>
                <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name']->value ?? '') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="site_tagline">Tagline / Motto</label>
                <input type="text" id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']->value ?? '') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="site_description">Site Description</label>
                <textarea id="site_description" name="site_description" rows="3" class="form-control">{{ old('site_description', $settings['site_description']->value ?? '') }}</textarea>
            </div>
        </div>

        {{-- ===== CONTACT TAB ===== --}}
        <div x-show="tab==='contact'" style="display:flex; flex-direction:column; gap:1.25rem;">
            <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="contact_phone">Contact Phone</label>
                    <input type="text" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="whatsapp_number">WhatsApp Number</label>
                    <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="contact_email">Contact Email</label>
                    <input type="email" id="contact_email" name="contact_email" value="{{ old('contact_email', $settings['contact_email']->value ?? '') }}" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="contact_address">Office Address</label>
                <input type="text" id="contact_address" name="contact_address" value="{{ old('contact_address', $settings['contact_address']->value ?? '') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="contact_address_2">Secondary Office Address</label>
                <input type="text" id="contact_address_2" name="contact_address_2" value="{{ old('contact_address_2', $settings['contact_address_2']->value ?? '') }}" class="form-control" placeholder="e.g. Branch office, road name etc. (optional)">
            </div>
            <div class="form-group">
                <label for="contact_hours">Business Hours</label>
                <input type="text" id="contact_hours" name="contact_hours" value="{{ old('contact_hours', $settings['contact_hours']->value ?? '') }}" class="form-control">
            </div>
        </div>

        {{-- ===== SOCIAL TAB ===== --}}
        <div x-show="tab==='social'" style="display:flex; flex-direction:column; gap:1.25rem;">
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="facebook_url">Facebook URL</label>
                    <input type="url" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="linkedin_url">LinkedIn URL</label>
                    <input type="url" id="linkedin_url" name="linkedin_url" value="{{ old('linkedin_url', $settings['linkedin_url']->value ?? '') }}" class="form-control">
                </div>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="github_url">GitHub URL</label>
                    <input type="url" id="github_url" name="github_url" value="{{ old('github_url', $settings['github_url']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="twitter_url">Twitter URL</label>
                    <input type="url" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $settings['twitter_url']->value ?? '') }}" class="form-control">
                </div>
            </div>
        </div>

        {{-- ===== SEO TAB ===== --}}
        <div x-show="tab==='seo'" style="display:flex; flex-direction:column; gap:1.25rem;">
            <div class="form-group">
                <label for="meta_title">Default Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $settings['meta_title']->value ?? '') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="meta_description">Default Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" class="form-control">{{ old('meta_description', $settings['meta_description']->value ?? '') }}</textarea>
            </div>
            <div style="display:grid; grid-template-columns: 1fr 1fr; gap:1rem;">
                <div class="form-group">
                    <label for="google_analytics_id">Google Analytics ID</label>
                    <input type="text" id="google_analytics_id" name="google_analytics_id" value="{{ old('google_analytics_id', $settings['google_analytics_id']->value ?? '') }}" class="form-control" placeholder="G-XXXXXXXXXX">
                </div>
                <div class="form-group">
                    <label for="meta_pixel_id">Meta Pixel ID</label>
                    <input type="text" id="meta_pixel_id" name="meta_pixel_id" value="{{ old('meta_pixel_id', $settings['meta_pixel_id']->value ?? '') }}" class="form-control" placeholder="XXXXXXXXXXXXXXX">
                </div>
            </div>
        </div>

        {{-- ===== HOMEPAGE TAB ===== --}}
        <div x-show="tab==='homepage'" style="display:flex; flex-direction:column; gap:1.25rem;">
            <div class="form-group">
                <label for="hero_title">Hero Banner Title</label>
                <input type="text" id="hero_title" name="hero_title" value="{{ old('hero_title', $settings['hero_title']->value ?? '') }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="hero_subtitle">Hero Subtitle</label>
                <textarea id="hero_subtitle" name="hero_subtitle" rows="2" class="form-control">{{ old('hero_subtitle', $settings['hero_subtitle']->value ?? '') }}</textarea>
            </div>
            <div class="form-group">
                <label for="hero_badge_text">Hero Badge Text</label>
                <input type="text" id="hero_badge_text" name="hero_badge_text" value="{{ old('hero_badge_text', $settings['hero_badge_text']->value ?? '') }}" class="form-control">
            </div>

            <div style="display:grid; grid-template-columns: repeat(4, 1fr); gap:1rem;">
                <div class="form-group">
                    <label for="stats_projects">Stats: Projects</label>
                    <input type="text" id="stats_projects" name="stats_projects" value="{{ old('stats_projects', $settings['stats_projects']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="stats_clients">Stats: Clients</label>
                    <input type="text" id="stats_clients" name="stats_clients" value="{{ old('stats_clients', $settings['stats_clients']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="stats_team">Stats: Team</label>
                    <input type="text" id="stats_team" name="stats_team" value="{{ old('stats_team', $settings['stats_team']->value ?? '') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="stats_years">Stats: Years</label>
                    <input type="text" id="stats_years" name="stats_years" value="{{ old('stats_years', $settings['stats_years']->value ?? '') }}" class="form-control">
                </div>
            </div>
        </div>

        {{-- Form Submit --}}
        <div style="display:flex; justify-content:flex-end; border-top:1px solid #E2E8F0; padding-top:1.25rem; margin-top:2rem;">
            <button type="submit" class="btn btn-primary" id="save-settings-btn">
                <i class="fas fa-save"></i> Save Settings
            </button>
        </div>

    </form>
</div>

@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush
