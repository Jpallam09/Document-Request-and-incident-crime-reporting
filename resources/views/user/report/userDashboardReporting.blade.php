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
                            <h1 id="dashboard-title" class="mb-2">Your report summaries</h1>
                        </div>
                    </div>

                    <!-- Widgets Row -->
                    <div class="row g-3 widgets">
                        <!-- Top row (3 widgets) -->
                        <div class="col-md-4">
                            <section class="widget" id="totalReportsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-file-alt"></i> Total reports</h2>
                                    <p class="text-start fw-light small text-muted mb-0">Your total report counts</p>
                                    <p id="count">{{ $totalReports }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-4">
                            <section class="widget" id="openReportsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-envelope-open-text"></i> Unresponded reports</h2>
                                    <p class="text-start fw-light small text-muted mb-0">Your total pending report counts</p>
                                    <p id="count">{{ $pendingReports }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-4">
                            <section class="widget" id="resolvedReportsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-check-circle"></i> Resolved reports</h2>
                                    <p class="text-start fw-light small text-muted mb-0">Your total resolved report counts</p>
                                    <p id="count">{{ $successReports }}</p>
                                </a>
                            </section>
                        </div>

                        <!-- Bottom row (3 widgets) -->
                        <div class="col-md-4">
                            <section class="widget" id="cancelRequestsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-ban"></i> Unsuccessful reports </h2>
                                    <p class="text-start fw-light small text-muted mb-0">Reports that failed to be resolved</p>
                                    <p id="count">{{ $canceledReports }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-4">
                            <section class="widget" id="editRequestsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-edit"></i> Edit requests</h2>
                                    <p class="text-start fw-light small text-muted mb-0">Your total edit requests report counts</p>
                                    <p id="count">{{ $editRequest }}</p>
                                </a>
                            </section>
                        </div>
                        <div class="col-md-4 mb-5">
                            <section class="widget" id="deleteRequestsWidget">
                                <a href="#" class="widget-link">
                                    <h2><i class="fas fa-trash-alt"></i> Delete requests</h2>
                                    <p class="text-start fw-light small text-muted mb-0">Your total delete requests report counts</p>
                                    <p id="count">{{ $deleteRequest }}</p>
                                </a>
                            </section>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col">
                            <h1 id="dashboard-title" class="mb-2">Your Report Lists</h1>
                        </div>
                    </div>

                    {{-- Reports Table --}}
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="table-responsive shadow-sm rounded bg-white p-3">
                                <table class="table table-bordered table-hover text-center align-middle report-table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Report Status</th>
                                            <th>Edit/Delete Requests</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reports as $report)
                                            <tr>
                                                <td>{{ $report->report_title }}</td>
                                                <td>{{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}
                                                </td>
                                                <td>{{ $report->report_type }}</td>
                                                <td>
                                                    @php
                                                        $statusColors = [
                                                            'pending'     => 'bg-warning',
                                                            'in_progress' => 'bg-primary',
                                                            'success'     => 'bg-success',
                                                            'canceled'    => 'bg-danger',
                                                        ];
                                                    @endphp
                                                    <span class="badge {{ $statusColors[$report->report_status] ?? 'bg-secondary' }}">
                                                        {{ ucfirst(str_replace('_', ' ', $report->report_status)) }}
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
