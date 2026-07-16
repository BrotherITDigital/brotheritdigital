<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            [
                'name'     => 'MD. Rafiqul Rahman',
                'position' => 'Full Stack Developer & Team Lead',
                'bio'      => 'Experienced full stack developer with expertise in Laravel, Vue.js, and cloud architecture. Leads the development team with a focus on clean code and scalable solutions.',
                'skills'   => ['Laravel', 'PHP', 'Vue.js', 'MySQL', 'Docker', 'AWS'],
                'social_links' => ['github' => 'https://github.com', 'linkedin' => 'https://linkedin.com'],
                'order'    => 1,
            ],
            [
                'name'     => 'Sarah Ahmed',
                'position' => 'UI/UX Designer',
                'bio'      => 'Creative UI/UX designer passionate about crafting beautiful, intuitive interfaces. Specializes in user research, wireframing, and creating cohesive design systems.',
                'skills'   => ['Figma', 'Adobe XD', 'Tailwind CSS', 'Illustrator', 'Prototyping'],
                'social_links' => ['linkedin' => 'https://linkedin.com', 'twitter' => 'https://twitter.com'],
                'order'    => 2,
            ],
            [
                'name'     => 'Karim Hassan',
                'position' => 'Mobile App Developer',
                'bio'      => 'Mobile app specialist with hands-on experience building cross-platform apps using Flutter and React Native. Passionate about performance and native-feel user experiences.',
                'skills'   => ['Flutter', 'React Native', 'Firebase', 'Dart', 'iOS', 'Android'],
                'social_links' => ['github' => 'https://github.com', 'linkedin' => 'https://linkedin.com'],
                'order'    => 3,
            ],
            [
                'name'     => 'Nadia Islam',
                'position' => 'Backend Developer',
                'bio'      => 'Backend architect specializing in building robust APIs and database design. Expert in performance optimization, security hardening, and microservices architecture.',
                'skills'   => ['PHP', 'Laravel', 'PostgreSQL', 'Redis', 'REST API', 'Linux'],
                'social_links' => ['github' => 'https://github.com', 'linkedin' => 'https://linkedin.com'],
                'order'    => 4,
            ],
            [
                'name'     => 'Rafiq Uddin',
                'position' => 'DevOps & SEO Engineer',
                'bio'      => 'DevOps engineer and SEO specialist who ensures our products are deployed reliably, perform at scale, and rank high in search engines.',
                'skills'   => ['AWS', 'Docker', 'CI/CD', 'Git', 'SEO', 'Google Analytics'],
                'social_links' => ['github' => 'https://github.com', 'linkedin' => 'https://linkedin.com'],
                'order'    => 5,
            ],
        ];

        foreach ($members as $member) {
            TeamMember::updateOrCreate(['name' => $member['name']], $member);
        }
    }
}
