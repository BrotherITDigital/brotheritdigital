<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::orderBy('order')->paginate(12);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'company'     => 'nullable|string|max:255',
            'position'    => 'nullable|string|max:255',
            'photo'       => 'nullable|image|max:1024',
            'rating'      => 'required|integer|min:1|max:5',
            'review'      => 'required|string',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('uploads/testimonials', 'public');
        }

        Testimonial::create($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial added!');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'client_name' => 'required|string|max:255',
            'company'     => 'nullable|string|max:255',
            'position'    => 'nullable|string|max:255',
            'photo'       => 'nullable|image|max:1024',
            'rating'      => 'required|integer|min:1|max:5',
            'review'      => 'required|string',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');

        if ($request->hasFile('photo')) {
            if ($testimonial->photo) Storage::disk('public')->delete($testimonial->photo);
            $data['photo'] = $request->file('photo')->store('uploads/testimonials', 'public');
        }

        $testimonial->update($data);
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated!');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->photo) Storage::disk('public')->delete($testimonial->photo);
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted.');
    }
}
