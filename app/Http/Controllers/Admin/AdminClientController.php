<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('order')->paginate(15);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|max:1024',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('uploads/clients', 'public');
        }

        Client::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully!');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'logo'        => 'nullable|image|max:1024',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
        ]);

        $data['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($client->logo) {
                Storage::disk('public')->delete($client->logo);
            }
            $data['logo'] = $request->file('logo')->store('uploads/clients', 'public');
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully!');
    }

    public function destroy(Client $client)
    {
        if ($client->logo) {
            Storage::disk('public')->delete($client->logo);
        }
        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully!');
    }
}
