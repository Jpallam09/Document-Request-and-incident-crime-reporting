<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/staffCss/staffDashboard.css')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/Shared-navbar.js')
    @vite('resources/js/staffJs/staffDashboard.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
        <div class="page-content">
            <h1>Main Dashboard</h1>

            <section id="dashboard">
                <div class="dashboard-row widgets">
                    <section class="widget" id="totalReportsWidget">
                        <a href="" title="Click to view all reports" class="widget-link">
                            <h2><i class="fas fa-file-alt"></i> Total Reports</h2>
                            <p id="totalReportsCount">{{ $totalIncidentReports }}</p>
                        </a>
                    </section>

                    <section class="widget" id="pendingDeletionRequestsWidget">
                        <a href="" class="widget-link" title="Click to view all pending delete reports">
                            <h2><i class="fas fa-trash-alt"></i> Pending Deletion Requests</h2>
                            <p id="pendingDeletionsCount">{{ $totalPendingDeleteRequests }}</p>
                        </a>
                    </section>

                    <section class="widget" id="pendingUpdateRequestsWidget">
                        <a href="" class="widget-link" title="Click to view all edit request reports">
                            <h2><i class="fas fa-edit"></i> Pending Edit Requests</h2>
                            <p id="pendingUpdatesCount">{{ $totalPendingEditRequests }}</p>
                        </a>
                    </section>
                </div>

                <!-- Row 2: Monthly (wide) + Type (narrow) -->
                <div class="dashboard-row charts">
                    <section class="wide-chart" id="monthlyTrendChartSection">
                        <div class="chart-card">
                            <h3><i class="fas fa-chart-line"></i> Monthly Reports Trend</h3>
                            <canvas id="monthlyReportsChart"></canvas>
                        </div>
                    </section>

                    <section class="narrow-chart" id="reportTypeDistributionSection">
                        <div class="chart-card">
                            <h3><i class="fas fa-chart-pie"></i> Report Type Distribution</h3>
                            <canvas id="reportTypeChart"></canvas>
                        </div>
                    </section>
                </div>

                <!-- Row 3: Completion chart full width -->
                <div class="dashboard-row bottom">
                    <!-- Reports by Department Chart -->
                    <section class="chart-section" id="reportsByDepartmentChartSection">
                        <div class="chart-card">
                            <h3><i class="fas fa-building"></i>Reports by Barangay</h3>
                            <canvas id="reportsByDepartmentChart"></canvas>
                        </div>
                    </section>
                    <!-- Report Completion Status Chart -->
                    <section class="chart-section" id="reportCompletionChartSection">
                        <div class="chart-card">
                            <h3><i class="fas fa-check-circle"></i> Report Completion Status</h3>
                            <canvas id="completionStatusChart"></canvas>
                        </div>
                    </section>
                </div>
            </section>
        </div>
    </main>
</body>

</html>
