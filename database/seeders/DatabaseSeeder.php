<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SiteSettingSeeder::class,
            ServiceSeeder::class,
            PortfolioSeeder::class,
            TeamSeeder::class,
            TestimonialSeeder::class,
            FaqSeeder::class,
            BlogCategorySeeder::class,
            ClientSeeder::class,
            PortfolioCategorySeeder::class,
        ]);
    }
}
