<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="theme-color" content="#05070d">
    <meta name="description" content="Fardin Muhammad Azis — Web Developer">

    <title>Fardin.dev — Web Developer</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet"
    >

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="site-body">

    <!-- CINEMATIC INTRO -->
    <div id="intro" class="intro">

        <div class="intro-noise"></div>

        <div class="intro-content">

            <!-- SPIDER EMBLEM -->
            <div class="spider-emblem" id="spider-emblem">

                <img
                    src="{{ asset('images/miles-morales-emblem.png') }}"
                    alt="Spider-Man Emblem"
                    class="emblem-main"
                >

                <img
                    src="{{ asset('images/miles-morales-emblem.png') }}"
                    alt=""
                    class="emblem-glitch glitch-red"
                    aria-hidden="true"
                >

                <img
                    src="{{ asset('images/miles-morales-emblem.png') }}"
                    alt=""
                    class="emblem-glitch glitch-white"
                    aria-hidden="true"
                >

            </div>

            <p class="intro-eyebrow">
                A NEW IDENTITY IS EMERGING
            </p>

            <h1 class="intro-title spider-title">
                FARDIN<span>.</span>DEV
            </h1>

            <p class="intro-subtitle">
                YOUR FRIENDLY NEIGHBORHOOD<br>
                <span>WEB DEVELOPER</span>
            </p>

            <div class="intro-progress">

                <div class="progress-track">
                    <div id="progress-bar"></div>
                </div>

                <div class="progress-info">
                    <span>INITIALIZING EXPERIENCE</span>
                    <span id="progress-number">00%</span>
                </div>

            </div>

        </div>

        <div class="intro-bottom">

            <span>EARTH-1610 // DEVELOPER MODE</span>

            <button id="skip-intro" type="button">
                SKIP INTRO ↗
            </button>

        </div>

        <div id="intro-flash" class="intro-flash"></div>

    </div>


    <!-- MAIN PORTFOLIO -->
    <main id="portfolio" class="portfolio">

        <!-- NAVBAR -->
        <nav class="navbar">

            <a href="#home" class="brand spider-title">
                FARDIN<span>.</span>DEV
            </a>

            <div class="nav-links">
                <a href="#home">HOME</a>
                <a href="#about">ABOUT</a>
                <a href="#skills">SKILLS</a>
                <a href="#projects">PROJECTS</a>
                <a href="#contact">CONTACT</a>
            </div>

            <span class="nav-status">
                <span></span>
                AVAILABLE FOR WORK
            </span>

        </nav>


        <!-- HERO -->
        <section id="home" class="hero">

            <div class="hero-grid"></div>

            <div class="hero-content">

                <div class="hero-label">
                    <span class="red-dot"></span>
                    WELCOME TO MY PORTFOLIO
                </div>

                <h1 class="spider-title">
                    HELLO,<br>
                    IM <span>FARDIN</span><br>
                </h1>

                <p>
                    I'm Fardin Muhammad Azis.
                    I build modern web applications with Laravel and explore modern frontend development with Next.js.
                </p>

                <div class="hero-actions">

                    <a href="#projects" class="btn-primary">
                        EXPLORE MY WORK ↗
                    </a>

                    <a href="#about" class="btn-secondary">
                        DISCOVER MORE
                    </a>

                </div>

            </div>


            <!-- HERO EMBLEM -->
            <div class="hero-decoration">

                <div class="hero-spider">

                    <img
                        src="{{ asset('images/miles-morales-emblem.png') }}"
                        alt="Spider-Man Emblem"
                    >

                </div>

            </div>

            <div class="hero-index">
                <span>01</span> / 05
            </div>

        </section>


        <!-- ABOUT -->
        @include('components.portfolio.about')


        <!-- SKILLS -->
        @include('components.portfolio.tech-stacks')


        <!-- PROJECTS -->
        @include('components.portfolio.projects')


        @include('components.portfolio.contact')


        <!-- FOOTER -->
        <footer>

            <span>© 2026 FARDIN.DEV</span>

            <span>BUILT WITH PASSION & CODE.</span>

        </footer>

    </main>

</body>
</html>
