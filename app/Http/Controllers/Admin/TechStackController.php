<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;

class TechStackController extends Controller
{
    public function index()
    {
        $techStacks = TechStack::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.tech-stack.index', compact('techStacks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        TechStack::create($validated);

        return back()->with('success', 'Tech Stack berhasil ditambahkan.');
    }

    public function update(Request $request, int $techStack)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['nullable', 'string', 'max:100'],
            'icon' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        TechStack::findOrFail($techStack)->update($validated);

        return back()->with('success', 'Tech Stack berhasil diperbarui.');
    }

    public function destroy(int $techStack)
    {
        TechStack::findOrFail($techStack)->delete();

        return back()->with('success', 'Tech Stack berhasil dihapus.');
    }
}
