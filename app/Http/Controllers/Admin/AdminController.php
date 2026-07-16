<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Portfolio;
use App\Models\ContactMessage;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'servicesCount'    => Service::count(),
            'portfoliosCount'  => Portfolio::count(),
            'unreadCount'      => ContactMessage::unread()->count(),
            'blogCount'        => BlogPost::count(),
            'recentMessages'   => ContactMessage::latest()->take(5)->get(),
            'recentPortfolios' => Portfolio::latest()->take(3)->get(),
        ]);
    }

    public function media()
    {
        $files = [];
        if (Storage::disk('public')->exists('uploads')) {
            $files = collect(Storage::disk('public')->files('uploads'))
                ->map(fn($f) => [
                    'path' => $f,
                    'url'  => Storage::disk('public')->url($f),
                    'name' => basename($f),
                    'size' => Storage::disk('public')->size($f),
                ])->values()->all();
        }
        return view('admin.media', compact('files'));
    }

    public function uploadMedia(Request $request)
    {
        $request->validate(['file' => 'required|file|max:5120|mimes:jpg,jpeg,png,gif,webp,svg,pdf']);
        $path = $request->file('file')->store('uploads', 'public');
        return response()->json([
            'url'     => Storage::disk('public')->url($path),
            'path'    => $path,
            'success' => true,
        ]);
    }

    public function deleteMedia(Request $request)
    {
        Storage::disk('public')->delete($request->path);
        return back()->with('success', 'File deleted successfully.');
    }
}
