<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name'        => 'MediCare Hospital Group',
                'website_url' => 'https://example.com',
                'description' => 'A leading healthcare provider with multiple medical centers.',
                'order'       => 1,
            ],
            [
                'name'        => 'ShopEase E-commerce Ltd.',
                'website_url' => 'https://example.com',
                'description' => 'An international retail and delivery marketplace.',
                'order'       => 2,
            ],
            [
                'name'        => 'EduLearn Academy',
                'website_url' => 'https://example.com',
                'description' => 'A professional distance education and course platform.',
                'order'       => 3,
            ],
            [
                'name'        => 'TravelNest Tours',
                'website_url' => 'https://example.com',
                'description' => 'A luxury travel agency and destination tour guide provider.',
                'order'       => 4,
            ],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['name' => $client['name']],
                array_merge($client, ['is_active' => true])
            );
        }
    }
}
