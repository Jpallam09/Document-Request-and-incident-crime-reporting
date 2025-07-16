<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - View All Reports</title>

    @vite('resources/css/staffCss/staffReportView.css')
    @vite('resources/css/componentsCss/navbarCss/navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    @include('components.navbar.staff-navbar')
    @include('components.sidebar.staff-sidebar')

    <main class="layout">
        <section class="page-content">
            <h1>Report List</h1>

            <div class="table-container">
                <table class="report-table">
                    <thead>
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
                        <!-- Sample rows -->
                        <tr>
                            <td>1</td>
                            <td>john_doe</td>
                            <td>Noise Complaint</td>
                            <td>User accidentally submitted wrong report</td>
                            <td>2025-07-09</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <button class="btn-view">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>jane_smith</td>
                            <td>Duplicate Report</td>
                            <td>Report already submitted earlier</td>
                            <td>2025-07-08</td>
                            <td><span class="status approved">Approved</span></td>
                            <td>
                                <button class="btn-view">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
