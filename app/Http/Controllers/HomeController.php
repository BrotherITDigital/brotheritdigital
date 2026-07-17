<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Client;

class HomeController extends Controller
{
    public function index()
    {
        $services     = Service::active()->where('is_featured', true)->take(6)->get();
        $portfolios   = Portfolio::active()->where('is_featured', true)->take(8)->get();
        $testimonials = Testimonial::active()->take(6)->get();
        $faqs         = Faq::active()->take(8)->get();
        $clients      = Client::active()->orderBy('order')->get();
        
        $categories = \App\Models\PortfolioCategory::whereHas('portfolios', function($q) {
            $q->where('is_active', true)->where('is_featured', true);
        })->get();

        return view('pages.home', compact('services', 'portfolios', 'testimonials', 'faqs', 'clients', 'categories'));
    }
}
