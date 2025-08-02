    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Staff - Deletion Requests</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        @vite('resources/css/staffCss/staffDeletionRequests.css')
        @vite('resources/js/staffJs/staffDeletionRequest.js')
        @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
        @vite('resources/js/componentsJs/navbar.js')
    </head>

    <body>
        <main class="layout">
            @include('components.navbar.shared-navbar')
            <section class="page-content">
                <h1>Deletion Requests</h1>

                <div class="table-container">
                    <table class="report-table">
                        <thead>
                            <tr>
                                <th>id</th>
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
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $request->user->user_name ?? 'Unknown' }}</td>
                                    <td>{{ $request->report_title }}</td>
                                    <td>{{ $request->reason }}</td> 

                                    <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                    <td>
                                        <span class="status {{ strtolower($request->status) }}">
                                            {{ ucfirst($request->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <button class="openModalBtn"
                                            data-modal="viewEditRequestModal-{{ $request->id }}">
                                            View
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
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
    </body>

    </html>
