<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff - Update Requests</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/css/staffCss/staffUpdateRequests.css')
    @vite('resources/css/componentsCss/ModalCss/viewRequestModal.css')

    @vite('resources/js/staffJs/staffUpdateRequests.js')
    @vite('resources/js/componentsJs/navbar.js')
    @vite('resources/js/componentsJs/viewRequestModal.js')
</head>

<body>
    <main class="layout">
        <div class="navbar-wrapper">
            <section>
                @include('components.navbar.Shared-navbar')
            </section>
        </div>

        <section class="page-content">
            <h1>Edit Requests</h1>

            <div class="table-container">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Original Title</th>
                            <th>Requested Title</th>
                            <th>Requested Description</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $index => $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $request->user->user_name ?? 'Unknown' }}</td>
                                <td>{{ $request->report->report_title ?? 'No Title' }}</td>
                                <td>{{ $request->requested_title ?? '—' }}</td>
                                <td>{{ $request->requested_description ?? '—' }}</td>
                                <td>
                                    {{ $request->requested_at ? \Carbon\Carbon::parse($request->requested_at)->format('M d, Y') : 'N/A' }}
                                </td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>
                                    <button class="btn-view-request" data-request-id="{{ $request->id }}">
                                        View Request
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="pagination-wrapper">
                {{ $requests->links('vendor.pagination.default') }}
            </div>
        </section>
    </main>
    <div class="modal-wrapper">
        <section>
            @foreach ($requests as $request)
                @include('components.modals.request-modal', [
                    'report' => $request->report,
                    'request' => $request,
                ])
            @endforeach
        </section>
    </div>
    @include('sweetalert::alert')
</body>

</html>
