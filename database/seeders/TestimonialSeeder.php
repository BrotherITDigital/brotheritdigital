<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Ahmed Kabir',
                'company'     => 'MediCare Hospital Group',
                'position'    => 'CEO',
                'rating'      => 5,
                'review'      => 'Brother IT Digital delivered our hospital management system on time and exceeded our expectations. The platform is intuitive, secure, and has significantly improved our operational efficiency. Highly recommended!',
                'is_featured' => true,
                'order'       => 1,
            ],
            [
                'client_name' => 'Fatima Al-Hassan',
                'company'     => 'ShopEase Ltd.',
                'position'    => 'Founder & CTO',
                'rating'      => 5,
                'review'      => 'The e-commerce platform they built for us handles thousands of transactions daily without any issues. The team was professional, communicative, and the code quality is exceptional. We\'ve seen a 40% increase in sales!',
                'is_featured' => true,
                'order'       => 2,
            ],
            [
                'client_name' => 'James Okonkwo',
                'company'     => 'EduLearn Academy',
                'position'    => 'Director of Technology',
                'rating'      => 5,
                'review'      => 'Our Flutter app is beautiful and performs flawlessly on both iOS and Android. The Brother IT team understood our educational goals and translated them into an engaging learning experience. Our students love it!',
                'is_featured' => true,
                'order'       => 3,
            ],
            [
                'client_name' => 'Priya Sharma',
                'company'     => 'TravelNest Tours',
                'position'    => 'Managing Director',
                'rating'      => 5,
                'review'      => 'From design to deployment, the Brother IT team was a pleasure to work with. Our travel booking platform has tripled our online bookings. The SEO work they did has pushed us to the first page of Google!',
                'is_featured' => true,
                'order'       => 4,
            ],
            [
                'client_name' => 'Robert Chen',
                'company'     => 'FoodFly Delivery Co.',
                'position'    => 'Product Manager',
                'rating'      => 4,
                'review'      => 'The food delivery app they built is robust and user-friendly. Real-time tracking and the multi-restaurant support work perfectly. The team was very responsive to change requests and delivered quality work.',
                'is_featured' => false,
                'order'       => 5,
            ],
            [
                'client_name' => 'Miriam Osei',
                'company'     => 'ProRecruite Agency',
                'position'    => 'Operations Head',
                'rating'      => 5,
                'review'      => 'Our recruitment platform is a game-changer. The applicant tracking system and employer dashboard have automated 70% of our manual processes. Brother IT Digital truly understands business requirements.',
                'is_featured' => false,
                'order'       => 6,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['client_name' => $t['client_name'], 'company' => $t['company']],
                array_merge($t, ['is_active' => true])
            );
        }
    }
}
