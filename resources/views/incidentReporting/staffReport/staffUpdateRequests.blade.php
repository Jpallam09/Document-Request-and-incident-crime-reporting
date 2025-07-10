<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Update Requests</title>
    @vite('resources/css/staffCss/staffUpdateRequests.css')
    @vite('resources/js/staffJs/staffUpdateRequests.js')
</head>
<body>
    {{-- Reusable staff navbar --}}
    @include('components.navbar.staff-navbar')

    <div class="page-title">
        <h1>Edit Requests</h1>
    </div>

    <div class="table-container">
        <table class="report-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Original Title</th>
                    <th>Requested Change</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample row for now -->
                <tr>
                    <td>1</td>
                    <td>jane_doe</td>
                    <td>Leaking Pipe</td>
                    <td>Wants to update the location and description</td>
                    <td>2025-07-09</td>
                    <td><span class="status pending">Pending</span></td>
                    <td>
                        <button class="btn-view">View Request</button>
                        <button class="btn-approve">Approve</button>
                        <button class="btn-reject">Reject</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
