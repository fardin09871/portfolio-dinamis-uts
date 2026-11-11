<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.projects.index', compact('projects'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatedProject($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);
        $validated['tech_stack'] = $this->parseTechStack($validated['tech_stack'] ?? null);
        $validated['featured'] = $request->boolean('featured');

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('projects', 'public');

            if ($thumbnailPath === false) {
                throw new RuntimeException('Project thumbnail could not be stored.');
            }

            $validated['thumbnail'] = $thumbnailPath;
        }

        Project::create($validated);

        return back()->with('success', 'Project berhasil ditambahkan.');
    }

    public function update(Request $request, int $project)
    {
        $validated = $this->validatedProject($request);
        $record = Project::findOrFail($project);

        $validated['slug'] = $this->uniqueSlug($validated['title'], $record->id);
        $validated['tech_stack'] = $this->parseTechStack($validated['tech_stack'] ?? null);
        $validated['featured'] = $request->boolean('featured');

        unset($validated['thumbnail']);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('projects', 'public');

            if ($thumbnailPath === false) {
                throw new RuntimeException('Project thumbnail could not be stored.');
            }

            $this->deleteStoredThumbnail($record->thumbnail);
            $validated['thumbnail'] = $thumbnailPath;
        }

        $record->update($validated);

        return back()->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(int $project)
    {
        $record = Project::findOrFail($project);
        $this->deleteStoredThumbnail($record->thumbnail);
        $record->delete();

        return back()->with('success', 'Project berhasil dihapus.');
    }

    private function validatedProject(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:5000'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'tech_stack' => ['nullable', 'string', 'max:2000'],
            'github_url' => ['nullable', 'url', 'max:2048'],
            'live_url' => ['nullable', 'url', 'max:2048'],
            'featured' => ['sometimes', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }

    private function deleteStoredThumbnail(?string $thumbnail): void
    {
        if ($thumbnail && str_starts_with($thumbnail, 'projects/')) {
            Storage::disk('public')->delete($thumbnail);
        }
    }

    private function parseTechStack(?string $techStack): array
    {
        if ($techStack === null || trim($techStack) === '') {
            return [];
        }

        return array_values(array_unique(array_filter(
            array_map('trim', preg_split('/[,\\r\\n]+/', $techStack) ?: [])
        )));
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title) ?: 'project';
        $slug = $baseSlug;
        $suffix = 2;

        while (
            Project::where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$baseSlug}-{$suffix}";
            $suffix++;
        }

        return $slug;
    }
}
