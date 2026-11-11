@extends('admin.layouts.app')

@section('title', 'Manage About')

@section('content')

<div class="about-admin">

    <div class="topbar">
        <div>
            <h1>ABOUT MANAGER<span style="color:#e62429">.</span></h1>
            <p>Manage your identity, story, and areas of expertise.</p>
        </div>

        <div class="topbar-badge">● CONTENT MANAGER</div>
    </div>

    @if($errors->any())
        <div class="admin-alert error">
            <strong>Something went wrong:</strong>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PROFILE --}}
    <section class="manager-section">

        <div class="manager-heading">
            <div>
                <span>01 / IDENTITY</span>
                <h2>PROFILE SETTINGS</h2>
            </div>
            <small>MAIN PROFILE</small>
        </div>

        <form action="{{ route('admin.about.profile.update') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="profile-editor">

                <div class="profile-preview">

                    @php
                        $profileImage = $profile->image_path;

                        $imageUrl = $profileImage
                            ? (
                                str_starts_with($profileImage, 'about/')
                                    ? \Illuminate\Support\Facades\Storage::url($profileImage)
                                    : asset($profileImage)
                            )
                            : asset('images/pik.jpg');
                    @endphp

                    <img src="{{ $imageUrl }}"
                         alt="Profile Preview"
                         id="profilePreview">

                    <label for="profileImage" class="upload-label">
                        CHANGE IMAGE
                    </label>

                    <input type="file"
                           name="image"
                           id="profileImage"
                           accept="image/jpeg,image/png,image/webp"
                           hidden>

                    <small>JPG, PNG, WEBP / MAX 4MB</small>

                </div>

                <div class="profile-fields">

                    <div class="form-grid">

                        <div class="field">
                            <label>DISPLAY NAME</label>
                            <input type="text"
                                   name="name"
                                   value="{{ old('name', $profile->name) }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>FULL NAME</label>
                            <input type="text"
                                   name="full_name"
                                   value="{{ old('full_name', $profile->full_name) }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>ROLE / POSITION</label>
                            <input type="text"
                                   name="role"
                                   value="{{ old('role', $profile->role) }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>PROFILE LABEL</label>
                            <input type="text"
                                   name="profile_label"
                                   value="{{ old('profile_label', $profile->profile_label) }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>ESTABLISHED YEAR</label>
                            <input type="text"
                                   name="est_year"
                                   value="{{ old('est_year', $profile->est_year) }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>UNIVERSE CODE</label>
                            <input type="text"
                                   name="universe_code"
                                   value="{{ old('universe_code', $profile->universe_code) }}"
                                   required>
                        </div>

                        <div class="field full-width">
                            <label>SIDE QUOTE</label>
                            <input type="text"
                                   name="quote"
                                   value="{{ old('quote', $profile->quote) }}">
                        </div>

                    </div>

                </div>

            </div>

            <button type="submit" class="save-btn">
                SAVE PROFILE CHANGES →
            </button>

        </form>

    </section>

    {{-- DESCRIPTIONS --}}
    <section class="manager-section">

        <div class="manager-heading">
            <div>
                <span>02 / STORY</span>
                <h2>ABOUT DESCRIPTION</h2>
            </div>
            <small>{{ $descriptions->count() }} PARAGRAPHS</small>
        </div>

        <div class="item-list">

            @forelse($descriptions as $description)

                <form action="{{ route('admin.about.descriptions.update', $description->id) }}"
                      method="POST"
                      class="item-card">

                    @csrf
                    @method('PUT')

                    <div class="item-top">
                        <span>PARAGRAPH {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="item-id">ID / {{ $description->id }}</span>
                    </div>

                    <div class="field">
                        <label>CONTENT</label>
                        <textarea name="content" rows="4" required>{{ $description->content }}</textarea>
                    </div>

                    <div class="item-actions">

                        <div class="field order-field">
                            <label>ORDER</label>
                            <input type="number"
                                   name="sort_order"
                                   min="0"
                                   value="{{ $description->sort_order }}">
                        </div>

                        <button class="save-btn small" type="submit">
                            SAVE
                        </button>

                        <button class="delete-btn"
                                type="button"
                                onclick="confirmDelete(this)">
                            DELETE
                        </button>

                    </div>

                </form>

            @empty
                <p class="empty-state">No descriptions available.</p>
            @endforelse

        </div>

        <form action="{{ route('admin.about.descriptions.store') }}"
              method="POST"
              class="add-form">

            @csrf

            <h3>+ ADD NEW PARAGRAPH</h3>

            <div class="field">
                <label>CONTENT</label>
                <textarea name="content"
                          rows="3"
                          placeholder="Write your story..."
                          required></textarea>
            </div>

            <div class="item-actions">
                <div class="field order-field">
                    <label>ORDER</label>
                    <input type="number" name="sort_order" min="0" value="0">
                </div>

                <button class="save-btn small" type="submit">
                    ADD PARAGRAPH →
                </button>
            </div>

        </form>

    </section>

    {{-- FOCUS AREAS --}}
    <section class="manager-section">

        <div class="manager-heading">
            <div>
                <span>03 / EXPERTISE</span>
                <h2>FOCUS AREAS</h2>
            </div>
            <small>{{ $focusAreas->count() }} ITEMS</small>
        </div>

        <div class="item-list">

            @forelse($focusAreas as $area)

                <form action="{{ route('admin.about.focus.update', $area->id) }}"
                      method="POST"
                      class="item-card">

                    @csrf
                    @method('PUT')

                    <div class="item-top">
                        <span>FOCUS / {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <span class="item-id">ID / {{ $area->id }}</span>
                    </div>

                    <div class="form-grid">

                        <div class="field">
                            <label>TITLE</label>
                            <input type="text"
                                   name="title"
                                   value="{{ $area->title }}"
                                   required>
                        </div>

                        <div class="field">
                            <label>ORDER</label>
                            <input type="number"
                                   name="sort_order"
                                   min="0"
                                   value="{{ $area->sort_order }}">
                        </div>

                        <div class="field full-width">
                            <label>DESCRIPTION</label>
                            <textarea name="description"
                                      rows="2"
                                      required>{{ $area->description }}</textarea>
                        </div>

                    </div>

                    <div class="item-actions">
                        <button type="submit" class="save-btn small">SAVE</button>

                        <button type="button"
                                class="delete-btn"
                                onclick="confirmDelete(this)">
                            DELETE
                        </button>
                    </div>

                </form>

            @empty
                <p class="empty-state">No focus areas available.</p>
            @endforelse

        </div>

        <form action="{{ route('admin.about.focus.store') }}"
              method="POST"
              class="add-form">

            @csrf

            <h3>+ ADD FOCUS AREA</h3>

            <div class="form-grid">

                <div class="field">
                    <label>TITLE</label>
                    <input type="text"
                           name="title"
                           placeholder="WEB DEVELOPMENT"
                           required>
                </div>

                <div class="field">
                    <label>ORDER</label>
                    <input type="number"
                           name="sort_order"
                           min="0"
                           value="0">
                </div>

                <div class="field full-width">
                    <label>DESCRIPTION</label>
                    <textarea name="description"
                              rows="2"
                              placeholder="Describe your focus..."
                              required></textarea>
                </div>

            </div>

            <button type="submit" class="save-btn small">
                ADD FOCUS AREA →
            </button>

        </form>

    </section>

    <div class="preview-footer">
        <span>ABOUT CONTENT MANAGEMENT</span>
        <a href="{{ route('home') }}#about" target="_blank">
            VIEW LIVE PORTFOLIO ↗
        </a>
    </div>

</div>

@endsection

@push('styles')
<style>
.about-admin {
    max-width: 1100px;
    margin: auto;
}

.manager-section {
    padding: 28px;
    margin-bottom: 25px;
    background: #0d1019;
    border: 1px solid rgba(255,255,255,.09);
}

.manager-heading {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,.08);
}

.manager-heading span,
.item-top,
.preview-footer {
    color: #e62429;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 2px;
}

.manager-heading h2 {
    margin-top: 9px;
    font-family: 'Anton', sans-serif;
    font-size: 27px;
    font-weight: 400;
}

.manager-heading small {
    color: #777d8d;
    font-size: 9px;
    font-weight: 800;
}

.profile-editor {
    display: grid;
    grid-template-columns: 180px 1fr;
    gap: 30px;
}

.profile-preview {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
}

.profile-preview img {
    width: 155px;
    height: 185px;
    object-fit: cover;
    background: #080a10;
    border: 1px solid rgba(230,36,41,.5);
}

.profile-preview small {
    color: #686d7c;
    font-size: 8px;
    text-align: center;
}

.upload-label {
    padding: 10px 15px;
    background: rgba(230,36,41,.12);
    border: 1px solid rgba(230,36,41,.35);
    color: #ff555b;
    font-size: 9px;
    font-weight: 900;
    cursor: pointer;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

.field {
    min-width: 0;
}

.field label {
    display: block;
    margin-bottom: 9px;
    color: #92929c;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 1px;
}

.field input,
.field textarea {
    width: 100%;
    padding: 13px;
    background: #080a10;
    border: 1px solid rgba(255,255,255,.12);
    outline: none;
    color: white;
    font-family: 'Inter', sans-serif;
    font-size: 11px;
    transition: .2s;
}

.field input:focus,
.field textarea:focus {
    border-color: #e62429;
}

.field textarea {
    resize: vertical;
    line-height: 1.7;
}

.full-width {
    grid-column: 1 / -1;
}

.save-btn,
.delete-btn {
    padding: 13px 19px;
    border: 1px solid #e62429;
    background: #e62429;
    color: white;
    font-size: 9px;
    font-weight: 900;
    letter-spacing: 1px;
    cursor: pointer;
    transition: .2s;
}

.save-btn:hover {
    background: transparent;
    color: #ff555b;
}

.save-btn.small {
    padding: 11px 16px;
}

.delete-btn {
    background: transparent;
    border-color: rgba(255,80,85,.35);
    color: #ff7378;
}

.delete-btn:hover {
    background: #e62429;
    color: white;
}

.profile-editor + .save-btn {
    margin-top: 25px;
}

.item-list {
    display: grid;
    gap: 14px;
}

.item-card {
    padding: 20px;
    background: #080a10;
    border: 1px solid rgba(255,255,255,.08);
}

.item-top {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.item-id {
    color: #686d7c;
}

.item-actions {
    display: flex;
    align-items: end;
    gap: 12px;
    margin-top: 18px;
    flex-wrap: wrap;
}

.order-field {
    width: 100px;
}

.add-form {
    margin-top: 22px;
    padding: 22px;
    background: rgba(230,36,41,.035);
    border: 1px dashed rgba(230,36,41,.35);
}

.add-form h3 {
    margin-bottom: 20px;
    color: #ff555b;
    font-size: 10px;
    letter-spacing: 1px;
}

.add-form > .save-btn {
    margin-top: 18px;
}

.empty-state {
    padding: 20px;
    color: #777d8d;
    font-size: 11px;
}

.preview-footer {
    display: flex;
    justify-content: space-between;
    gap: 15px;
    padding: 20px 0;
    color: #777d8d;
}

.preview-footer a {
    color: #ff555b;
    text-decoration: none;
}

.admin-alert {
    padding: 15px;
    margin-bottom: 20px;
    font-size: 11px;
}

.admin-alert.error {
    color: #ff7378;
    background: rgba(230,36,41,.1);
    border: 1px solid rgba(230,36,41,.3);
}

.admin-alert ul {
    padding-left: 18px;
    margin-top: 8px;
}

@media(max-width: 750px) {
    .manager-section {
        padding: 20px 15px;
    }

    .profile-editor {
        grid-template-columns: 1fr;
    }

    .form-grid {
        grid-template-columns: 1fr;
    }

    .full-width {
        grid-column: auto;
    }

    .preview-footer {
        flex-direction: column;
    }
}
</style>
@endpush

@push('scripts')
<script>
document.getElementById('profileImage')?.addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (!file) return;

    if (!file.type.startsWith('image/')) {
        alert('Please select a valid image.');
        this.value = '';
        return;
    }

    document.getElementById('profilePreview').src =
        URL.createObjectURL(file);
});

function confirmDelete(button) {
    if (!confirm('Are you sure you want to delete this content?')) {
        return;
    }

    const form = button.closest('form');

    const method = document.createElement('input');
    method.type = 'hidden';
    method.name = '_method';
    method.value = 'DELETE';

    form.appendChild(method);
    form.submit();
}
</script>
@endpush
