@extends('admin.layouts.app')

@section('title', 'Manage Projects')

@section('content')
<div class="project-manager">
    <header class="project-manager-header">
        <div>
            <span>03 / SELECTED WORK</span>
            <h1>PROJECTS<span>.</span></h1>
            <p>Create and manage the projects shown on your portfolio.</p>
        </div>
        <small>{{ $projects->count() }} PROJECTS</small>
    </header>

    @if($errors->any())
        <div class="project-admin-error" role="alert">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="project-admin-panel">
        <h2>PROJECT COLLECTION</h2>

        @forelse($projects as $project)
            <article class="project-admin-card">
                <div class="project-admin-card-heading">
                    <h3>{{ $project->title }}</h3>
                    <span>{{ $project->slug }}</span>
                </div>

                <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="project-admin-grid">
                        <div class="project-admin-field">
                            <label for="title-{{ $project->id }}">PROJECT TITLE</label>
                            <input id="title-{{ $project->id }}" name="title" value="{{ $project->title }}" required maxlength="150">
                        </div>

                        <div class="project-admin-field">
                            <label for="thumbnail-{{ $project->id }}">THUMBNAIL IMAGE</label>
                            <input id="thumbnail-{{ $project->id }}" type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                            <small class="project-admin-hint">JPG, PNG, or WebP. Max 5 MB.</small>
                            @if($project->thumbnail)
                                @php
                                    $thumbnailUrl = str_starts_with($project->thumbnail, 'projects/')
                                        ? asset('storage/' . $project->thumbnail)
                                        : $project->thumbnail;
                                @endphp
                                <img class="project-admin-thumbnail" src="{{ $thumbnailUrl }}" alt="{{ $project->title }} thumbnail">
                            @endif
                        </div>

                        <div class="project-admin-field project-admin-wide">
                            <label for="description-{{ $project->id }}">DESCRIPTION</label>
                            <textarea id="description-{{ $project->id }}" name="description" rows="4" required maxlength="5000">{{ $project->description }}</textarea>
                        </div>

                        <div class="project-admin-field project-admin-wide">
                            <label for="tech-stack-{{ $project->id }}">TECH STACK (COMMA OR NEWLINE SEPARATED)</label>
                            <input id="tech-stack-{{ $project->id }}" name="tech_stack" value="{{ implode(', ', $project->tech_stack ?? []) }}" placeholder="Laravel, MySQL, Tailwind CSS">
                        </div>

                        <div class="project-admin-field">
                            <label for="github-{{ $project->id }}">GITHUB URL</label>
                            <input id="github-{{ $project->id }}" type="url" name="github_url" value="{{ $project->github_url }}" placeholder="https://github.com/...">
                        </div>

                        <div class="project-admin-field">
                            <label for="live-{{ $project->id }}">LIVE DEMO URL</label>
                            <input id="live-{{ $project->id }}" type="url" name="live_url" value="{{ $project->live_url }}" placeholder="https://...">
                        </div>

                        <div class="project-admin-field">
                            <label for="order-{{ $project->id }}">DISPLAY ORDER</label>
                            <input id="order-{{ $project->id }}" type="number" name="sort_order" min="0" value="{{ $project->sort_order }}">
                        </div>

                        <label class="project-admin-featured">
                            <input type="checkbox" name="featured" value="1" @checked($project->featured)>
                            FEATURED PROJECT
                        </label>
                    </div>

                    <div class="project-admin-actions">
                        <button class="project-admin-save" type="submit">SAVE CHANGES</button>
                    </div>
                </form>

                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Delete this project?')">
                    @csrf
                    @method('DELETE')
                    <button class="project-admin-delete" type="submit">DELETE PROJECT</button>
                </form>
            </article>
        @empty
            <p class="project-admin-empty">No projects yet. Add your first project below.</p>
        @endforelse
    </section>

    <section class="project-admin-panel project-admin-add">
        <h2>+ ADD NEW PROJECT</h2>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="project-admin-grid">
                <div class="project-admin-field">
                    <label for="new-title">PROJECT TITLE</label>
                    <input id="new-title" name="title" value="{{ old('title') }}" required maxlength="150" placeholder="Portfolio Website">
                </div>

                <div class="project-admin-field">
                    <label for="new-thumbnail">THUMBNAIL IMAGE</label>
                    <input id="new-thumbnail" type="file" name="thumbnail" accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">
                    <small class="project-admin-hint">JPG, PNG, or WebP. Max 5 MB.</small>
                </div>

                <div class="project-admin-field project-admin-wide">
                    <label for="new-description">DESCRIPTION</label>
                    <textarea id="new-description" name="description" rows="4" required maxlength="5000" placeholder="Describe what you built...">{{ old('description') }}</textarea>
                </div>

                <div class="project-admin-field project-admin-wide">
                    <label for="new-tech-stack">TECH STACK (COMMA OR NEWLINE SEPARATED)</label>
                    <input id="new-tech-stack" name="tech_stack" value="{{ old('tech_stack') }}" placeholder="Laravel, MySQL, Tailwind CSS">
                </div>

                <div class="project-admin-field">
                    <label for="new-github">GITHUB URL</label>
                    <input id="new-github" type="url" name="github_url" value="{{ old('github_url') }}" placeholder="https://github.com/...">
                </div>

                <div class="project-admin-field">
                    <label for="new-live">LIVE DEMO URL</label>
                    <input id="new-live" type="url" name="live_url" value="{{ old('live_url') }}" placeholder="https://...">
                </div>

                <div class="project-admin-field">
                    <label for="new-order">DISPLAY ORDER</label>
                    <input id="new-order" type="number" name="sort_order" min="0" value="{{ old('sort_order', 0) }}">
                </div>

                <label class="project-admin-featured">
                    <input type="checkbox" name="featured" value="1" @checked(old('featured'))>
                    FEATURED PROJECT
                </label>
            </div>

            <button class="project-admin-save" type="submit">ADD PROJECT →</button>
        </form>
    </section>
