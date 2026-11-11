<section id="contact" class="contact-section">
    <div class="contact-container">
        <p class="section-label">04 — GET IN TOUCH</p>

        <h2 class="spider-title">
            {{ $contact?->headline ?? "LET'S BUILD SOMETHING." }}
        </h2>

        <p class="contact-message">
            {{ $contact?->message ?: "Have an idea? Let's make it happen." }}
        </p>

        <div class="contact-links">
            @if($contact?->email)
                <a href="mailto:{{ $contact->email }}">
                    <span>EMAIL</span>
                    <strong>{{ $contact->email }}</strong>
                    <span aria-hidden="true">↗</span>
                </a>
            @endif

            @if($contact?->phone)
                <a href="https://wa.me/{{ preg_replace('/\D+/', '', $contact->phone) }}" target="_blank" rel="noopener noreferrer">
                    <span>PHONE / WHATSAPP</span>
                    <strong>{{ $contact->phone }}</strong>
                    <span aria-hidden="true">↗</span>
                </a>
            @endif

            @if($contact?->location)
                <div class="contact-location">
                    <span>LOCATION</span>
                    <strong>{{ $contact->location }}</strong>
                </div>
            @endif

            @if($contact?->github_url)
                <a href="{{ $contact->github_url }}" target="_blank" rel="noopener noreferrer">
                    <span>GITHUB</span>
                    <strong>View my GitHub</strong>
                    <span aria-hidden="true">↗</span>
                </a>
            @endif

            @if($contact?->linkedin_url)
                <a href="{{ $contact->linkedin_url }}" target="_blank" rel="noopener noreferrer">
                    <span>LINKEDIN</span>
                    <strong>Connect on LinkedIn</strong>
                    <span aria-hidden="true">↗</span>
                </a>
            @endif
        </div>
    </div>
</section>
