<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Custom Styles -->  
    <style>
        html {
            scroll-behavior: smooth;
        }

        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --success: #22c55e;
            --text-dark: #f2f2f2;
            --text-light: #6b7280;
            --bg-light: #f9fafb;
        }

        body {
            font-family: "Inter", sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
        }

        /* Assuming navbar height is 70px and sidebar width is 250px */
        main {
            margin-top: 1rem;
            /* push content below navbar */
            margin-left: 250px;
            /* push content away from sidebar */
            padding: 1rem;
            /* optional: spacing inside */
        }

        .hero {
            background: linear-gradient(135deg, var(--bg-light), #ffffff14);
            padding: 4rem 1rem;
            text-align: center;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 3rem;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--text-dark);
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text-light);
            margin-bottom: 1.5rem;
        }

        .tutorial-step {
            background: linear-gradient(135deg, var(--bg-light), #ffffff14);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);  
            text-align: center;
            transition: transform 0.2s;
        }

        .tutorial-step:hover {
            transform: translateY(-5px);
        }

        .tutorial-step i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .about-section,
        .faq-section,
        .contact-section {
            background: linear-gradient(135deg, var(--bg-light), #ffffff14);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        @media (max-width: 768px) {
            main {
                margin-left: 0;
                /* no sidebar offset on small screens */
            }
        }
    </style>

    <!-- Vite Custom CSS -->
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
</head>

<body>
    <div class="layout d-flex">
        <x-navbar.user-navbar />

        <main>
            <div class="container my-5">

                <!-- Hero -->
                <section class="hero">
                    <h1>Welcome to the Incident Reporting System</h1>
                    <p>Your platform for safe, transparent, and accountable reporting.</p>
                    <a href="{{ route('user.report.userIncidentReporting.create') }}"
                        class="btn btn-outline-primary btn-md">
                        <i class="fa fa-plus-circle me-2"></i>Start Reporting
                    </a>
                </section>

                <!-- Tutorial / Steps -->
                <section class="mb-5">
                    <h2 class="section-title text-center">How It Works</h2>
                    <div class="row g-4">
                        <div class="col-md-3 col-sm-6">
                            <div class="tutorial-step">
                                <i class="fa fa-file-alt"></i>
                                <h5>Create a Report</h5>
                                <p>Submit a new incident with details and attachments.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="tutorial-step">
                                <i class="fa fa-list"></i>
                                <h5>View Reports</h5>
                                <p>Check your submitted reports anytime.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="tutorial-step">
                                <i class="fa fa-edit"></i>
                                <h5>Edit or Delete</h5>
                                <p>Update or remove your reports when needed.</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="tutorial-step">
                                <i class="fa fa-clock"></i>
                                <h5>Track Status</h5>
                                <p>Stay updated on the progress of your report.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- About -->
                <section class="about-section">
                    <h2 class="section-title">About This System</h2>
                    <p>
                        The Incident Reporting System allows citizens to easily report issues, track progress,
                        and ensure transparency in resolving community concerns.
                        It is designed to promote accountability and faster action from authorities.
                    </p>
                </section>

                <x-modals.user-side.faq />

                <!-- Contact -->
                <section class="contact-section text-center">
                    <h2 class="section-title">Need Help?</h2>
                    <p>If you need assistance, reach out to our support staff.</p>
                    <a href="mailto:support@incidentreporting.com" class="btn btn-outline-primary">
                        <i class="fa fa-envelope me-2"></i>Contact Support
                    </a>
                </section>

            </div>
        </main>
    </div>

    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
