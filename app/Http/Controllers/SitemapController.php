<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Portfolio;
use App\Models\BlogPost;

class SitemapController extends Controller
{
    public function index()
    {
        $services   = Service::active()->get();
        $portfolios = Portfolio::active()->get();
        $posts      = BlogPost::published()->get();

        $content = view('sitemap', compact('services', 'portfolios', 'posts'));
        return response($content, 200, ['Content-Type' => 'application/xml']);
    }
}
