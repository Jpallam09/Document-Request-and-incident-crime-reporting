<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Main Dashboard</title>

<!-- Bootstrap & Icons -->
<link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<!-- Vite Custom CSS -->
@vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')

<style>
/* ========================
   Hero Section
========================== */
.dashboard-hero {
    position: relative;
    background: linear-gradient(135deg, #0d6efd 0%, #4dabf7 100%);
    color: #fff;
    padding: 6rem 2rem 12rem;
    text-align: center;
    border-radius: 0 0 2rem 2rem;
    overflow: hidden;
    z-index: 1;
}

.dashboard-hero h1 {
    font-size: 2.75rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.dashboard-hero p {
    font-size: 1.25rem;
    opacity: 0.9;
}

/* Wave Divider */
.dashboard-hero svg {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 160px;
    display: block;
}

/* ========================
   Dashboard Content
========================== */
.dashboard-content {
    position: relative;
    z-index: 2;
    margin-top: -80px;
    padding: 3rem 1.5rem;
}

.dashboard-content .row {
    justify-content: center;
}

/* ========================
   Glass Card with Gradient Tint
========================== */
.dashboard-content .card {
    background: rgba(255, 255, 255, 0.1);
    background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.15));
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 1.5rem;
    transition: transform 0.3s, box-shadow 0.3s, background 0.3s;
    color: #fff;
    min-height: 240px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.dashboard-content .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    background: linear-gradient(145deg, rgba(255,255,255,0.15), rgba(255,255,255,0.2));
}

/* Card Icons */
.card i {
    font-size: 3rem;
    padding: 1rem;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    margin-bottom: 1rem;
}

/* Card Typography */
.card-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.card-text {
    font-size: 1rem;
    opacity: 0.85;
}

/* Card Footer / Link */
.card span {
    font-weight: 500;
    color: #cce0ff;
    text-align: center;
}

/* Links inside cards */
.dashboard-content .card a {
    text-decoration: none;
    color: inherit;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .dashboard-hero h1 { font-size: 2rem; }
    .dashboard-hero p { font-size: 1rem; }
    .dashboard-content .card { min-height: auto; }
}
</style>
</head>

<body>
<div class="layout d-flex">
    <x-navbar.user-navbar />

    <main class="page-content flex-grow-1">
        <!-- Hero Section -->
        <section class="dashboard-hero">
            <h1>Hello, {{ auth()->user()->user_name }}!</h1>
            <p>Hope you're having a wonderful {{ now()->format('l') }}.</p>

            <svg viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path fill="#ffffff" fill-opacity="0.15" d="M0,160 C360,220 1080,100 1440,160 L1440,320 L0,320 Z"></path>
            </svg>
        </section>

        <!-- Dashboard Content -->
        <section class="container dashboard-content">
            <div class="row g-4 justify-content-center">
                <!-- Document Request Card -->
                <div class="col-md-6 col-lg-4">
                    <a href="../" class="card h-100 shadow-sm text-decoration-none">
                        <div class="card-body d-flex flex-column justify-content-between text-center">
                            <i class="fas fa-file-alt text-info"></i>
                            <h5 class="card-title">Document Request</h5>
                            <p class="card-text">Submit and manage your document requests.</p>
                            <span class="mt-auto">Go to Document Request &rarr;</span>
                        </div>
                    </a>
                </div>

                <!-- Incident Report Card -->
                <div class="col-md-6 col-lg-4">
                    <a href="{{ route('user.report.userIncidentReporting.create') }}" class="card h-100 shadow-sm text-decoration-none">
                        <div class="card-body d-flex flex-column justify-content-between text-center">
                            <i class="fas fa-exclamation-triangle text-danger"></i>
                            <h5 class="card-title">Incident Report</h5>
                            <p class="card-text">Report and track incidents efficiently.</p>
                            <span class="mt-auto">Go to Incident Report &rarr;</span>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </main>
</div>

<script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
@include('sweetalert::alert')
</body>
</html>
