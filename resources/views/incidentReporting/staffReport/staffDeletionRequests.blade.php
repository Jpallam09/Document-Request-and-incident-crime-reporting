<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Deletion Requests</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
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
                        <!-- Sample row -->
                        <tr>
                            <td>1</td>
                            <td>john_doe</td>
                            <td>Noise Complaint</td>
                            <td>User accidentally submitted wrong report</td>
                            <td>2025-07-09</td>
                            <td><span class="status pending">Pending</span></td>
                            <td>
                                <button class="btn-view">View Report</button>
                                <button class="btn-approve">Approve</button>
                                <button class="btn-reject">Reject</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</body>
</html>