</div>
@endsection

@push('styles')
<style>
.project-manager { max-width: 1100px; margin: auto; }
.project-manager-header { display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 30px; }
.project-manager-header span { color: #e62429; font-size: 10px; font-weight: 900; letter-spacing: 2px; }
.project-manager-header h1 { margin-top: 10px; font-family: 'Anton', sans-serif; font-size: 36px; }
.project-manager-header h1 span { color: #e62429; }
.project-manager-header p, .project-manager-header small { color: #92929c; font-size: 11px; }
.project-admin-panel { padding: 25px; margin-bottom: 25px; background: #0d1019; border: 1px solid rgba(255,255,255,.09); }
.project-admin-panel > h2 { margin-bottom: 22px; color: #e62429; font-size: 11px; letter-spacing: 1.5px; }
.project-admin-card { padding: 22px 0; border-top: 1px solid rgba(255,255,255,.09); }
.project-admin-card-heading { display: flex; justify-content: space-between; align-items: baseline; gap: 15px; margin-bottom: 18px; }
.project-admin-card-heading h3 { font-size: 16px; }
.project-admin-card-heading span { color: #777d8d; font-size: 10px; }
.project-admin-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
.project-admin-wide { grid-column: 1 / -1; }
.project-admin-field label { display: block; margin-bottom: 8px; color: #92929c; font-size: 9px; font-weight: 900; letter-spacing: .5px; }
.project-admin-field input, .project-admin-field textarea { width: 100%; min-width: 0; padding: 12px; background: #080a10; border: 1px solid rgba(255,255,255,.12); border-radius: 0; color: white; outline: none; font: inherit; font-size: 11px; }
.project-admin-field textarea { resize: vertical; line-height: 1.6; }
.project-admin-field input:focus, .project-admin-field textarea:focus { border-color: #e62429; }
.project-admin-hint { display: block; margin-top: 7px; color: #777d8d; font-size: 10px; }
.project-admin-thumbnail { display: block; width: min(100%, 220px); max-height: 120px; margin-top: 10px; border: 1px solid rgba(255,255,255,.12); object-fit: cover; }
.project-admin-featured { display: flex; align-items: center; gap: 9px; color: #c5c7cf; font-size: 10px; font-weight: 800; }
.project-admin-featured input { accent-color: #e62429; }
.project-admin-actions { margin-top: 16px; }
.project-admin-save, .project-admin-delete { padding: 12px 15px; border: 1px solid #e62429; background: #e62429; color: white; font-size: 9px; font-weight: 900; cursor: pointer; }
.project-admin-save:hover { background: transparent; color: #ff555b; }
.project-admin-delete { margin-top: 12px; background: transparent; color: #ff7378; }
.project-admin-delete:hover { background: #e62429; color: white; }
.project-admin-add { border-style: dashed; border-color: rgba(230,36,41,.4); }
.project-admin-add .project-admin-save { margin-top: 20px; }
.project-admin-empty { color: #92929c; font-size: 12px; }
.project-admin-error { padding: 15px; margin-bottom: 20px; background: rgba(230,36,41,.1); color: #ff7378; font-size: 11px; }
.project-admin-error p + p { margin-top: 5px; }
@media (max-width: 650px) {
    .project-admin-grid { grid-template-columns: 1fr; }
    .project-admin-wide { grid-column: auto; }
    .project-manager-header { align-items: flex-start; flex-direction: column; }
    .project-admin-panel { padding: 18px; }
    .project-admin-card-heading { align-items: flex-start; flex-direction: column; gap: 5px; }
}
</style>
@endpush
