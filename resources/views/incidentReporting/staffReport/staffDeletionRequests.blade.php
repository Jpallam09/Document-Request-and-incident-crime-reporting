<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff - Deletion Requests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/staffCss/staffDeletionRequests.css')
    @vite('resources/js/staffJs/staffDeletionRequest.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
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
                        @foreach ($deleteRequests as $request)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $report->user->user_name ?? 'unkown' }}</td>
                                <td>{{ $report->report->title ?? 'Untitled' }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>{{ $report->created_at->format('Y-m-d') }}</td>
                                <td><span class="status pending">Pending</span></td>
                                <td>
                                    <span class="status {{ strtolower($report->status) }}">
                                        {{ ucfirst($report->status) }}
                                    </span>
                                </td>

                                <td>
                                    <a href="{{ route('reporting.staff.view', $report->report_id) }}"
                                        class="btn-view">View Report</a>

                                    @if ($report->status === 'pending')
                                        <form action="{{ route('reporting.staff.deletion.approve', $report->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn-approve" type="submit">Approve</button>
                                        </form>
                                        <form action="{{ route('staff.report.deletion.reject', $report->id) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            <button class="btn-reject" type="submit">Reject</button>
                                        </form>
                                    @endif
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
