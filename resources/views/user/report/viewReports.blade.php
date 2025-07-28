<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Incident Report Details</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/userCss/editReports.css')
    @vite('resources/js/userJs/viewReports.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <div class="container">
        @include('components.navbar.user-navbar')

        <div class="header">
            <h1>Report Details</h1>
            <a href="{{ route('user.report.userDashboardReporting') }}" class="back-link">
                <i class="fa-solid fa-arrow-left"></i> Back to List
            </a>
        </div>

        @if (session('success'))
            <p class="text-green-600">{{ session('success') }}</p>
        @endif

        @isset($report)
            <div class="report-card">

                <!-- Report Header (readonly info layout) -->
                <div class="report-header">
                    <div class="info-box" style="flex: 1;">
                        <strong>{{ $report->report_title }}</strong>

                        <!-- ✅ Status Badge -->
                        @if ($report->editRequest)
                            @php
                                $status = $report->editRequest->status;
                            @endphp
                            <span
                                class="badge
                            {{ $status === 'pending' ? 'badge-pending' : ($status === 'accepted' ? 'badge-accepted' : 'badge-rejected') }}">
                                {{ ucfirst($status) }}
                            </span>
                        @endif

                        <!-- ✅ Viewed Badge -->
                        @if ($report->editRequest && $report->editRequest->is_viewed)
                            <span class="badge badge-viewed">
                                Viewed
                            </span>
                        @endif
                    </div>

                    <div class="info-box">
                        <i class="fa-regular fa-calendar-alt"></i>
                        {{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}
                    </div>

                    <div class="info-box highlight" style="flex: 0 0 auto;">
                        <i class="fa-solid fa-tag"></i> {{ $report->report_type }}
                    </div>
                </div>

                <!-- Description -->
                <div class="description-section">
                    <h3>Description</h3>
                    <div class="description-box">
                        {{ $report->report_description }}
                    </div>
                </div>

                <!-- Attachments -->
                <div class="attachments-section">
                    <h3><i class="fa-solid fa-paperclip"></i> Report Images</h3>

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

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <!-- Edit Button -->
                    <form action="{{ route('user.report.userIncidentReporting.edit', $report->id) }}" method="GET"
                        style="display: inline;">
                        <button type="submit" class="btn-primary">
                            <i class="fa-solid fa-pen"></i> Request Edit
                        </button>
                    </form>

                    <!-- Delete Button -->
                    <form method="POST" action="{{ route('user.report.delete', $report->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger btn-delete-request">
                            <i class="fa-solid fa-trash"></i> Request Delete
                        </button>
                    </form>
                </div>

            </div>
        @else
            <p class="text-red-600">Report not found or data is missing.</p>
        @endisset

        <!-- Image Modal -->
        <div id="imageModal" class="image-modal">
            <span class="close" onclick="closeModal()">&times;</span>
            <span class="prev" onclick="changeImage(-1)">&#10094;</span>
            <span class="next" onclick="changeImage(1)">&#10095;</span>
            <img id="expandedImg" class="modal-content" />
            <div id="caption" class="caption"></div>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>
