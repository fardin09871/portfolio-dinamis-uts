<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutProfile;
use App\Models\TechStack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    private function profile(): AboutProfile
    {
        return AboutProfile::firstOrFail();
    }

    public function index()
    {
        $profile = $this->profile();

        $descriptions = $profile->descriptions;
        $focusAreas = $profile->focusAreas;

        // Ambil seluruh data Tech Stack
        $techStacks = TechStack::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.about.index', compact(
            'profile',
            'descriptions',
            'focusAreas',
        ));
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'full_name' => ['required', 'string', 'max:150'],
            'role' => ['required', 'string', 'max:150'],
            'profile_label' => ['required', 'string', 'max:100'],
            'quote' => ['nullable', 'string', 'max:255'],
            'est_year' => ['required', 'string', 'max:10'],
            'universe_code' => ['required', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $profile = $this->profile();

        unset($validated['image']);

        if ($request->hasFile('image')) {
            if (
                $profile->image_path &&
                str_starts_with($profile->image_path, 'about/')
            ) {
                Storage::disk('public')->delete($profile->image_path);
            }

            $validated['image_path'] = $request->file('image')
                ->store('about', 'public');
        }

        $profile->update($validated);

        return back()->with(
            'success',
            'Profile About berhasil diperbarui.'
        );
    }

    public function storeDescription(Request $request)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $this->profile()->descriptions()->create($validated);

        return back()->with(
            'success',
            'Deskripsi berhasil ditambahkan.'
        );
    }

    public function updateDescription(Request $request, int $description)
    {
        $validated = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $this->profile()
            ->descriptions()
            ->findOrFail($description)
            ->update($validated);

        return back()->with(
            'success',
            'Deskripsi berhasil diperbarui.'
        );
    }

    public function destroyDescription(int $description)
    {
        $this->profile()
            ->descriptions()
            ->findOrFail($description)
            ->delete();

        return back()->with(
            'success',
            'Deskripsi berhasil dihapus.'
        );
    }

    public function storeFocusArea(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $this->profile()->focusAreas()->create($validated);

        return back()->with(
            'success',
            'Focus Area berhasil ditambahkan.'
        );
    }

    public function updateFocusArea(Request $request, int $focusArea)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $this->profile()
            ->focusAreas()
            ->findOrFail($focusArea)
            ->update($validated);

        return back()->with(
            'success',
            'Focus Area berhasil diperbarui.'
        );
    }

    public function destroyFocusArea(int $focusArea)
    {
        $this->profile()
            ->focusAreas()
            ->findOrFail($focusArea)
            ->delete();

        return back()->with(
            'success',
            'Focus Area berhasil dihapus.'
        );
    }
}
