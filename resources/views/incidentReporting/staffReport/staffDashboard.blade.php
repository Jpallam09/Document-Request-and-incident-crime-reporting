<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/staffCss/staffDashboard.css')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/Shared-navbar.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
        <div class="page-content">
            <h1>Main Dashboard</h1>

            <section id="dashboard">
                <section class="widget" id="totalReportsWidget">
                    <a href=""  title="Click to view all reports" class="widget-link">
                        <h2><i class="fas fa-file-alt"></i> Total Reports</h2>
                        <p id="totalReportsCount">0</p>
                    </a>
                </section>

                <section class="widget" id="pendingDeletionRequestsWidget">
                    <a href="" class="widget-link"  title="Click to view all pending delete reports">
                        <h2><i class="fas fa-trash-alt"></i> Pending Deletion Requests</h2>
                        <p id="pendingDeletionsCount">{{ $totalPendingDeleteRequests }}</p>
                    </a>
                </section>

                <section class="widget" id="pendingUpdateRequestsWidget">
                    <a href="" class="widget-link"  title="Click to view all edit request reports">
                        <h2><i class="fas fa-edit"></i> Pending Update Requests</h2>
                        <p id="pendingUpdatesCount">0</p>
                    </a>
                </section>

                <section class="widget" id="inProgressWidget" >
                    <a href="" class="widget-link" title="Click to view all reports in progress">
                        <h2><i class="fas fa-spinner"></i> Reports in Progress</h2>
                        <p id="inProgressCount">0</p>
                    </a>
                </section>

                <section class="widget" id="finishedWidget" >
                    <a href="" title="Click to view all reports finished" class="widget-link">
                        <h2><i class="fas fa-check-circle"></i> Finished Reports</h2>
                        <p id="finishedCount">0</p>
                    </a>
                </section>
            </section>
        </div>
    </main>
</body>

</html>
