<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Report</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

    <!-- Custom CSS -->
    @vite('resources/css/staffCss/staffTrackReport.css')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
</head>
<body>
<main class="layout">
    <x-navbar.shared-navbar />

    <section class="page-content">
        <div class="container py-3">

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1 class="h3 mb-0">Track Report Location</h1>
                <a href="{{ route('reporting.staff.staffReportView') }}" class="btn btn-secondary btn-sm">
                    <i class="fa-solid fa-arrow-left"></i> Back to Reports
                </a>
            </div>

            <!-- Report Details -->
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $report->report_title }}</h5>
                    <p><strong>Report ID:</strong> {{ $report->id }}</p>
                    <p><strong>Type:</strong> {{ $report->report_type }}</p>
                    <p><strong>Description:</strong> {{ $report->report_description }}</p>
                    <p><strong>Date Submitted:</strong> {{ $report->created_at->format('Y-m-d') }}</p>
                </div>
            </div>

            <!-- Map -->
            <div class="card mb-3">
                <div class="card-body p-0">
                    <div id="map" class="w-100" style="height: 500px;"></div>
                </div>
            </div>

            <!-- Coordinates -->
            <div class="row mb-3 text-center">
                <div class="col"><strong>Staff Latitude:</strong> <span id="currentLat">-</span></div>
                <div class="col"><strong>Staff Longitude:</strong> <span id="currentLng">-</span></div>
            </div>

            <!-- Track Button -->
            <form id="trackReportForm" class="d-flex justify-content-center mb-3">
                @csrf
                <input type="hidden" name="report_id" value="{{ $report->id }}">
                <input type="hidden" id="incidentLat" value="{{ $report->latitude }}">
                <input type="hidden" id="incidentLng" value="{{ $report->longitude }}">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa-solid fa-location-dot"></i> Start Tracking
                </button>
            </form>

            <!-- Track URL for JS -->
            <div id="trackUrlContainer" data-track-url="{{ route('reporting.staff.trackReport') }}"></div>

            <!-- Response -->
            <div id="responseMessage" class="text-center"></div>

        </div>
    </section>
</main>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
<!-- Custom JS -->
@vite('resources/js/staffJs/staffTrackReport.js')
@vite('resources/js/componentsJs/navbar.js')
@include('sweetalert::alert')
</body>
</html>
