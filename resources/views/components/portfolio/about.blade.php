
@if($aboutProfile)

    @php
        $profileImage = $aboutProfile->image_path;

        $profileImageUrl = $profileImage
            ? (
                str_starts_with($profileImage, 'about/')
                    ? \Illuminate\Support\Facades\Storage::url($profileImage)
                    : asset($profileImage)
            )
            : asset('images/pik.jpg');
    @endphp

    <section id="about" class="about-section">
        <div class="about-container">

            <div class="about-topline">
                <span class="about-index">01 / ABOUT ME</span>
                <span class="about-line"></span>
                <span class="about-universe">THE PERSON BEHIND THE CODE</span>
            </div>

            <div class="about-grid">

                {{-- PROFILE CARD --}}
                <div class="about-visual">
                    <div class="about-card">

                        <div class="about-card-top">
                            <span>IDENTITY FILE</span>

                            <span class="about-card-status">
                                <span></span> ACTIVE
                            </span>
                        </div>

                        <div class="about-emblem">
                            <div class="about-emblem-glow"></div>

                            <img
                                src="{{ $profileImageUrl }}"
                                alt="{{ $aboutProfile->full_name }}"
                                class="about-profile-image"
                            >
                        </div>

                        <div class="about-card-info">
                            <span class="about-card-label">
                                {{ $aboutProfile->profile_label }}
                            </span>

                            <h3>
                                {{ strtoupper($aboutProfile->name) }}<span></span>
                            </h3>

                            <p>
                                {{ strtoupper($aboutProfile->role) }}
                            </p>
                        </div>

                        <div class="about-card-bottom">
                            <span>EST. {{ $aboutProfile->est_year }}</span>
                            <span>{{ $aboutProfile->universe_code }}</span>
                        </div>

                    </div>

                    <div class="about-side-note">
                        <span class="about-side-line"></span>
                        <span>{{ $aboutProfile->quote }}</span>
                    </div>
                </div>

                {{-- ABOUT CONTENT --}}
                <div class="about-content">

                    <span class="about-eyebrow">
                        <span></span> THE STORY SO FAR
                    </span>

                    <h2 class="about-heading">
                        BEHIND<br>
                        THE <span>MASK.</span>
                    </h2>

                    <div class="about-description">

                        @forelse($aboutProfile->descriptions as $description)
                            <p>
                                {{ str_replace(
                                    '{full_name}',
                                    $aboutProfile->full_name,
                                    $description->content
                                ) }}
                            </p>
                        @empty
                            <p>
                                About information is currently being updated.
                            </p>
                        @endforelse

                    </div>

                    {{-- FOCUS AREAS --}}
                    <div class="about-focus">

                        @foreach($aboutProfile->focusAreas as $index => $area)
                            <div class="about-focus-item">

                                <span class="about-focus-number">
                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                <div>
                                    <h4>{{ $area->title }}</h4>
                                    <p>{{ $area->description }}</p>
                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            </div>

            <div class="about-bottomline">
                <span>01 — THE BEGINNING</span>

                <span>
                    MORE TO COME <span class="about-cross">✳</span>
                </span>
            </div>

        </div>
    </section>

@endif
