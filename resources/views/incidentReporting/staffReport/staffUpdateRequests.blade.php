<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Update Requests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite('resources/css/staffCss/staffUpdateRequests.css')
    @vite('resources/js/staffJs/staffUpdateRequests.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
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
                            <td>{{ \Carbon\Carbon::parse($request->requested_at)->format('M d, Y') }}</td>
                            <td>{{ ucfirst($request->status) }}</td>
                            <td>
                                <button class="btn-view" data-request-id="{{ $request->id }}">View</button>
                                {{-- Future: Approve / Reject buttons can go here --}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
