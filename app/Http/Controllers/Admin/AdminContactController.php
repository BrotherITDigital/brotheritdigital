<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show(int $id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->markAsRead();
        return view('admin.contacts.show', compact('message'));
    }

    public function markRead(int $id)
    {
        ContactMessage::findOrFail($id)->markAsRead();
        return back()->with('success', 'Marked as read.');
    }

    public function destroy(int $id)
    {
        ContactMessage::findOrFail($id)->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Message deleted.');
    }
}
