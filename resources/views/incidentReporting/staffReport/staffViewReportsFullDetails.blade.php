<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff - Report Details</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
                    <!-- Back to List link -->
                    <a href="{{ route('reporting.staff.staffReportView') }}" class="btn btn-secondary btn-sm">
                        <i class="fa-solid fa-arrow-left"></i> Back to List
                    </a>
                </div>

                <!-- Report Meta Info - Modern Table UI -->
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-primary text-white">
                        <i class="fa-solid fa-info-circle me-2"></i> Report Information
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <tbody>
                                <tr>
                                    <th scope="row" class="w-25">Type</th>
                                    <td>{{ $report->report_type }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date Submitted</th>
                                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Submitted by</th>
                                    <td>{{ $report->user_name ?? 'Unknown' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Description - Modern Card -->
                <div class="card mb-3 shadow-sm border-0">
                    <div class="card-header bg-secondary text-white">
                        <i class="fa-solid fa-align-left me-2"></i> Description
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $report->report_description }}</p>
                    </div>
                </div>


                <!-- Images -->
                <div class="report-images">
                    <h3>Attached Images</h3>
                    <div class="image-grid">
                        @if ($report->images->count())
                            <div class="attachments-grid">
                                @foreach ($report->images as $index => $image)
                                    <div>
                                        <img src="{{ asset('storage/' . $image->file_path) }}"
                                            alt="Attachment {{ $index + 1 }}" class="thumbnail"
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

                <div class="d-flex gap-2 mt-3">
                    <span id="reportStatus" class="d-none bt">{{ $report->report_status }}</span>
                    <a href="{{ route('reporting.staff.staffViewReports.track', $report->id) }}"
                        class="btn btn-primary btn-sm" id="trackReportBtn">
                        <i class="fa-solid fa-check"></i> Track Report
                    </a>

                    <a href="{{ route('reporting.staff.exportPdf', $report->id) }}"
                        class="btn btn-outline-danger btn-sm">
                        <i class="fa-solid fa-file-pdf"></i> PDF
                    </a>
                </div>

            </div>

            </div>
        </section>
    </main>
    @include('sweetalert::alert')
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
