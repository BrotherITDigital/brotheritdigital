<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title'             => 'MediCare Hospital Management System',
                'category'          => 'website',
                'short_description' => 'A comprehensive hospital management platform with appointment booking, patient records, and doctor scheduling.',
                'description'       => 'A full-featured hospital management system built with Laravel 12 and Livewire. Features include patient registration, appointment scheduling, electronic medical records, billing, pharmacy management, and detailed reporting dashboards.',
                'technologies'      => ['Laravel', 'Livewire', 'MySQL', 'Tailwind CSS', 'Alpine.js'],
                'client'            => 'MediCare Hospital Group',
                'completed_at'      => '2024-03-15',
                'is_featured'       => true,
            ],
            [
                'title'             => 'ShopEase E-commerce Platform',
                'category'          => 'website',
                'short_description' => 'A modern multi-vendor e-commerce platform with advanced product management and payment gateway integration.',
                'description'       => 'Multi-vendor e-commerce platform supporting thousands of products. Includes Stripe/PayPal integration, inventory management, order tracking, seller dashboard, and customer analytics.',
                'technologies'      => ['Laravel', 'Vue.js', 'MySQL', 'Redis', 'Stripe API'],
                'client'            => 'ShopEase Ltd.',
                'completed_at'      => '2024-06-20',
                'is_featured'       => true,
            ],
            [
                'title'             => 'EduLearn Mobile Learning App',
                'category'          => 'mobile',
                'short_description' => 'A cross-platform educational app with video courses, quizzes, certificates, and progress tracking.',
                'description'       => 'Interactive mobile learning platform built with Flutter. Students can browse courses, watch video lessons, take assessments, earn certificates, and track their learning progress with detailed analytics.',
                'technologies'      => ['Flutter', 'Firebase', 'Dart', 'REST API', 'Node.js'],
                'client'            => 'EduLearn Academy',
                'completed_at'      => '2024-09-10',
                'is_featured'       => true,
            ],
            [
                'title'             => 'TravelNest Booking Platform',
                'category'          => 'website',
                'short_description' => 'A travel agency website with package management, tour bookings, and real-time availability checking.',
                'description'       => 'Complete travel booking platform with holiday packages, hotel reservations, flight searches, and itinerary management. Features a beautiful frontend and a powerful admin dashboard for tour operators.',
                'technologies'      => ['Laravel', 'Tailwind CSS', 'Alpine.js', 'MySQL', 'PayPal'],
                'client'            => 'TravelNest Tours',
                'completed_at'      => '2024-11-05',
                'is_featured'       => true,
            ],
            [
                'title'             => 'FoodFly Restaurant App',
                'category'          => 'mobile',
                'short_description' => 'A food ordering and delivery app with real-time tracking, multiple payment options, and restaurant management.',
                'description'       => 'On-demand food delivery app for iOS and Android. Features real-time GPS order tracking, multiple restaurant support, loyalty rewards, push notifications, and a comprehensive restaurant management system.',
                'technologies'      => ['React Native', 'Firebase', 'Node.js', 'Stripe', 'Google Maps API'],
                'client'            => 'FoodFly Delivery Co.',
                'completed_at'      => '2025-01-18',
                'is_featured'       => true,
            ],
            [
                'title'             => 'ProRecruite HR Platform',
                'category'          => 'website',
                'short_description' => 'A recruitment agency platform with job postings, applicant tracking, CV management, and employer dashboards.',
                'description'       => 'End-to-end recruitment platform with ATS (Applicant Tracking System), job board, CV builder, interview scheduling, skill assessments, and analytics for both employers and job seekers.',
                'technologies'      => ['Laravel', 'Livewire', 'MySQL', 'Tailwind CSS', 'PDF Generation'],
                'client'            => 'ProRecruite Agency',
                'completed_at'      => '2025-03-22',
                'is_featured'       => true,
            ],
        ];

        foreach ($projects as $project) {
            Portfolio::updateOrCreate(
                ['slug' => Str::slug($project['title'])],
                array_merge($project, [
                    'slug'      => Str::slug($project['title']),
                    'is_active' => true,
                    'order'     => 0,
                ])
            );
        }
    }
}
