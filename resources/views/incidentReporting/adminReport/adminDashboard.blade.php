<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    @vite('resources/css/staffCss/staffDashboard.css')
    @vite('resources/js/staffJs/staffDashboard.js')
</head>

<body>
    @include('components.navbar.admin-navbar')
    <main id="dashboard">
        <section class="widget" id="totalReportsWidget">
            <h2>Total Reports</h2>
            <p id="totalReportsCount">0</p>
        </section>

        <section class="widget" id="pendingDeletionRequestsWidget">
            <h2>Pending Deletion Requests</h2>
            <p id="pendingDeletionsCount">0</p>
        </section>

        <section class="widget" id="pendingUpdateRequestsWidget">
            <h2>Pending Update Requests</h2>
            <p id="pendingUpdatesCount">0</p>
        </section>

        <section class="widget" id="inProgressWidget">
            <h2>Reports in Progress</h2>
            <p id="inProgressCount">0</p>
        </section>

        <section class="widget" id="finishedWidget">
            <h2>Finished Reports</h2>
            <p id="finishedCount">0</p>
        </section>
    </main>

    <script src="staffDashboard.js"></script>
</body>
</html>
