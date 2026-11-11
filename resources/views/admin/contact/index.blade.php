@extends('admin.layouts.app')

@section('title', 'Manage Contact')

@section('content')
<div class="contact-manager">
    <header class="contact-manager-header">
        <div>
            <span>04 / GET IN TOUCH</span>
            <h1>CONTACT<span>.</span></h1>
            <p>Manage the contact information displayed on your portfolio.</p>
        </div>
    </header>

    @if($errors->any())
        <div class="contact-admin-error" role="alert">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form class="contact-admin-panel" action="{{ route('admin.contact.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="contact-admin-grid">
            <div class="contact-admin-field contact-admin-wide">
                <label for="headline">HEADLINE</label>
                <input id="headline" name="headline" value="{{ old('headline', $contact->headline) }}" maxlength="150" required>
            </div>

            <div class="contact-admin-field contact-admin-wide">
                <label for="message">MESSAGE</label>
                <textarea id="message" name="message" rows="4" maxlength="2000">{{ old('message', $contact->message) }}</textarea>
            </div>

            <div class="contact-admin-field">
                <label for="email">EMAIL</label>
                <input id="email" type="email" name="email" value="{{ old('email', $contact->email) }}" maxlength="255" placeholder="hello@example.com">
            </div>

            <div class="contact-admin-field">
                <label for="phone">PHONE / WHATSAPP</label>
                <input id="phone" name="phone" value="{{ old('phone', $contact->phone) }}" maxlength="50" placeholder="+62...">
            </div>

            <div class="contact-admin-field">
                <label for="location">LOCATION</label>
                <input id="location" name="location" value="{{ old('location', $contact->location) }}" maxlength="150" placeholder="Jakarta, Indonesia">
            </div>

            <div class="contact-admin-field">
                <label for="github_url">GITHUB URL</label>
                <input id="github_url" type="url" name="github_url" value="{{ old('github_url', $contact->github_url) }}" maxlength="2048" placeholder="https://github.com/...">
            </div>

            <div class="contact-admin-field contact-admin-wide">
                <label for="linkedin_url">LINKEDIN URL</label>
                <input id="linkedin_url" type="url" name="linkedin_url" value="{{ old('linkedin_url', $contact->linkedin_url) }}" maxlength="2048" placeholder="https://linkedin.com/in/...">
            </div>
        </div>

        <button class="contact-admin-save" type="submit">SAVE CONTACT INFO →</button>
    </form>
</div>
@endsection

@push('styles')
<style>
.contact-manager { max-width: 1000px; margin: auto; }
.contact-manager-header { margin-bottom: 30px; }
.contact-manager-header span { color: #e62429; font-size: 10px; font-weight: 900; letter-spacing: 2px; }
.contact-manager-header h1 { margin-top: 10px; font-family: 'Anton', sans-serif; font-size: 36px; }
.contact-manager-header h1 span { color: #e62429; }
.contact-manager-header p { margin-top: 5px; color: #92929c; font-size: 11px; }
.contact-admin-panel { padding: 28px; background: #0d1019; border: 1px solid rgba(255,255,255,.09); }
.contact-admin-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 18px; }
.contact-admin-wide { grid-column: 1 / -1; }
.contact-admin-field label { display: block; margin-bottom: 8px; color: #92929c; font-size: 9px; font-weight: 900; letter-spacing: .5px; }
.contact-admin-field input, .contact-admin-field textarea { width: 100%; padding: 12px; border: 1px solid rgba(255,255,255,.12); background: #080a10; color: white; font: inherit; font-size: 12px; outline: none; }
.contact-admin-field textarea { resize: vertical; line-height: 1.6; }
.contact-admin-field input:focus, .contact-admin-field textarea:focus { border-color: #e62429; }
.contact-admin-save { margin-top: 22px; padding: 13px 18px; border: 1px solid #e62429; background: #e62429; color: white; font-size: 10px; font-weight: 900; cursor: pointer; }
.contact-admin-save:hover { background: transparent; color: #ff555b; }
.contact-admin-error { padding: 15px; margin-bottom: 20px; background: rgba(230,36,41,.1); color: #ff7378; font-size: 11px; }
.contact-admin-error p + p { margin-top: 5px; }
@media (max-width: 600px) { .contact-admin-grid { grid-template-columns: 1fr; } .contact-admin-wide { grid-column: auto; } .contact-admin-panel { padding: 20px; } }
</style>
@endpush
