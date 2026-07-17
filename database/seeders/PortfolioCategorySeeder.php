<?php

namespace Database\Seeders;

use App\Models\PortfolioCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PortfolioCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Website',
            'Mobile App',
            'UI/UX Design',
            'WordPress Landing Page',
            'Custom Code Landing Page'
        ];

        foreach ($categories as $category) {
            PortfolioCategory::updateOrCreate(
                ['slug' => Str::slug($category)],
                ['name' => $category]
            );
        }
    }
}
