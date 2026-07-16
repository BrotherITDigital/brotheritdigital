<?php

namespace App\Http\Controllers;

use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs    = Faq::active()->get();
        $grouped = $faqs->groupBy('category');
        return view('pages.faq', compact('faqs', 'grouped'));
    }
}
