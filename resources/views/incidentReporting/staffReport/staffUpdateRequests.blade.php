<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff - Update Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Custom CSS -->
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/css/staffCss/staffUpdateRequests.css')
    @vite('resources/css/componentsCss/ModalCss/viewRequestModal.css')

    <!-- JS -->
    @vite('resources/js/staffJs/staffUpdateRequests.js')
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
                        <h1 class="page-title">Edit Requests</h1>
                    </div>
                </div>
                <!-- Table Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive shadow-sm rounded bg-white p-3">
                            <table
                                class="table table-bordered table-striped table-hover align-middle text-center report-table">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Username</th>
                                        <th>Reason</th>
                                        <th>Original Title</th>
                                        <th>Requested Title</th>
                                        <th>Requested Description</th>
                                        <th>Report status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
<tbody>
    @foreach ($requests as $index => $request)
        <tr class="align-middle">
            <td class="text-capitalize text-truncate" style="max-width: 120px;">
                {{ $request->user->user_name ?? 'Unknown' }}
            </td>

            <!-- Reason column -->
            <td class="text-truncate" style="max-width: 200px;">
                {{ $request->reason ?? '—' }}
            </td>

            <!-- Original Title -->
            <td class="text-truncate" style="max-width: 150px;">
                {{ $request->report->report_title ?? 'No Title' }}
            </td>

            <!-- Requested Title -->
            <td class="text-truncate" style="max-width: 150px;">
                {{ $request->requested_title ?? '—' }}
            </td>

            <!-- Requested Description -->
            <td class="text-truncate" style="max-width: 200px;">
                {{ $request->requested_description ?? '—' }}
            </td>

            <!-- Status -->
            <td>
                <span class="badge bg-{{ strtolower($request->status) === 'pending' ? 'warning' : (strtolower($request->status) === 'approved' ? 'success' : 'danger') }}">
                    {{ ucfirst($request->status) }}
                </span>
            </td>

            <!-- Action -->
            <td style="width: 120px;">
                <div class="d-grid">
                    <a href="{{ route('reporting.staff.editRequest.show', $request->id) }}"
                       class="btn btn-sm btn-primary w-100">
                        <i class="fas fa-eye"></i> View
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
</tbody>
                            </table>
                            @if ($requests->isEmpty())
                                <div class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2"></i>
                                    <p class="mb-0">No edit requests found.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="row mt-4">
                    <div class="col d-flex justify-content-center">
                        <div class="pagination-wrapper">
                            {{ $requests->links('vendor.pagination.default') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('sweetalert::alert')

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
