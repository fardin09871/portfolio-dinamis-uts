<section id="projects" class="projects-section">
    <div class="projects-glow" aria-hidden="true"></div>

    <div class="projects-container">
        <div class="projects-heading">
            <p class="section-label">03 / SELECTED WORK</p>

            <h2 class="spider-title">
                MY <span>PROJECTS.</span>
            </h2>

            <p class="projects-intro">
                A collection of projects, experiments, and things I've built along my journey as a developer.
            </p>
        </div>

        @forelse($projects as $project)
            @php
                $projectTechStack = is_array($project->tech_stack) ? $project->tech_stack : [];
                $projectThumbnailUrl = $project->thumbnail && str_starts_with($project->thumbnail, 'projects/')
                    ? asset('storage/' . $project->thumbnail)
                    : $project->thumbnail;
            @endphp

            <article class="project-card">
                <div class="project-thumbnail">
                    @if($projectThumbnailUrl)
                        <img
                            src="{{ $projectThumbnailUrl }}"
                            alt="{{ $project->title }} preview"
                            loading="lazy"
                        >
                    @else
                        <div class="project-no-preview">
                            <span>NO PREVIEW</span>
                        </div>
                    @endif

                    @if($project->featured)
                        <span class="project-featured">FEATURED</span>
                    @endif

                    <div class="project-image-shade" aria-hidden="true"></div>
                </div>

                <div class="project-details">
                    <p class="project-number">
                        PROJECT / {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                    </p>

                    <h3>{{ $project->title }}</h3>
                    <p class="project-description">{{ $project->description }}</p>

                    @if(count($projectTechStack))
                        <div class="project-tech-list" aria-label="Technologies used">
                            @foreach($projectTechStack as $technology)
                                <span>{{ $technology }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($project->github_url || $project->live_url)
                        <div class="project-links">
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer">
                                    GITHUB ↗
                                </a>
                            @endif

                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer">
                                    LIVE DEMO ↗
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </article>
        @empty
            <div class="projects-empty">
                <h3>No projects published yet.</h3>
                <p>Stay tuned for upcoming projects.</p>
            </div>
        @endforelse
    </div>
</section>
