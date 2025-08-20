<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Report Details</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite('resources/css/staffCss/staffViewReportsFullDetails.css')
    @vite('resources/js/staffJs/staffViewReportsFullDetails.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout">
        <x-navbar.shared-navbar />

        <section class="page-content mt-5">
            <div class="report-details-container">

                <!-- Header and Back Button -->
                <div class="header">
                    <h1 class="report-title">{{ $report->report_title }}</h1>
                    <a href="{{ route('reporting.staff.staffReportView') }}" class="back-link">
                        <i class="fa-solid fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <!-- Report Meta Info -->
                <div class="report-meta">
                    <p><strong>Type:</strong> {{ $report->report_type }}</p>
                    <p><strong>Date Submitted:</strong> {{ $report->created_at->format('Y-m-d') }}</p>
                    <p><strong>Submitted by:</strong> {{ $report->user->username ?? 'Unknown' }}</p>
                </div>

                <!-- Description -->
                <div class="report-description">
                    <h3>Description</h3>
                    <p>{{ $report->report_description }}</p>
                </div>

                <!-- Images -->
                <div class="report-images">
                    <h3>Attached Images</h3>
                    <div class="image-grid">
                        @if ($report->images->count())
                            <div class="attachments-grid">
                                @foreach ($report->images as $index => $image)
                                    <div>
                                        <img
                                            src="{{ asset('storage/' . $image->file_path) }}"
                                            alt="Attachment {{ $index + 1 }}"
                                            class="thumbnail"
                                            onclick="openImageModal({{ $index }})">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-light">No attachments provided.</p>
                        @endif
                    </div>

                    <!-- Modal Viewer -->
                    <div id="imageModal" class="image-modal">
                        <span class="close-modal" onclick="closeModal()">&times;</span>
                        <span class="prev" onclick="changeImage(-1)">&#10094;</span>
                        <span class="next" onclick="changeImage(1)">&#10095;</span>
                        <img id="expandedImg" class="modal-img" src="" alt="Zoomed Image">
                        <div id="caption" class="caption-text"></div>
                    </div>
                </div>

            <a href="{{ route('reporting.staff.staffViewReports.track', $report->id) }}" class="btn btn-primary mt-3"><i class="fa-solid fa-check"></i> Track Report</a>
            
            </div>
        </section>
    </main>
    @include('sweetalert::alert')
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
