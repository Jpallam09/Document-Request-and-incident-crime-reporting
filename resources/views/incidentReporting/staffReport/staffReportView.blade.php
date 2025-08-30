<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff - View All Reports</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/css/staffCss/staffReportView.css')

    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout d-flex">
        <x-navbar.shared-navbar />

        <section class="page-content flex-grow-1 pt-5 px-4">
            <div class="container-fluid">

                <!-- Page Title -->
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <h1 class="page-title">Report List</h1>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shadow-sm rounded bg-white p-3">
                            <table class="table table-bordered table-hover align-middle text-center report-table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>report_id</th>
                                        <th>Username</th>
                                        <th>Report Title</th>
                                        <th>Report Type</th>
                                        <th>Date Submitted</th>
                                        <th>Report Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $index => $report)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td class="text-capitalize">{{ $report->user->user_name ?? 'Unknown' }}</td>
                                            <td>{{ $report->report_title }}</td>
                                            <td>{{ $report->report_type }}</td>
                                            <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
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
                                            <td style="width: 120px;">
                                                <div class="d-grid">
                                                    <button type="button" class="btn btn-sm btn-outline-primary w-100"
                                                        onclick="window.location='{{ route('reporting.staff.staffViewReportsFullDetails', $report->id) }}'">
                                                        <i class="fas fa-eye"></i> View
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @if ($reports->isEmpty())
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">No reports found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pagination (optional, remove if unused) -->
                
                <div class="row mt-4">
                    <div class="col d-flex justify-content-center">
                        {{ $reports->links('vendor.pagination.default') }}
                    </div>
                </div>
               
            </div>
        </section>
    </main>

    @include('sweetalert::alert')
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
