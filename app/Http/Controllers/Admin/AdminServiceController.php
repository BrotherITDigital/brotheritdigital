<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order')->paginate(15);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'icon'              => 'required|string|max:100',
            'category'          => 'required|in:website,mobile,uiux,digital',
            'short_description' => 'required|string|max:500',
            'description'       => 'nullable|string',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'integer|min:0',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
        ]);

        $data['slug']        = Str::slug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');

        Service::create($data);
        return redirect()->route('admin.services.index')->with('success', 'Service created successfully!');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'             => 'required|string|max:255',
            'icon'              => 'required|string|max:100',
            'category'          => 'required|in:website,mobile,uiux,digital',
            'short_description' => 'required|string|max:500',
            'description'       => 'nullable|string',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'order'             => 'integer|min:0',
            'meta_title'        => 'nullable|string|max:255',
            'meta_description'  => 'nullable|string|max:500',
        ]);

        $data['slug']        = Str::slug($data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active');

        $service->update($data);
        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully!');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted.');
    }
}
