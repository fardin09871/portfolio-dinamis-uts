@if($techStacks->isNotEmpty())
    @php
        $skillIconSlugs = [
            'html5' => 'html5',
            'php' => 'php',
            'laravel' => 'laravel',
            'javascript' => 'javascript',
            'next.js' => 'nextdotjs/ffffff',
            'mysql' => 'mysql',
            'tailwind css' => 'tailwindcss',
            'bootstrap' => 'bootstrap',
            'git' => 'git',
            'github' => 'github/ffffff',
        ];

    @endphp

    <section id="skills" class="skills-section" data-skills>
        <div class="skills-grid-background" aria-hidden="true"></div>
        <div class="skills-glow" aria-hidden="true"></div>

        <div class="skills-layout">
            <div class="skills-copy">
                <p class="skills-eyebrow">
                    <span></span>
                    02 / MY ARSENAL
                </p>

                <h2 class="skills-heading">
                    BUILT<br>
                    THROUGH<br>
                    <span>CODE.</span>
                </h2>

                <p class="skills-description">
                    The technologies and tools I use to turn ideas into digital experiences.
                </p>

                <p class="skills-category-note">
                    TECHNOLOGIES
                    <span>{{ str_pad($techStacks->count(), 2, '0', STR_PAD_LEFT) }} TOOLS</span>
                </p>
            </div>

            <div class="skills-panel-frame">
                <div class="skills-panel">
                    <div class="skills-panel-title">
                        <span>TECHNOLOGY SYSTEMS</span>
                        <span>{{ str_pad($techStacks->count(), 2, '0', STR_PAD_LEFT) }} TECHNOLOGIES</span>
                    </div>

                    <ul class="skills-list">
                        @foreach($techStacks as $stack)
                            @php
                                $iconName = strtolower(trim($stack->name));
                                $iconSlug = $skillIconSlugs[$iconName] ?? preg_replace('/[^a-z0-9]/', '', $iconName);
                                $iconUrl = $stack->icon ?: "https://cdn.simpleicons.org/{$iconSlug}";
                            @endphp
                            <li class="skills-item">
                                <span class="skills-item-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <img
                                    class="skills-item-logo"
                                    src="{{ $iconUrl }}"
                                    alt=""
                                    aria-hidden="true"
                                    loading="lazy"
                                    data-tech-logo
                                >
                                <span class="skills-item-icon" aria-hidden="true" hidden>
                                    {{ strtoupper(substr($stack->name, 0, 2)) }}
                                </span>
                                <span class="skills-item-name">{{ $stack->name }}</span>
                                <span class="skills-item-mark" aria-hidden="true">↗</span>
                            </li>
                        @endforeach
                    </ul>

                    <div class="skills-panel-footer">
                        <span>TECHNOLOGIES</span>
                        <span>{{ str_pad($techStacks->count(), 2, '0', STR_PAD_LEFT) }} TOTAL</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
