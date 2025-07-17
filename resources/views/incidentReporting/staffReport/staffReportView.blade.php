<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - View All Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite('resources/css/staffCss/staffReportView.css')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
        <section class="page-content">
            <h1>Report List</h1>

            <div class="table-container">
                <table class="report-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Report Title</th>
                            <th>Type</th>
                            <th>Date Submitted</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $index => $report)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $report->user->name ?? 'Unknown' }}</td>
                                <td>{{ $report->report_title }}</td>
                                <td>{{ $report->report_type }}</td>
                                <td>{{ \Carbon\Carbon::parse($report->report_date)->format('M d, Y') }}</td>
                                <td>{{ $report->is_actioned ? 'Resolved' : 'Open' }}</td>
                                <td>
                                    <button type="button" class="btn-view" onclick="window.location='{{ route('reporting.staff.staffViewReportsFullDetails', $report->id) }}'">
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
</body>
</html>
