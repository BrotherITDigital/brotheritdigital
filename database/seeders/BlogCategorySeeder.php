<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name'=>'Web Development',  'description'=>'Articles about web development technologies, frameworks, and best practices.'],
            ['name'=>'Mobile Apps',      'description'=>'Insights on mobile app development, design patterns, and industry trends.'],
            ['name'=>'UI/UX Design',     'description'=>'Design principles, case studies, and tips for creating exceptional user experiences.'],
            ['name'=>'Tech News',        'description'=>'Latest news and updates from the technology and software development world.'],
            ['name'=>'Tutorials',        'description'=>'Step-by-step guides and tutorials to help you learn modern web technologies.'],
        ];

        foreach ($categories as $cat) {
            BlogCategory::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                array_merge($cat, ['slug' => Str::slug($cat['name']), 'is_active' => true])
            );
        }
    }
}
