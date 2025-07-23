<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Incident Reporting Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/userCss/userIncidentReporting.css')
    @vite('resources/js/componentsJs/navbar.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/userJs/userIncidentReporting.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.user-navbar')
        <section class="page-content">
            <section class="hero" role="banner" aria-label="Hero section">
                <h1>Report Incidents Quickly &amp; Efficiently</h1>
                <p>Streamline your incident reporting with our intuitive platform that makes logging, tracking, and
                    resolving issues seamless and fast.</p>
                <button class="btn-primary" id="report-button" aria-label="Scroll to report incident form">Report an
                    Incident</button>
            </section>

            <section id="features" class="features" aria-label="Platform features">
                <article class="feature-card" tabindex="0" aria-labelledby="feature1-title"
                    aria-describedby="feature1-desc">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 8v4" stroke-linecap="round" stroke-linejoin="round" />
                        <circle cx="12" cy="16" r="1" fill="currentColor" stroke="none" />
                    </svg>
                    <h3 class="feature-title" id="feature1-title">Fast &amp; Easy Reporting</h3>
                    <p class="feature-description" id="feature1-desc">Create detailed incident reports in seconds with
                        an intuitive, user-friendly form.</p>
                </article>

                <article class="feature-card" tabindex="0" aria-labelledby="feature2-title"
                    aria-describedby="feature2-desc">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        fill="none" stroke="currentColor">
                        <rect x="3" y="11" width="18" height="6" rx="1" ry="1" />
                        <path d="M6 9v2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M10 7v4" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M14 5v6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M18 3v8" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h3 class="feature-title" id="feature2-title">Track Progress</h3>
                    <p class="feature-description" id="feature2-desc">Monitor incidents and get updates until they’re
                        resolved.</p>
                </article>

                <article class="feature-card" tabindex="0" aria-labelledby="feature3-title"
                    aria-describedby="feature3-desc">
                    <svg class="feature-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true"
                        fill="none" stroke="currentColor" stroke-linejoin="round" stroke-linecap="round">
                        <path
                            d="M12 2a10 10 0 0 0-7.246 17.171l.746.579a6.002 6.002 0 0 1 8.628-8.628l.579.746A10 10 0 0 0 12 2Z" />
                        <circle cx="12" cy="12" r="1" fill="currentColor" stroke="none" />
                    </svg>
                    <h3 class="feature-title" id="feature3-title">Secure &amp; Reliable</h3>
                    <p class="feature-description" id="feature3-desc">Data is encrypted and securely stored with strict
                        access controls.</p>
                </article>
            </section>

            <section id="report" class="report-form-section" aria-label="Incident report form">
                <h2>Report an Incident</h2>
                <p>Please provide detailed information below to help us address the issue swiftly.</p>

                <form action="{{ route('user.report.userIncidentReporting.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div>
                        <label for="incident-title">Incident Title</label>
                        <input type="text" id="incident-title" name="report_title"
                            placeholder="Brief title describing the report" required aria-required="true"
                            value="{{ old('report_title') }}">
                    </div>

                    <div>
                        <label for="incident-date">Date of Incident</label>
                        <input type="date" id="incident-date" name="report_date" required aria-required="true"
                            value="{{ old('report_date') }}">
                    </div>

                    <div>
                        <label for="incident-type">Report Type</label>
                        <select id="incident-type" name="report_type" required aria-required="true">
                            <option value="" disabled selected>Select type</option>
                            <option value="Safety">Safety</option>
                            <option value="Security">Security</option>
                            <option value="Operational">Operational</option>
                            <option value="Environmental">Environmental</option>
                        </select>
                    </div>

                    <div>
                        <label for="incidentDescription">Description</label>
                        <textarea id="incidentDescription" name="report_description" placeholder="Detailed description of the incident"
                            required aria-required="true">{{ old('report_description') }}</textarea>
                    </div>

                    <div>
                        <label for="incident-image">Attach Images (Max: 5)</label>
                        <input type="file" id="incident-image" name="report_image[]" accept="image/*" multiple>
                        <small class="upload-guidance">Click or drag images to attach. Maximum of 5.</small>
                    </div>

                    <!-- Image Modal -->
                    <div id="imageModal" class="image-modal" aria-modal="true" role="dialog">
                        <span id="closeModal" class="close-modal" aria-label="Close">&times;</span>
                        <img id="modalImage" class="modal-content" alt="Enlarged preview">
                    </div>

                    <button type="submit" aria-label="Submit Incident Report">Submit Report</button>
                </form>
            </section>
        </section>
    </main>
    @include('sweetalert::alert')
    <footer>
        &copy; 2024 IncidentReport. All rights reserved.
    </footer>
</body>

</html>
