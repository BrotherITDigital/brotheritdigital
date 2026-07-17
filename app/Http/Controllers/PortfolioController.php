<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::active()->get();
        $categories = \App\Models\PortfolioCategory::whereHas('portfolios', function($q) {
            $q->where('is_active', true);
        })->get();
        return view('pages.portfolio.index', compact('portfolios', 'categories'));
    }

    public function show(string $slug)
    {
        $portfolio = Portfolio::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related   = Portfolio::where('category', $portfolio->category)
            ->where('id', '!=', $portfolio->id)
            ->where('is_active', true)
            ->take(3)->get();
        return view('pages.portfolio.show', compact('portfolio', 'related'));
    }
}
