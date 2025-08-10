<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Municipality Document Request & Incident Reporting</title>
    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/css/authCss/index.css')
    @vite('resources/js/authjs/index.js')
</head>

<body>
     <x-modals.index-modal />
    <!-- Our Services Section -->
    <main>
        <section class="features py-5" aria-label="Feature cards section" id="features">
            <div class="container">
                <h2 class="text-center mb-5" id="our-services">Our Services</h2>
                <div class="row g-4">
                    <div class="col-md-6">
                        <a href="" class="feature-card" aria-labelledby="doc-request-title"
                            aria-describedby="doc-request-desc" tabindex="0">
                            <svg class="icon mb-3" viewBox="0 0 24 24" aria-hidden="true" focusable="false"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 17H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h7"></path>
                                <path d="M13 7h5a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-3"></path>
                                <path d="M9 22h6"></path>
                                <path d="M9 14h6"></path>
                                <circle cx="9" cy="10" r="2"></circle>
                            </svg>
                            <h3 id="doc-request-title">Document Request</h3>
                            <p id="doc-request-desc">Submit and track your document requests efficiently through our
                                easy-to-use platform. Stay updated with real-time notifications throughout the process.
                            </p>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="" class="feature-card" aria-labelledby="incident-report-title"
                            aria-describedby="incident-report-desc" tabindex="0">
                            <svg class="icon mb-3" viewBox="0 0 24 24" aria-hidden="true" focusable="false"
                                fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 9v2"></path>
                                <path d="M12 15h.01"></path>
                                <path d="M3 19h18"></path>
                                <path d="M4 19V7a2 2 0 0 1 2-2h3.5"></path>
                                <path d="M17 10v6a2 2 0 0 1-2 2h-5"></path>
                            </svg>
                            <h3 id="incident-report-title">Incident Report</h3>
                            <p id="incident-report-desc">Quickly file incident reports with all essential details in
                                one place. Benefit from timely updates and streamlined resolution tracking.</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Facility Location Section -->
        <section class="facility py-5 bg-light" aria-label="Our facility location section">
            <div class="container">
                <h2 class="text-center mb-5" id="facility-heading">Our Facility Locations</h2>
                <div class="row g-4 justify-content-center">
                    <div class="col-md-5 facility-image-container" tabindex="0" aria-describedby="facility-info-1">
                        <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=800&q=80"
                            alt="Facility Location Map or Image 1" class="img-fluid rounded" />
                        <div class="facility-overlay" id="facility-info-1" role="region"
                            aria-label="Address and facility information">
                            <h4>123 Main Street, Suite 456</h4>
                            <p>Springfield, State 12345</p>
                            <p>Phone: (123) 456-7890</p>
                            <p>Email: contact@municipality.gov</p>
                            <p>Open: Mon-Fri, 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                    <div class="col-md-5 facility-image-container" tabindex="0" aria-describedby="facility-info-2">
                        <img src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29?auto=format&fit=crop&w=800&q=80"
                            alt="Facility Location Map or Image 2" class="img-fluid rounded" />
                        <div class="facility-overlay" id="facility-info-2" role="region"
                            aria-label="Address and facility information">
                            <h4>789 Elm Avenue, Floor 3</h4>
                            <p>Capital City, State 67890</p>
                            <p>Phone: (987) 654-3210</p>
                            <p>Email: support@municipality.gov</p>
                            <p>Open: Mon-Fri, 8:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer role="contentinfo" class="mt-auto">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="mb-3 mb-md-0">&copy; 2024 Municipality Name. All rights reserved.</div>
            <nav class="social-links" aria-label="Social media links">
                <a href="https://github.com/municipality" target="_blank" rel="noopener" aria-label="GitHub"
                    class="me-3 text-decoration-none">
                    <!-- GitHub SVG icon -->
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        focusable="false" width="24" height="24" fill="currentColor">
                        <title>GitHub</title>
                        <path
                            d="M12 2C6.477 2 2 6.477 2 12a10 10 0 0 0 6.839 9.487c.5.09.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.342-3.369-1.342-.455-1.155-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.893 1.528 2.341 1.087 2.91.832.09-.647.35-1.087.636-1.338-2.22-.253-4.555-1.11-4.555-4.942 0-1.09.39-1.98 1.029-2.677-.103-.254-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.025a9.564 9.564 0 0 1 2.5-.337 9.54 9.54 0 0 1 2.5.337c1.91-1.296 2.75-1.025 2.75-1.025.546 1.378.202 2.396.1 2.65.64.697 1.028 1.586 1.028 2.677 0 3.842-2.337 4.685-4.564 4.935.359.31.678.923.678 1.86 0 1.342-.012 2.423-.012 2.753 0 .268.18.577.688.48A10 10 0 0 0 22 12c0-5.523-4.477-10-10-10z" />
                    </svg>
                </a>
                <a href="https://twitter.com/municipality" target="_blank" rel="noopener" aria-label="Twitter"
                    class="me-3 text-decoration-none">
                    <!-- Twitter SVG icon -->
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        focusable="false" width="24" height="24" fill="currentColor">
                        <title>Twitter</title>
                        <path
                            d="M23 3a10.9 10.9 0 0 1-3.14.86 4.48 4.48 0 0 0 1.98-2.48c-.88.52-1.85.9-2.88 1.1A4.52 4.52 0 0 0 16.67 2c-2.5 0-4.51 2-4.51 4.48 0 .35.04.7.1 1.03-3.76-.2-7.1-2-9.33-4.75a4.47 4.47 0 0 0-.61 2.27c0 1.56.8 2.94 2.02 3.75a4.52 4.52 0 0 1-2.04-.57v.06c0 2.18 1.57 3.98 3.65 4.39a4.55 4.55 0 0 1-2.02.08c.57 1.78 2.22 3.08 4.18 3.12A9.06 9.06 0 0 1 2 19.54c-.38 0-.75-.02-1.12-.06a13 13 0 0 0 7.1 2.07c8.52 0 13.17-7.06 13.17-13.17 0-.2 0-.42-.02-.63A9.3 9.3 0 0 0 23 3z" />
                    </svg>
                </a>
                <a href="https://linkedin.com/company/municipality" target="_blank" rel="noopener"
                    aria-label="LinkedIn" class="text-decoration-none">
                    <!-- LinkedIn SVG icon -->
                    <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        focusable="false" width="24" height="24" fill="currentColor">
                        <title>LinkedIn</title>
                        <path
                            d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 3a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" />
                    </svg>
                </a>
            </nav>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle CDN (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
