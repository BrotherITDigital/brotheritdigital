<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminPortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::orderBy('order')->paginate(12);
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        return view('admin.portfolios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|in:website,mobile,uiux,wordpress_landing,custom_code_landing',
            'short_description' => 'required|string|max:500',
            'description'       => 'nullable|string',
            'technologies'      => 'nullable|string',
            'live_url'          => 'nullable|url|max:255',
            'github_url'        => 'nullable|url|max:255',
            'client'            => 'nullable|string|max:255',
            'completed_at'      => 'nullable|date',
            'thumbnail'         => 'nullable|image|max:2048',
            'pdf_file'          => 'nullable|file|mimes:pdf|max:10240',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'integer|min:0',
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['technologies'] = $request->technologies
            ? array_map('trim', explode(',', $request->technologies)) : [];
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_active']    = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/portfolios', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            $data['pdf_file'] = $request->file('pdf_file')->store('uploads/portfolios/pdfs', 'public');
        }

        Portfolio::create($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio created successfully!');
    }

    public function edit(Portfolio $portfolio)
    {
        return view('admin.portfolios.edit', compact('portfolio'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'category'          => 'required|in:website,mobile,uiux,wordpress_landing,custom_code_landing',
            'short_description' => 'required|string|max:500',
            'description'       => 'nullable|string',
            'technologies'      => 'nullable|string',
            'live_url'          => 'nullable|url|max:255',
            'github_url'        => 'nullable|url|max:255',
            'client'            => 'nullable|string|max:255',
            'completed_at'      => 'nullable|date',
            'thumbnail'         => 'nullable|image|max:2048',
            'pdf_file'          => 'nullable|file|mimes:pdf|max:10240',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'integer|min:0',
        ]);

        $data['slug']         = Str::slug($data['title']);
        $data['technologies'] = $request->technologies
            ? array_map('trim', explode(',', $request->technologies)) : [];
        $data['is_featured']  = $request->boolean('is_featured');
        $data['is_active']    = $request->boolean('is_active');

        if ($request->hasFile('thumbnail')) {
            if ($portfolio->thumbnail) Storage::disk('public')->delete($portfolio->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('uploads/portfolios', 'public');
        }

        if ($request->hasFile('pdf_file')) {
            if ($portfolio->pdf_file) Storage::disk('public')->delete($portfolio->pdf_file);
            $data['pdf_file'] = $request->file('pdf_file')->store('uploads/portfolios/pdfs', 'public');
        }

        $portfolio->update($data);
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio updated successfully!');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->thumbnail) Storage::disk('public')->delete($portfolio->thumbnail);
        if ($portfolio->pdf_file) Storage::disk('public')->delete($portfolio->pdf_file);
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio deleted.');
    }
}
