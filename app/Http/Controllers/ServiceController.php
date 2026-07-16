<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->get();
        $grouped  = $services->groupBy('category');
        return view('pages.services.index', compact('services', 'grouped'));
    }

    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', true)->firstOrFail();
        $related = Service::where('category', $service->category)
            ->where('id', '!=', $service->id)
            ->where('is_active', true)
            ->take(4)->get();
        return view('pages.services.show', compact('service', 'related'));
    }
}
