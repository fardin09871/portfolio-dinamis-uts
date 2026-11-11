
import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-tech-logo]').forEach((logo) => {
        logo.addEventListener('error', () => {
            logo.hidden = true;
            logo.nextElementSibling.hidden = false;
        }, { once: true });
    });

    // DOM Elements
    const intro = document.getElementById('intro');
    const portfolio = document.getElementById('portfolio');
    const progressBar = document.getElementById('progress-bar');
    const progressNumber = document.getElementById('progress-number');
    const skipButton = document.getElementById('skip-intro');
    const spiderEmblem = document.getElementById('spider-emblem');
    const introContent = document.querySelector('.intro-content');

    // Pastikan elemen utama tersedia
    if (!intro || !portfolio) {
        return;
    }

    // Configuration
    const duration = 4800;
    const transitionDuration = 900;

    // State
    let startedAt = performance.now();
    let finished = false;
    let glitchTriggered = false;
    let animationFrame = null;

    // Trigger Spider-Verse Glitch
    function triggerGlitch() {
        if (glitchTriggered) return;

        glitchTriggered = true;

        spiderEmblem?.classList.add('is-glitching');
        introContent?.classList.add('is-text-glitching');
    }

    // Update Intro Progress
    function updateProgress(now) {
        if (finished) return;

        const elapsed = now - startedAt;
        const progress = Math.min((elapsed / duration) * 100, 100);

        // Update progress bar
        if (progressBar) {
            progressBar.style.width = `${progress}%`;
        }

        // Update percentage
        if (progressNumber) {
            progressNumber.textContent =
                `${Math.floor(progress).toString().padStart(2, '0')}%`;
        }

        // Trigger glitch at 75%
        if (progress >= 75) {
            triggerGlitch();
        }

        // Continue animation
        if (progress < 100) {
            animationFrame = requestAnimationFrame(updateProgress);
        } else {
            finishIntro();
        }
    }

    // Finish Intro
    function finishIntro() {
        if (finished) return;

        finished = true;

        // Stop animation frame
        if (animationFrame !== null) {
            cancelAnimationFrame(animationFrame);
        }

        // Complete progress
        if (progressBar) {
            progressBar.style.width = '100%';
        }

        if (progressNumber) {
            progressNumber.textContent = '100%';
        }

        // Activate final glitch
        triggerGlitch();

        // Start transition
        intro.classList.add('is-leaving');

        // Reveal portfolio
        portfolio.classList.add('is-visible');

        // Unlock scrolling
        document.body.style.overflow = '';

        // Remove intro after transition
        window.setTimeout(() => {
            intro.remove();
        }, transitionDuration);
    }

    // Skip Intro
    skipButton?.addEventListener('click', finishIntro);

    // Lock scrolling during intro
    document.body.style.overflow = 'hidden';

    // Start intro animation
    animationFrame = requestAnimationFrame(updateProgress);
});
