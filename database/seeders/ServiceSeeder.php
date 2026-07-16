<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            // ===== WEBSITE DEVELOPMENT =====
            ['category'=>'website','icon'=>'fas fa-building','title'=>'Corporate Website',        'short_description'=>'Professional corporate websites that establish credibility and showcase your brand. Built with modern design principles and optimized for performance.','is_featured'=>true],
            ['category'=>'website','icon'=>'fas fa-briefcase','title'=>'Business Website',         'short_description'=>'Custom business websites designed to convert visitors into customers. Feature-rich, SEO-optimized, and mobile-friendly solutions.','is_featured'=>true],
            ['category'=>'website','icon'=>'fas fa-user-tie','title'=>'Portfolio Website',         'short_description'=>'Stunning portfolio websites to showcase your work, skills, and achievements. Perfect for freelancers, designers, and creative professionals.','is_featured'=>true],
            ['category'=>'website','icon'=>'fas fa-users','title'=>'Recruitment Agency Website',   'short_description'=>'Specialized recruitment platforms with job listing management, candidate applications, and employer dashboards for staffing agencies.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-newspaper','title'=>'News Portal',              'short_description'=>'Full-featured news portals with category management, breaking news alerts, search functionality, and advertising integration.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-shopping-cart','title'=>'E-commerce Website',   'short_description'=>'Complete e-commerce solutions with product management, secure payments, inventory tracking, and order management systems.','is_featured'=>true],
            ['category'=>'website','icon'=>'fas fa-graduation-cap','title'=>'School & College Website','short_description'=>'Educational institution websites with admission management, notice boards, faculty profiles, and event calendars.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-heart','title'=>'NGO Website',                  'short_description'=>'Impactful NGO websites with donation management, volunteer registration, project showcases, and impact reporting features.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-hospital','title'=>'Hospital Website',           'short_description'=>'Healthcare websites with appointment booking, doctor profiles, department listings, and patient information management.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-utensils','title'=>'Hotel & Restaurant Website', 'short_description'=>'Elegant hospitality websites with menu management, online reservations, gallery showcases, and review integration.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-home','title'=>'Real Estate Website',            'short_description'=>'Property listing platforms with advanced search, virtual tours, agent profiles, and mortgage calculator integration.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-plane','title'=>'Travel Agency Website',         'short_description'=>'Feature-rich travel websites with tour packages, booking management, destination guides, and itinerary planners.','is_featured'=>false],
            ['category'=>'website','icon'=>'fas fa-cogs','title'=>'Custom Web Application',         'short_description'=>'Tailored web applications built to solve your unique business challenges with scalable architecture and modern technologies.','is_featured'=>true],

            // ===== MOBILE APP DEVELOPMENT =====
            ['category'=>'mobile','icon'=>'fab fa-android','title'=>'Android Apps',                'short_description'=>'Native Android applications built with Kotlin and Java, delivering smooth performance and excellent user experience across all Android devices.','is_featured'=>true],
            ['category'=>'mobile','icon'=>'fab fa-apple','title'=>'iOS Apps',                       'short_description'=>'Premium iOS applications for iPhone and iPad, built with Swift and SwiftUI to Apple\'s strict quality standards.','is_featured'=>true],
            ['category'=>'mobile','icon'=>'fas fa-mobile-alt','title'=>'Cross-platform Apps',       'short_description'=>'Flutter and React Native apps that run beautifully on both iOS and Android, reducing development time and cost significantly.','is_featured'=>true],
            ['category'=>'mobile','icon'=>'fas fa-chart-line','title'=>'Business Apps',             'short_description'=>'Enterprise mobile applications that streamline operations, improve productivity, and provide real-time business insights on the go.','is_featured'=>false],
            ['category'=>'mobile','icon'=>'fas fa-calendar-check','title'=>'Booking Apps',          'short_description'=>'Smart booking and scheduling applications for services, events, appointments, and reservations with payment integration.','is_featured'=>false],
            ['category'=>'mobile','icon'=>'fas fa-shopping-bag','title'=>'E-commerce Apps',         'short_description'=>'Powerful mobile shopping apps with product catalogs, secure checkout, order tracking, and personalized recommendations.','is_featured'=>false],
            ['category'=>'mobile','icon'=>'fas fa-book-open','title'=>'Educational Apps',           'short_description'=>'Interactive learning applications with courses, quizzes, progress tracking, and gamification to boost student engagement.','is_featured'=>false],
            ['category'=>'mobile','icon'=>'fas fa-heartbeat','title'=>'Healthcare Apps',            'short_description'=>'HIPAA-compliant healthcare apps for patient management, telemedicine, health tracking, and appointment scheduling.','is_featured'=>false],

            // ===== UI/UX DESIGN =====
            ['category'=>'uiux','icon'=>'fas fa-paint-brush','title'=>'User Interface Design',     'short_description'=>'Visually stunning UI designs that captivate users. We create pixel-perfect interfaces with consistent design systems and modern aesthetics.','is_featured'=>true],
            ['category'=>'uiux','icon'=>'fas fa-users-cog','title'=>'User Experience Design',      'short_description'=>'Research-driven UX design that maps the complete user journey, eliminating friction and creating intuitive, delightful experiences.','is_featured'=>true],
            ['category'=>'uiux','icon'=>'fas fa-draw-polygon','title'=>'Wireframing',              'short_description'=>'Detailed wireframes that define information architecture, user flows, and interface layouts before development begins.','is_featured'=>false],
            ['category'=>'uiux','icon'=>'fas fa-object-group','title'=>'Prototyping',              'short_description'=>'Interactive prototypes that let you experience your product before it\'s built, enabling early feedback and iteration.','is_featured'=>false],
            ['category'=>'uiux','icon'=>'fas fa-th-large','title'=>'Dashboard Design',             'short_description'=>'Data-rich dashboard designs that present complex information clearly with intuitive controls and meaningful visualizations.','is_featured'=>false],

            // ===== DIGITAL SERVICES =====
            ['category'=>'digital','icon'=>'fas fa-wrench','title'=>'Website Maintenance',         'short_description'=>'Comprehensive website maintenance packages keeping your site updated, secure, and running at peak performance 24/7.','is_featured'=>false],
            ['category'=>'digital','icon'=>'fas fa-tachometer-alt','title'=>'Website Speed Optimization','short_description'=>'Performance optimization that dramatically improves load times, Core Web Vitals scores, and overall user experience.','is_featured'=>false],
            ['category'=>'digital','icon'=>'fas fa-shield-alt','title'=>'Website Security',        'short_description'=>'Multi-layer security hardening including SSL, firewall setup, malware scanning, and vulnerability patching to protect your site.','is_featured'=>false],
            ['category'=>'digital','icon'=>'fas fa-search','title'=>'SEO Optimization',            'short_description'=>'Data-driven SEO strategies that improve search rankings, drive organic traffic, and increase conversions for your business.','is_featured'=>true],
            ['category'=>'digital','icon'=>'fas fa-server','title'=>'Domain & Hosting Support',    'short_description'=>'Expert domain registration, hosting setup, configuration, and management ensuring maximum uptime and reliability.','is_featured'=>false],
            ['category'=>'digital','icon'=>'fas fa-plug','title'=>'API Integration',               'short_description'=>'Seamless third-party API integrations including payment gateways, social platforms, CRMs, and business tools.','is_featured'=>false],
        ];

        foreach ($services as $i => $service) {
            Service::updateOrCreate(
                ['slug' => Str::slug($service['title'])],
                array_merge($service, [
                    'slug'              => Str::slug($service['title']),
                    'description'       => $service['short_description'] . ' Our team of experts brings years of experience to deliver solutions that exceed your expectations.',
                    'is_active'         => true,
                    'order'             => $i,
                ])
            );
        }
    }
}
