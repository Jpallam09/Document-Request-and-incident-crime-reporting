<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Incident Report Details</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite('resources/css/userCss/viewReports.css')
    @vite('resources/js/userJs/viewReports.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <div class="layout d-flex">
        @include('components.navbar.user-navbar')

        <main class="page-content flex-grow-1 px-4">
            {{-- Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 m-0">Report Details</h1>
                <a href="#" onclick="window.history.back()" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to List
                </a>
            </div>

            {{-- Success Alert --}}
            @if (session('success'))
                <p class="text-success">{{ session('success') }}</p>
            @endif

            @isset($report)
                <div class="report-card bg-white p-4 rounded shadow-sm">
                    {{-- Report Header --}}
                    <div class="report-header d-flex flex-wrap justify-content-between mb-4">
                        <div class="info-box flex-grow-1">
                            <strong>{{ $report->report_title }}</strong>

                            {{-- Status Badge --}}
                            @if ($report->editRequest)
                                @php $status = $report->editRequest->status; @endphp
                                <span
                                    class="badge {{ $status === 'pending' ? 'badge-pending' : ($status === 'accepted' ? 'badge-accepted' : 'badge-rejected') }}">
                                    {{ ucfirst($status) }}
                                </span>
                            @endif

                            {{-- Viewed Badge --}}
                            @if ($report->editRequest && $report->editRequest->is_viewed)
                                <span class="badge badge-viewed">Viewed</span>
                            @endif
                        </div>

                        <div class="info-box">
                            <i class="fa-regular fa-calendar-alt me-1"></i>
                            {{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}
                        </div>

                        <div class="info-box highlight">
                            <i class="fa-solid fa-tag me-1"></i> {{ $report->report_type }}
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="description-section mb-4">
                        <h3 class="h5">Description</h3>
                        <div class="description-box">
                            {{ $report->report_description }}
                        </div>
                    </div>

                    {{-- Attachments --}}
                    <div class="attachments-section mb-4">
                        <h3 class="h5">
                            <i class="fa-solid fa-paperclip me-1"></i> Report Images
                        </h3>

                        @if ($report->images->count())
                            <div class="attachments-grid d-flex flex-wrap gap-3">
                                @foreach ($report->images as $index => $image)
                                    <div class="attachment-item">
                                        <img src="{{ asset('storage/' . $image->file_path) }}"
                                            alt="Attachment {{ $index + 1 }}" class="thumbnail"
                                            onclick="openImageModal({{ $index }})">
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No attachments provided.</p>
                        @endif
                    </div>

                    {{-- Action Buttons --}}
                    <div class="action-buttons d-flex gap-2">
                        <!-- Request Edit Button (no <form>) -->
                        <button type="button" class="btn-primary"
                            onclick="handleEditRequest({{ $report->editRequest && $report->editRequest->status === 'pending' ? 'true' : 'false' }}, '{{ route('user.report.userIncidentReporting.edit', $report->id) }}')">
                            <i class="fa-solid fa-pen"></i> Request Edit
                        </button>

                        <!-- Delete Request Button (uses POST form) -->
                        <form method="POST" action="{{ route('user.report.delete', $report->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete-request">
                                <i class="fa-solid fa-trash me-1"></i> Request Delete
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <p class="text-danger">Report not found or data is missing.</p>
            @endisset

            {{-- Image Modal --}}
            <div id="imageModal" class="image-modal" role="dialog" aria-modal="true">
                <span class="close" onclick="closeModal()" aria-label="Close">&times;</span>
                <span class="prev" onclick="changeImage(-1)">&#10094;</span>
                <span class="next" onclick="changeImage(1)">&#10095;</span>
                <img id="expandedImg" class="modal-content" />
                <div id="caption" class="caption mt-2 text-white text-center"></div>
            </div>
        </main>
    </div>
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
