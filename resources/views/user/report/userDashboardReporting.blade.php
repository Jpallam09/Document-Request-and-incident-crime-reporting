    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>User Dashboard – Incident Reports</title>

        {{-- Bootstrap and Icons --}}
        <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Vite Assets --}}
        @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
        @vite('resources/css/userCss/userDashboardReporting.css')
        @vite('resources/js/componentsJs/navbar.js')
    </head>

    <body>
        {{-- Navbar --}}
        <main class="layout d-flex">
            <x-navbar.user-navbar />

            <section class="page-content flex-grow-1 pt-5 px-4">
                <div class="container-fluid">
                    {{-- Hero Section --}}
                    <div class="row mb-4">
                        <div class="col">
                            <h1 id="dashboard-title" class="mb-2">Your Report Lists</h1>
                            <p id="summary-text">
                                You have <strong>{{ $reports->count() }}</strong> total reports.
                            </p>
                        </div>
                    </div>
                    <!-- Widgets Row -->
                    <div class="row g-3 widgets">
                        <div class="col-md-3">
                            <section class="widget" id="totalReportsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-file-alt"></i> Total Reports</h2>
                                    <p>{{ $reports->count() }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-3">
                            <section class="widget" id="openReportsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-envelope-open-text"></i> Open</h2>
                                    <p>{{ $reports->where('is_actioned', false)->count() }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-3">
                            <section class="widget" id="resolvedReportsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-check-circle"></i> Resolved</h2>
                                    <p>{{ $reports->where('is_actioned', true)->count() }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-3">
                            <section class="widget" id="pendingRequestsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-clock"></i> Pending Requests</h2>
                                    <p>
                                        {{ $reports->filter(function ($r) {
                                                return $r->editRequest || $r->deleteRequest;
                                            })->count() }}
                                    </p>
                                </a>
                            </section>
                        </div>
                    </div>
                    {{-- Reports Table --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="table-responsive shadow-sm rounded bg-white p-3">
                                <table class="table table-bordered table-hover text-center align-middle report-table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Request</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>{{ $report->id }}</td>
                                                <td>{{ $report->report_title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}
                                                </td>
                                                <td>{{ $report->report_type }}</td>
                                                <td>
                                                    <span
                                                        class="badge {{ $report->is_actioned ? 'bg-success' : 'bg-warning' }}">
                                                        {{ $report->is_actioned ? 'Actioned' : 'Pending' }}
                                                    </span>
                                                </td>
                                                <td class="request-status">
                                                    @if ($report->editRequest)
                                                        <span
                                                            class="badge 
                                                            {{ $report->editRequest->status === 'pending'
                                                                ? 'bg-warning'
                                                                : ($report->editRequest->status === 'approved'
                                                                    ? 'bg-success'
                                                                    : 'bg-danger') }}">
                                                            Edit Request {{ ucfirst($report->editRequest->status) }}
                                                        </span>
                                                    @elseif ($report->deleteRequest)
                                                        <span
                                                            class="badge 
                                                    {{ $report->deleteRequest->status === 'pending'
                                                        ? 'bg-warning'
                                                        : ($report->deleteRequest->status === 'approved' || $report->deleteRequest->status === 'accepted'
                                                            ? 'bg-success'
                                                            : 'bg-danger') }}">
                                                            Delete Request
                                                            {{ ucfirst($report->deleteRequest->status) }}
                                                        </span>
                                                    @else
                                                        <span class="badge bg-secondary">None</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ url('user/report/viewReports/' . $report->id) }}"
                                                        class="btn btn-sm btn-outline-primary d-inline-flex align-items-center">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if ($reports->isEmpty())
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">No incident reports found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Pagination --}}
                    <div class="row mt-4">
                        <div class="col d-flex justify-content-center">
                            {{ $reports->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </section>
        </main>

        @include('sweetalert::alert')

        {{-- Bootstrap JS (Optional) --}}
        <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
    </body>

    </html>
