<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // General
            ['key'=>'site_name',        'value'=>'Brother IT Digital PLC', 'type'=>'text',    'group'=>'general', 'label'=>'Site Name'],
            ['key'=>'site_tagline',     'value'=>'Building Digital Solutions for the Future.','type'=>'text','group'=>'general','label'=>'Tagline'],
            ['key'=>'site_description', 'value'=>'Brother IT Digital PLC is a professional software development company specializing in modern web development and mobile application solutions.','type'=>'textarea','group'=>'general','label'=>'Site Description'],
            ['key'=>'site_logo',        'value'=>'', 'type'=>'image',   'group'=>'general', 'label'=>'Site Logo'],
            ['key'=>'site_favicon',     'value'=>'', 'type'=>'image',   'group'=>'general', 'label'=>'Favicon'],

            // Contact
            ['key'=>'contact_phone',    'value'=>'+88016-09113112', 'type'=>'text',  'group'=>'contact', 'label'=>'Phone Number'],
            ['key'=>'whatsapp_number',   'value'=>'+88016-09113112', 'type'=>'text',  'group'=>'contact', 'label'=>'WhatsApp Number'],
            ['key'=>'contact_email',    'value'=>'brotheritdigital@gmail.com','type'=>'text','group'=>'contact','label'=>'Email Address'],
            ['key'=>'contact_address',  'value'=>'Dhaka, Bangladesh',  'type'=>'text', 'group'=>'contact', 'label'=>'Office Address'],
            ['key'=>'contact_address_2','value'=>'',  'type'=>'text', 'group'=>'contact', 'label'=>'Secondary Office Address'],
            ['key'=>'contact_hours',    'value'=>'Mon–Sat, 9am–6pm',   'type'=>'text', 'group'=>'contact', 'label'=>'Business Hours'],

            // Social
            ['key'=>'facebook_url',  'value'=>'https://facebook.com',  'type'=>'text','group'=>'social','label'=>'Facebook URL'],
            ['key'=>'linkedin_url',  'value'=>'https://linkedin.com',  'type'=>'text','group'=>'social','label'=>'LinkedIn URL'],
            ['key'=>'github_url',    'value'=>'https://github.com',    'type'=>'text','group'=>'social','label'=>'GitHub URL'],
            ['key'=>'twitter_url',   'value'=>'https://twitter.com',   'type'=>'text','group'=>'social','label'=>'Twitter URL'],

            // SEO
            ['key'=>'meta_title',         'value'=>'Brother IT Digital PLC – Building Digital Solutions','type'=>'text',    'group'=>'seo','label'=>'Default Meta Title'],
            ['key'=>'meta_description',   'value'=>'Brother IT Digital PLC is a professional software development company specializing in modern websites, web applications, and mobile app development.','type'=>'textarea','group'=>'seo','label'=>'Default Meta Description'],
            ['key'=>'google_analytics_id','value'=>'',                  'type'=>'text','group'=>'seo','label'=>'Google Analytics ID'],
            ['key'=>'meta_pixel_id',      'value'=>'',                  'type'=>'text','group'=>'seo','label'=>'Meta Pixel ID'],

            // Homepage
            ['key'=>'hero_title',      'value'=>'Building Digital Solutions for the Future','type'=>'text',    'group'=>'homepage','label'=>'Hero Title'],
            ['key'=>'hero_subtitle',   'value'=>'We craft modern websites, powerful web applications, and stunning mobile apps that help businesses grow digitally.','type'=>'textarea','group'=>'homepage','label'=>'Hero Subtitle'],
            ['key'=>'hero_badge_text', 'value'=>'Available for New Projects',  'type'=>'text','group'=>'homepage','label'=>'Hero Badge Text'],
            ['key'=>'stats_projects',  'value'=>'50',                          'type'=>'text','group'=>'homepage','label'=>'Stats: Projects Completed'],
            ['key'=>'stats_clients',   'value'=>'30',                          'type'=>'text','group'=>'homepage','label'=>'Stats: Clients Served'],
            ['key'=>'stats_team',      'value'=>'5',                           'type'=>'text','group'=>'homepage','label'=>'Stats: Team Members'],
            ['key'=>'stats_years',     'value'=>'3',                           'type'=>'text','group'=>'homepage','label'=>'Stats: Years Experience'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }
}
