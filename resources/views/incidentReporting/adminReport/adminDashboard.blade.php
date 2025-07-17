<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>

    @vite('resources/css/staffCss/staffDashboard.css')
    @vite('resources/css/componentsCss/navbarCss/navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    @include('components.navbar.admin-navbar')
    @include('components.sidebar.staff-sidebar')

    <main class="layout">
        <section class="page-content">
            <h1 style="margin-top: 0;">Main Dashboard</h1> {{-- Removed large margin here --}}

            <!-- 🟦 Grid wrapper for widgets -->
            <section id="dashboard">
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
            </section>
        </section>
    </main>
</body>
</html>
