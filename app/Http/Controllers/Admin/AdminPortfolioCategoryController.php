<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PortfolioCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::withCount('portfolios')->orderBy('name')->paginate(15);
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name',
        ]);

        $data['slug'] = Str::slug($data['name']);

        PortfolioCategory::create($data);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Category created successfully!');
    }

    public function edit(PortfolioCategory $portfolio_category)
    {
        return view('admin.portfolio-categories.edit', ['category' => $portfolio_category]);
    }

    public function update(Request $request, PortfolioCategory $portfolio_category)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:portfolio_categories,name,' . $portfolio_category->id,
        ]);

        $data['slug'] = Str::slug($data['name']);

        $portfolio_category->update($data);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy(PortfolioCategory $portfolio_category)
    {
        if ($portfolio_category->portfolios()->count() > 0) {
            return redirect()->route('admin.portfolio-categories.index')->with('error', 'Cannot delete category. There are projects associated with it.');
        }

        $portfolio_category->delete();

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Category deleted successfully!');
    }
}
