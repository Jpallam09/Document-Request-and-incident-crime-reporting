<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Request Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />


    @vite([
        'resources/css/componentsCss/navbarCss/Shared-navbar.css',
        // 'resources/css/staffCss/staffShowEditRequest.css',
        'resources/js/staffJs/staffShowEditRequest.js',
    ])

<body>

    <div class="layout d-flex">
        <x-navbar.shared-navbar />

        <div class="page-content flex-grow-1 pt-5 px-4 mt-4">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Review Edit Request (Submitted by: {{ $request->user->user_name }})</h2>
                    <a href="{{ route('reporting.staff.staffUpdateRequests') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i> Back to All Edit Requests
                    </a>
                </div>
                <div class="row g-4">
                    <!-- Original Report -->
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h6 class="text-primary">Original Report</h6>
                                <p><strong>Title:</strong> {{ $request->report->report_title }}</p>
                                <p><strong>Date:</strong>
                                    {{ \Carbon\Carbon::parse($request->report->report_date)->format('M d, Y') }}</p>
                                <p><strong>Type:</strong> {{ $request->report->report_type }}</p>
                                <p><strong>Description:</strong><br>{{ $request->report->report_description }}</p>
                                <!-- Original Report Location -->
                                <p><strong>Original Location:</strong></p>
                                @if (!empty($request->report->latitude) && !empty($request->report->longitude))
                                    <div id="originalMap" class="w-100 mb-3 border rounded" style="height:250px;"></div>
                                @else
                                    <div class="border rounded d-flex flex-column align-items-center justify-content-center text-muted mb-3"
                                        style="height:250px;">
                                        <i class="fa-solid fa-map-location-dot fa-2x mb-2"></i>
                                        <span>No location provided</span>
                                    </div>
                                @endif
                                <!-- Original Report Images -->
                                <p><strong>Images:</strong></p>
                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Original Report Images -->
                                </div>
                                @if ($report->images && $report->images->count() > 0)
                                    @foreach ($report->images as $img)
                                        <img src="{{ asset('storage/' . $img->file_path) }}" alt="Original Image"
                                            class="img-thumbnail me-2 mb-2" style="max-width:150px;">
                                    @endforeach
                                @else
                                    <p class="text-muted">No images attached.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Requested Changes -->
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h6 class="text-danger">Requested Changes</h6>
                                <p><strong>Title:</strong> {{ $request->requested_title ?? '—' }}</p>
                                <p><strong>Date:</strong>
                                    {{ $request->requested_report_date ? \Carbon\Carbon::parse($request->requested_report_date)->format('M d, Y') : '—' }}
                                </p>
                                <p><strong>Type:</strong> {{ $request->requested_type ?? '—' }}</p>
                                <p><strong>Description:</strong><br>{{ $request->requested_description ?? '—' }}</p>
                                <!-- Requested Changes Location -->
                                <p><strong>Edit Request Location:</strong></p>
                                @if (!empty($request->requested_latitude) && !empty($request->requested_longitude))
                                    <div id="requestedMap" class="w-100 mb-3 border rounded" style="height:250px;">
                                    </div>
                                @elseif(!empty($request->report->latitude) && !empty($request->report->longitude))
                                    <div class="border rounded d-flex flex-column align-items-center justify-content-center text-muted mb-3"
                                        style="height:250px;">
                                        <i class="fa-solid fa-map-location-dot fa-2x mb-2"></i>
                                        <span>No location change requested</span>
                                    </div>
                                @else
                                    <div class="border rounded d-flex flex-column align-items-center justify-content-center text-muted mb-3"
                                        style="height:250px;">
                                        <i class="fa-solid fa-map-location-dot fa-2x mb-2"></i>
                                        <span>No location available</span>
                                    </div>
                                @endif
                                <!-- Requested Images -->
                                <p><strong>Edit Request Images:</strong></p>
                                <div class="d-flex flex-wrap gap-2">
                                    <!-- Requested Images -->
                                    @if (!empty($request->requested_image) && is_array($request->requested_image))
                                        @foreach ($request->requested_image as $img)
                                            <img src="{{ asset('storage/' . $img) }}" alt="Requested Image"
                                                class="img-thumbnail me-2 mb-2" style="max-width:150px;">
                                        @endforeach
                                    @else
                                        <p class="text-muted">No requested images.</p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                @if ($request->status === 'pending')
                    <div class="mt-4 d-flex gap-2">
                        <!-- Accept Form -->
                        <form action="{{ route('reporting.staff.updateRequest.accept', $request->id) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-check me-1"></i> Accept
                            </button>
                        </form>

                        <!-- Reject Form -->
                        <form action="{{ route('reporting.staff.updateRequest.reject', $request->id) }}"
                            method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">
                                <i class="fa-solid fa-xmark me-1"></i> Reject
                            </button>
                        </form>
                    </div>
                @else
                    <div class="alert alert-{{ $request->status === 'rejected' ? 'danger' : 'success' }} mt-4" role="alert">
                        Edit Request {{ ucfirst($request->status) }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.reportData = {
            originalLat: @json($request->report->latitude),
            originalLng: @json($request->report->longitude),
            requestedLat: @json($request->requested_latitude),
            requestedLng: @json($request->requested_longitude),
        };
    </script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</body>

</html>
