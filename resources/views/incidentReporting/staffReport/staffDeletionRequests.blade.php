<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff - Deletion Requests</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS -->
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/css/staffCss/staffDeletionRequests.css')

    <!-- JS -->
    @vite('resources/js/staffJs/staffDeletionRequest.js')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout d-flex">
       <x-navbar.shared-navbar />

        <section class="page-content flex-grow-1 pt-5 px-4">
            <div class="container">
                <!-- Page Title -->
                <div class="row mt-4 mb-4">
                    <div class="col">
                        <h1 class="page-title">Deletion Requests</h1>
                    </div>
                </div>
                <!-- Table Section -->
                <div class="row">
                    <div class="col-12">
                        <div class="table-container">
                            <div class="table-responsive bg-white p-3 less-rounded">
                                <table class="table table-bordered table-hover align-middle text-center report-table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>#</th>
                                            <th>User</th>
                                            <th>Report Title</th>
                                            <th>Reason</th>
                                            <th>Date Requested</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deleteRequests as $index => $request)
                                            <tr class="align-middle">
                                                <td>{{ $index + 1 }}</td>
                                                <td class="text-capitalize text-truncate table-col-user">
                                                    {{ $request->user->user_name ?? 'Unknown' }}
                                                </td>
                                                <td class="text-truncate table-col-title">
                                                    {{ $request->report_title }}
                                                </td>
                                                <td class="text-truncate table-col-reason">
                                                    {{ $request->reason }}
                                                </td>
                                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ strtolower($request->status) === 'pending' ? 'warning' : (strtolower($request->status) === 'approved' ? 'success' : 'danger') }}">
                                                        {{ ucfirst($request->status) }}
                                                    </span>
                                                </td>
                                                <td class="action-col">
                                                    <div class="d-grid">
                                                        <button
                                                            class="btn btn-sm btn-outline-primary w-100 openModalBtn"
                                                            data-modal="viewEditRequestModal-{{ $request->id }}">
                                                            <i class="fas fa-eye"></i> View
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @if ($deleteRequests->isEmpty())
                                    <div class="text-center text-muted py-4">
                                        <i class="fas fa-inbox fa-2x mb-2"></i>
                                        <p class="mb-0">No deletion requests found.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal Wrapper -->
    <div class="modal-wrapper">
        <section>
            @foreach ($deleteRequests as $request)
                @include('components.modals.delete-modal', [
                    'report' => $request->report,
                    'request' => $request,
                ])
            @endforeach
        </section>
    </div>

    @include('sweetalert::alert')

    <!-- Bootstrap JS -->
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
