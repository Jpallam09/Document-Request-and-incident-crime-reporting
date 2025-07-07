<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Incident Report Details</title>
    @vite('resources/css/userCss/viewReports.css')
    @vite('resources/js/userJs/viewReports.js')
</head>

<body>
<div class="container">

    <div class="header">
        <h1>Your Report Details</h1>
        <a href="{{ route('user.report.userDashboardReporting') }}" class="btn-back">
            &larr; Back to List
        </a>
    </div>

    @if(session('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif

    @isset($report)
        @php
            $images = is_array($report->report_image)
                ? $report->report_image
                : (json_decode($report->report_image, true) ?? [$report->report_image]);
        @endphp

        <div class="report-card">
            <div class="report-header">
                <div>
                    <h2 class="text-2xl font-semibold mb-2">{{ $report->report_title }}</h2>
                    <div class="text-gray-500 text-sm mb-4">
                        Incident Date:
                        <span class="font-medium">
                            {{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}
                        </span>
                    </div>
                </div>
                <div class="flex justify-end">
                    <span class="px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $report->report_type }}
                    </span>
                </div>
            </div>

            <div class="description-box mb-6">
                {{ $report->report_description }}
            </div>

            <div class="attachments-section mb-6">
            <h3>Report Images</h3>
            @if (!empty($images) && count(array_filter($images)))
                <div class="attachments-grid">
                    @foreach ($images as $index => $image)
                        <div class="border rounded-md overflow-hidden">
                            <img src="{{ asset('storage/' . $image) }}"
                                data-full="{{ asset('storage/' . $image) }}"
                                alt="Attachment {{ $index + 1 }}"
                                class="thumbnail"
                                style="cursor: pointer; max-width: 150px;"
                                onclick="openImageModal({{ $index }})">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500">No attachments provided.</p>
            @endif
        </div>

            <div class="action-buttons">
                <a href="{{ route('user.report.userIncidentReporting.edit', $report->id) }}" class="btn-primary">
                    Edit Report
                </a>

                <form method="POST" action="{{ route('user.report.userIncidentReporting.destroy', $report->id) }}" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger"
                            onclick="return confirm('Are you sure you want to delete this report?');">
                        Delete Report
                    </button>
                </form>
            </div>
        </div>
    @else
        <p class="text-red-600">Report not found or data is missing.</p>
    @endisset

    <!-- Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <span class="prev" onclick="changeImage(-1)">&#10094;</span>
        <span class="next" onclick="changeImage(1)">&#10095;</span>
        <img id="expandedImg" class="modal-content" />
        <div id="caption" class="caption"></div>
    </div>
</div>
</body>
</html>
