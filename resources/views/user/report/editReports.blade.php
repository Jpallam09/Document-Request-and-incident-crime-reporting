<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report Details</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/userCss/editReports.css')
    @vite('resources/js/userJs/editReports.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <div class="layout">
        <div class="container">
            @include('components.navbar.user-navbar')

            <!-- Header -->
            <div class="header">
                <h1>Edit Your Report</h1>
                <a href="#" onclick="window.history.back()" class="back-link">
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
                                    {{ $report->incident_type === 'Operational' ? 'selected' : '' }}>Operational
                                </option>
                                <option value="Security" {{ $report->incident_type === 'Security' ? 'selected' : '' }}>
                                    Security</option>
                                <option value="Environmental"
                                    {{ $report->incident_type === 'Environmental' ? 'selected' : '' }}>Environmental
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="description-section">
                        <h3>Description</h3>
                        <textarea id="incidentDescription" name="incident_description" required>{{ old('incident_description', $report->report_description) }}</textarea>
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
                            {{-- Removed duplicate <label for="imageInput"> --}}
                            <span id="fileName"></span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <button type="submit" class="btn-primary" id="updateReportBtn">
                    <i class="fas fa-check-circle"></i>
                    Update Report
                </button>
            </form>

            {{-- Discard button --}}
            <form action="{{ route('user.report.discardUpdate', $report->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to discard this request?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Discard Request</button>
            </form>
        </div>

        <!-- Modal Viewer -->
        <div id="imageModal" class="image-modal">
            <span class="close" id="modalCloseBtn">&times;</span>
            <img class="modal-content" id="modalImage" />
            <div id="caption"></div>
            <span class="prev" id="modalPrevBtn">&#10094;</span>
            <span class="next" id="modalNextBtn">&#10095;</span>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>
