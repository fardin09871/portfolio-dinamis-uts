<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactProfile;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contact = ContactProfile::firstOrCreate([]);

        return view('admin.contact.index', compact('contact'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'headline' => ['required', 'string', 'max:150'],
            'message' => ['nullable', 'string', 'max:2000'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'location' => ['nullable', 'string', 'max:150'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'linkedin_url' => ['nullable', 'url', 'max:2048'],
        ]);

        ContactProfile::firstOrCreate([])->update($validated);

        return back()->with('success', 'Informasi contact berhasil diperbarui.');
    }
}
