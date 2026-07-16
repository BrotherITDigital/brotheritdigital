<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class AdminFaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('order')->paginate(15);
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'category'  => 'required|string|max:100',
            'is_active' => 'boolean',
            'order'     => 'integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        Faq::create($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ created!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'question'  => 'required|string',
            'answer'    => 'required|string',
            'category'  => 'required|string|max:100',
            'is_active' => 'boolean',
            'order'     => 'integer|min:0',
        ]);
        $data['is_active'] = $request->boolean('is_active');
        $faq->update($data);
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ updated!');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')->with('success', 'FAQ deleted.');
    }
}
