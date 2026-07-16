<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question'=>'What technologies do you use for web development?','answer'=>'We specialize in Laravel 12 (PHP 8.3) for backend, with Blade, Livewire, and Alpine.js for the frontend. We use Tailwind CSS for styling, MySQL for databases, and deploy to cloud platforms like AWS and DigitalOcean. All our projects are built with modern, industry-standard technologies ensuring longevity and maintainability.','category'=>'technology','order'=>1],
            ['question'=>'How long does it take to build a website?','answer'=>'Project timelines vary based on complexity. A standard corporate website takes 2–4 weeks, an e-commerce platform takes 4–8 weeks, and a full custom web application can take 2–6 months. We always provide a detailed project timeline after our initial requirements discussion.','category'=>'timeline','order'=>2],
            ['question'=>'How much does a website or app cost?','answer'=>'Pricing depends on the scope, features, and complexity of your project. A basic corporate website starts from BDT 15,000, while e-commerce platforms typically range from BDT 35,000–80,000. Custom web applications are quoted per-project. Contact us for a free, no-obligation quote tailored to your specific needs.','category'=>'pricing','order'=>3],
            ['question'=>'Do you provide website maintenance after launch?','answer'=>'Yes! We offer comprehensive post-launch support and maintenance packages. This includes bug fixes, security updates, content updates, performance monitoring, and feature additions. Our maintenance packages start from BDT 3,000/month and can be customized to your needs.','category'=>'support','order'=>4],
            ['question'=>'Can you redesign my existing website?','answer'=>'Absolutely! We offer complete website redesign services. We\'ll analyze your current site, understand your goals, and create a modern, high-performing redesign that retains your brand identity while dramatically improving user experience and conversion rates.','category'=>'services','order'=>5],
            ['question'=>'Do you build mobile apps?','answer'=>'Yes! We develop native Android (Kotlin), iOS (Swift), and cross-platform apps using Flutter and React Native. Our mobile apps are built for performance, scalability, and excellent user experience. We handle everything from design to App Store/Play Store submission.','category'=>'services','order'=>6],
            ['question'=>'Will my website be SEO-optimized?','answer'=>'All our websites are built with SEO best practices from day one. This includes proper semantic HTML, meta tags, Open Graph, schema markup, sitemap generation, robots.txt, fast loading speeds, and mobile responsiveness. We also offer dedicated SEO optimization services for ongoing improvement.','category'=>'seo','order'=>7],
            ['question'=>'Do you offer hosting and domain services?','answer'=>'Yes, we can assist with domain registration, web hosting setup, and cloud server configuration. We work with reputable providers like Namecheap, GoDaddy, AWS, and DigitalOcean to ensure your site has maximum uptime, speed, and security.','category'=>'hosting','order'=>8],
            ['question'=>'How do I get started with my project?','answer'=>'Getting started is simple! Contact us via our contact form, email at brotheritdigital@gmail.com, or call +88016-09113112. We\'ll schedule a free consultation to discuss your requirements, suggest the best approach, and provide a detailed quote and project timeline.','category'=>'general','order'=>9],
            ['question'=>'Do you sign an NDA or contract?','answer'=>'Yes, absolutely. We sign a Non-Disclosure Agreement (NDA) before discussing sensitive project details. We also provide a formal project contract covering scope, timeline, payment terms, and intellectual property ownership to protect both parties throughout the project.','category'=>'general','order'=>10],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(['question' => $faq['question']], array_merge($faq, ['is_active' => true]));
        }
    }
}
