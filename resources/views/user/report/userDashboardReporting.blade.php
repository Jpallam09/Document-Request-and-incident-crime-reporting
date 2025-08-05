<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Dashboard – Incident Reports</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/userCss/userDashboardReporting.css')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>

    <section class="navbar">
        @include('components.navbar.user-navbar')
    </section>

    <main class="layout">
        <section class="page-content">
            <section class="hero" aria-labelledby="dashboard-title">
                <h1 id="dashboard-title">Your Report Lists</h1>
                <p id="summary-text">You have <strong>{{ $reports->count() }}</strong> total reports.</p>
            </section>

            <div class="widgets">
                <article id="totalReportsWidget" class="widget">
                    <h2>Total Reports</h2>
                    <p>{{ $reports->count() }}</p>
                </article>

                <article id="openReportsWidget" class="widget">
                    <h2>Open</h2>
                    <p>{{ $reports->where('is_actioned', false)->count() }}</p>
                </article>

                <article id="resolvedReportsWidget" class="widget">
                    <h2>Resolved</h2>
                    <p>{{ $reports->where('is_actioned', true)->count() }}</p>
                </article>

                <article id="pendingReportsWidget" class="widget">
                    <h2>Pending</h2>
                    <p>{{ $reports->where('is_actioned', false)->count() }}</p>
                </article>
            </div>

            <section aria-label="Incident Reports Table">
                <div class="table-container">
                    <table id="reportsTable" role="grid">
                        <thead>
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
                                    <td>{{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}</td>
                                    <td>{{ $report->report_type }}</td>
                                    <td>
                                        <span
                                            class="status {{ $report->is_actioned ? 'status-closed' : 'status-pending' }}">
                                            {{ $report->is_actioned ? 'Actioned' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="request-status">
                                        @if ($report->editRequest)
                                            @if ($report->editRequest->status === 'pending')
                                                <span class="badge-request badge-edit">Edit Request Sent</span>
                                            @elseif ($report->editRequest->status === 'approved')
                                                <span class="badge-request badge-approved">Edit Request Approved</span>
                                            @elseif ($report->editRequest->status === 'rejected')
                                                <span class="badge-request badge-rejected">Edit Request Rejected</span>
                                            @endif
                                        @elseif ($report->DeleteRequest)
                                            @if ($report->DeleteRequest->status === 'pending')
                                                <span class="badge-request badge-delete">Delete Request Sent</span>
                                            @elseif ($report->DeleteRequest->status === 'accepted')
                                                <span class="badge-request badge-approved">Delete Request
                                                    Approved</span>
                                            @elseif ($report->DeleteRequest->status === 'rejected')
                                                <span class="badge-request badge-rejected">Delete Request
                                                    Rejected</span>
                                            @endif
                                        @else
                                            <span class="badge-request badge-none">None</span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ url('user/report/viewReports/' . $report->id) }}"
                                            class="btn-view">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $reports->links('vendor.pagination.default') }}
                </div>
    </main>
    @include('sweetalert::alert')
</body>

</html>
