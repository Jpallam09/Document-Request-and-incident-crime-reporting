<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Main Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Vite Custom CSS -->
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/css/authCss/userMainDashboard.css')

    <!-- Vite Custom JS -->
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <div class="layout d-flex">
        {{-- Shared Navbar (with sidebar inside it if included there) --}}
        <x-navbar.user-navbar />

        <main class="page-content flex-grow-1">
            <section class="container-fluid py-4">
                <!-- Greeting -->
                <div class="bg-white p-4 rounded-3 shadow-sm mb-4 d-flex align-items-center gap-3">
                    <div class="icon-circle bg-primary text-white d-flex justify-content-center align-items-center">
                        <i class="fas fa-user fa-lg"></i>
                    </div>
                    <div>
                        <h1 class="mb-1 fw-bold">Hello, {{ auth()->user()->user_name }}!</h1>
                        <p class="text-muted mb-0">Hope you're having a wonderful {{ now()->format('l') }}.</p>
                    </div>
                </div>

                <!-- Overview Widgets -->
                <div class="row g-4 mb-5 centered-row">
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-file-alt fa-2x text-primary mb-2"></i>
                                <h5 class="card-title">My Reports</h5>
                                <p class="display-6">{{ $reportCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-tasks fa-2x text-success mb-2"></i>
                                <h5 class="card-title">My Requests</h5>
                                <p class="display-6">{{ $requestCount ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Cards -->
                <div class="row g-4 centered-row">
                    <div class="col-md-6 col-lg-4">
                        <a href="../" class="card h-100 text-decoration-none text-dark shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <i class="fas fa-file-alt fa-2x mb-3 text-info"></i>
                                    <h5 class="card-title">Document Request</h5>
                                    <p class="card-text">Submit and manage your document requests.</p>
                                </div>
                                <span class="text-primary mt-auto">Go to Document Request &rarr;</span>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4">
                        <a href="{{ route('user.report.userIncidentReporting.create') }}" class="card h-100 text-decoration-none text-dark shadow-sm">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <i class="fas fa-exclamation-triangle fa-2x mb-3 text-danger"></i>
                                    <h5 class="card-title">Incident Report</h5>
                                    <p class="card-text">Report and track incidents efficiently.</p>
                                </div>
                                <span class="text-primary mt-auto">Go to Incident Report &rarr;</span>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
    @include('sweetalert::alert')
</body>
</html>
