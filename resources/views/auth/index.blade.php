<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Municipality Document Request & Incident Reporting</title>
    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/css/authCss/index.css')
    @vite('resources/js/authjs/index.js')
</head>

<body>
    <x-modals.index-modal />

    <main>
        <section id="hero" class="hero-section py-5 bg-light">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h1 class="display-4 fw-bold mb-4">Streamline Your Workplace Processes</h1>
                        <p class="lead mb-4">
                            Our comprehensive system provides two essential services to keep your organization running
                            smoothly
                            and ensure a safe working environment for everyone.
                        </p>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <h5 class="fw-semibold">Document Request</h5>
                                <p class="text-muted">A simple way for users to request and track documents.</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5 class="fw-semibold">Incident Reporting</h5>
                                <p class="text-muted">A secure way for users to report workplace incidents.</p>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex">
                            <a href="#" class="btn btn-primary btn-lg me-md-2">Submit Report</a>
                            <a href="#" class="btn btn-outline-primary btn-lg">Request Document</a>
                        </div>
                    </div>

                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/376958cf-ff81-4b17-8dac-2d54f2982cb1.png"
                            alt="Modern workplace interface showing document management and reporting dashboard with clean design"
                            class="img-fluid rounded shadow">
                    </div>
                </div>
            </div>
        </section>

        <section class="faq-section py-5" id="faq">
            <div class="container">
                <h2 class="text-center mb-5">Frequently Asked Questions</h2>

                <div class="accordion" id="faqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq1" aria-expanded="true">
                                How do I submit a document request?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                To submit a document request, click the "Request Document" button above, fill out the
                                required information including document type, urgency level, and any specific details,
                                then submit the form. You'll receive a tracking number to monitor your request status.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq2">
                                What types of incidents should be reported?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You should report any workplace incident including safety concerns, equipment
                                malfunctions, near-misses, injuries, security issues, or any event that could
                                potentially lead to harm. All reports are confidential and handled with discretion.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq3">
                                How long does it take to process document requests?
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Processing times vary based on document type and urgency. Standard requests are
                                typically processed within 3-5 business days. Urgent requests marked as high priority
                                may be processed within 24 hours. You can track the status of your request using the
                                tracking number provided.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq4">
                                Is my incident report confidential?
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes, all incident reports are treated with strict confidentiality. Only authorized
                                personnel involved in the investigation and resolution process have access to the
                                details. Your privacy and security are our top priority throughout the reporting and
                                resolution process.
                            </div>
                        </div>
                    </div>

                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#faq5">
                                Can I edit or update a submitted request or report?
                            </button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can update pending document requests before they are processed. For incident
                                reports, you can add supplementary information or clarifications, but the original
                                report details cannot be altered. Contact support if you need to make significant
                                changes to a submitted report.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="bg-light py-4">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left Side: System Name and Tagline -->
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <h5 class="fw-bold">Document Request & Incident Reporting System</h5>
                    <p class="text-muted">Streamlining workplace processes for a safer environment.</p>
                </div>

                <!-- Center: Quick Navigation Links -->
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#" class="text-decoration-none">Home</a></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none">Incident
                                Reporting</a></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none">Document
                                Request</a></li>
                        <li class="list-inline-item"><a href="#" class="text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <!-- Right Side: Contact Information and Social Media Icons -->
                <div class="col-md-4 text-center text-md-end">
                    <p class="mb-1">Contact us: <a href="mailto:info@example.com">info@example.com</a></p>
                    <p class="mb-1">Phone: (123) 456-7890</p>
                    <p class="mb-1">Address: 123 Main St, Anytown, USA</p>
                    <div>
                        <a href="#" class="text-decoration-none me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-decoration-none me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-decoration-none"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Bar -->
        <div class="bg-dark text-white text-center py-2">
            <small>© 2025 Your System. All Rights Reserved.</small>
        </div>
    </footer>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
