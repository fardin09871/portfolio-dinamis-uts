
@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="topbar">
    <div>
        <h1>DASHBOARD<span style="color:#e62429">.</span></h1>
        <p>Manage your portfolio universe.</p>
    </div>

    <div class="topbar-badge">
        ● SYSTEM ONLINE
    </div>
</div>

<div class="welcome">
    <div class="welcome-label">ADMINISTRATOR / CONTROL CENTER</div>

    <h2>
        WELCOME BACK,<br>
        <span>{{ strtoupper($admin->name) }}.</span>
    </h2>

    <p>
        Your portfolio universe is ready to be managed.
        Select a section from the sidebar to get started.
    </p>
</div>

<div class="dashboard-grid">

    <a href="{{ route('admin.about.index') }}" class="dashboard-card">
        <span>01 / CONTENT</span>
        <h3>HOME</h3>
        <p>Manage your personal profile and About content.</p>
        <small>MANAGE ABOUT →</small>
    </a>

    <a href="{{ route('admin.about.index') }}" class="dashboard-card">
        <span>02 / CONTENT</span>
        <h3>ABOUT</h3>
        <p>Manage your personal profile and information.</p>
        <small>MANAGE ABOUT →</small>
    </a>

    <a href="{{ route('admin.tech-stacks.index') }}" class="dashboard-card">
        <span>03 / CONTENT</span>
        <h3>SKILLS</h3>
        <p>Manage your technical skills.</p>
        <small>MANAGE SKILLS →</small>
    </a>

    <a href="{{ route('admin.projects.index') }}" class="dashboard-card">
        <span>04 / CONTENT</span>
        <h3>PROJECTS</h3>
        <p>Manage your portfolio projects.</p>
        <small>MANAGE PROJECTS →</small>
    </a>

    <a href="{{ route('admin.contact.index') }}" class="dashboard-card">
        <span>05 / CONTENT</span>
        <h3>CONTACT</h3>
        <p>Manage the contact details shown on your portfolio.</p>
        <small>MANAGE CONTACT →</small>
    </a>

</div>

@endsection

@push('styles')
<style>
    .welcome {
        padding: 40px;
        background:
            linear-gradient(110deg, rgba(230,36,41,.18), transparent 65%),
            #10131d;
        border: 1px solid rgba(255,255,255,.1);
        position: relative;
        overflow: hidden;
    }

    .welcome::after {
        content: "SPIDER VERSE";
        position: absolute;
        right: -10px;
        bottom: -35px;
        font-family: 'Anton', sans-serif;
        font-size: clamp(70px, 12vw, 150px);
        color: rgba(255,255,255,.025);
        pointer-events: none;
    }

    .welcome-label {
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 3px;
        color: #ff4248;
    }

    .welcome h2 {
        position: relative;
        z-index: 1;
        margin-top: 20px;
        font-family: 'Anton', sans-serif;
        font-size: clamp(40px, 6vw, 75px);
        font-weight: 400;
        line-height: 1;
    }

    .welcome h2 span {
        color: #e62429;
    }

    .welcome p {
        position: relative;
        z-index: 1;
        max-width: 450px;
        margin-top: 18px;
        color: #92929c;
        font-size: 12px;
        line-height: 1.8;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-top: 25px;
    }

    .dashboard-card {
        display: block;
        padding: 25px;
        background: #0d1019;
        border: 1px solid rgba(255,255,255,.1);
        color: inherit;
        text-decoration: none;
        transition: .3s;
    }

    .dashboard-card:hover {
        border-color: rgba(230,36,41,.6);
        transform: translateY(-4px);
    }

    .dashboard-card span {
        color: #e62429;
        font-size: 9px;
        font-weight: 900;
        letter-spacing: 2px;
    }

    .dashboard-card h3 {
        margin-top: 15px;
        font-family: 'Anton', sans-serif;
        font-size: 35px;
        font-weight: 400;
    }

    .dashboard-card p {
        margin-top: 8px;
        color: #92929c;
        font-size: 11px;
    }

    .dashboard-card small {
        display: inline-block;
        margin-top: 20px;
        padding: 7px 10px;
        background: rgba(230,36,41,.1);
        color: #ff555b;
        font-size: 8px;
        font-weight: 900;
        letter-spacing: 1px;
    }

    @media(max-width: 600px) {
        .welcome {
            padding: 25px;
        }

        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush
