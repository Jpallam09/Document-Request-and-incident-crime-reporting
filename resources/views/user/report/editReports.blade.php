<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Incident Report Details</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/css/userCss/editReports.css')
    @vite('resources/js/userJs/editReports.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
    @vite('resources/js/userJs/editReportsLocation.js')
</head>

<body>
    <main class="layout d-flex">
        <x-navbar.user-navbar />

        <section class="page-content flex-grow-1 px-4">
            <!-- Header -->
            <div class="header d-flex justify-content-between align-items-center mb-4">
                <h1>Edit Your Report</h1>
                <a href="{{ route('user.report.viewReports', $report->id) }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i>
                    Back to List
                </a>
            </div>

            {{-- Edit request form --}}
            <form id="editRequestForm" action="{{ route('user.report.requestUpdate', $report->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="report-card">
                    <div class="report-header">
                        <div>
                            <input type="text" id="title" name="title"
                                placeholder="{{ $report->report_title ?? 'Report Title' }}" required>
                            <div>
                                Incident Date:
                                <input type="date" id="incidentDate" name="requested_report_date"
                                    value="{{ $report->report_date }}" required>
                            </div>
                        </div>
                        <div>
                            <select id="incidentType" name="incident_type" required>
                                <option disabled selected>Select a type</option>
                                <option value="Safety" {{ $report->incident_type === 'Safety' ? 'selected' : '' }}>
                                    Safety</option>
                                <option value="Operational"
                                    {{ $report->incident_type === 'Operational' ? 'selected' : '' }}>
                                    Operational</option>
                                <option value="Security" {{ $report->incident_type === 'Security' ? 'selected' : '' }}>
                                    Security</option>
                                <option value="Environmental"
                                    {{ $report->incident_type === 'Environmental' ? 'selected' : '' }}>
                                    Environmental</option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="description-section">
                        <h3>Description</h3>
                        <textarea id="incidentDescription" name="incident_description" required>{{ old('incident_description', $report->report_description) }}</textarea>
                    </div>

                    <div class="card mb-4 p-3 shadow-sm">
                        <div class="row g-3 align-items-center">
                            <!-- Controls: My Location + Barangay -->
                            <div class="col-md-7">
                                <label class="form-label">Incident Location</label>
                                <div id="mapControls" class="w-100 h-100 rounded-3 border bg-light"></div>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <button type="button" id="locateBtn" class="btn btn-outline-primary btn-sm">
                                        <i class="fa-solid fa-location-crosshairs"></i> Use My Location
                                    </button>
                                    <small id="coordsHelpControls" class="text-muted mb-0">Optional</small>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label for="barangay" class="form-label">Barangay</label>
                                <select id="barangay" name="barangay" class="form-select form-select-sm">
                                    <option value="" disabled selected>Select Barangay</option>
                                    <option value="Barangay 1"
                                        {{ $report->barangay === 'Barangay 1' ? 'selected' : '' }}>Barangay 1</option>
                                    <option value="Barangay 2"
                                        {{ $report->barangay === 'Barangay 2' ? 'selected' : '' }}>Barangay 2</option>
                                    <option value="Barangay 3"
                                        {{ $report->barangay === 'Barangay 3' ? 'selected' : '' }}>Barangay 3</option>
                                </select>
                            </div>
                        </div>

                        <!-- Map Preview Row -->
                        <div class="col-12 mt-3">
                            <label class="form-label">Location Preview</label>
                            <div id="mapPreview" class="w-100 rounded-3 border bg-light" style="height: 250px;"></div>
                            <small id="coordsHelpPreview" class="text-muted">Latitude & Longitude will auto-fill
                                here.</small>
                        </div>

                        <input type="hidden" name="latitude" id="latitude"
                            value="{{ old('latitude', $report->latitude) }}">
                        <input type="hidden" name="longitude" id="longitude"
                            value="{{ old('longitude', $report->longitude) }}">
                    </div>

                    <!-- Attachments -->
                    <div class="attachments-section">
                        <h3>Attachments</h3>
                        <div class="attachments-grid" id="attachmentsGrid">
                            @foreach ($report->images as $image)
                                <div class="attachment-item">
                                    <img src="{{ asset('storage/' . $image->file_path) }}" alt="Expanded Attachment"
                                        id="expandedImg" class="attachment-thumb">
                                    <button type="button" class="delete-btn"
                                        onclick="removeExistingImage({{ $image->id }}, this)">
                                        &times;
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <div class="upload-section">
                            <label for="requested_image">Add New Image</label>
                            <input type="file" name="requested_image[]" id="requested_image" accept="image/*"
                                multiple>
                            <span id="fileName"></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm mb-2" id="updateReportBtn">
                    <i class="fas fa-check-circle me-1"></i>
                    Update Report
                </button>
            </form>
            
            <!-- Cancel Editing Button -->
            <button type="button" class="btn btn-outline-danger btn-sm w-auto" id="cancelEditButton"
                data-url="{{ route('user.report.viewReports', $report->id) }}">
                <i class="fas fa-times-circle me-1"></i>
                Cancel Editing
            </button>

            <!-- Modal Viewer -->
            <div id="imageModal" class="image-modal">
                <span class="close" id="modalCloseBtn">&times;</span>
                <img class="modal-content" id="modalImage" />
                <div id="caption"></div>
                <span class="prev" id="modalPrevBtn">&#10094;</span>
                <span class="next" id="modalNextBtn">&#10095;</span>
            </div>
    </main>
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @include('sweetalert::alert')
</body>

</html>
