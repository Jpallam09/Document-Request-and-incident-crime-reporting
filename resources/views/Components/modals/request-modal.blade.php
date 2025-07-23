<!-- Modal -->
<div class="edit-request-modal" id="viewEditRequestModal-{{ $request->id }}">
    <div class="edit-request-dialog">
        <div class="edit-request-content">
            <!-- Header -->
            <div class="edit-request-header">
                <h5 class="edit-request-title">Review Edit Request (Report ID: {{ $request->incident_report_id }})</h5>
                <button type="button" class="edit-request-close" aria-label="Close">×</button>
            </div>

            <!-- Body -->
            <div class="edit-request-body">
                <div class="edit-request-columns">
                    <!-- Original Report -->
                    <div class="edit-original-report">
                        <h6 class="edit-section-title text-primary">Original Report</h6>
                        <div><strong>Title:</strong> {{ $report->title }}</div>
                        <div><strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($report->incident_date)->format('F d, Y') }}</div>
                        <div><strong>Type:</strong> {{ $report->incident_type }}</div>
                        <div><strong>Description:</strong><br>{{ $report->report_description }}</div>
                        <div class="edit-images-label"><strong>Images:</strong></div>
                        <div class="edit-request-attachments">
                            @if ($report->images->count())
                                @foreach ($report->images as $index => $image)
                                    <div>
                                        <img src="{{ asset('storage/' . $image->file_path) }}"
                                            alt="Attachment {{ $index + 1 }}" class="edit-thumbnail"
                                            onclick="openImageModal({{ $index }})">
                                    </div>
                                @endforeach
                            @else
                                <p class="text-light">No attachments provided.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Requested Changes -->
                    <div class="edit-requested-report">
                        <h6 class="edit-section-title text-danger">Requested Changes</h6>
                        <div><strong>Title:</strong> {{ $request->requested_title ?? '—' }}</div>
                        <div><strong>Date:</strong>
                            @if (old('incident_date'))
                                {{ \Carbon\Carbon::parse(old('incident_date'))->format('F d, Y') }}
                            @endif
                        </div>
                        <div><strong>Type:</strong> {{ $request->requested_type ?? '—' }}</div>
                        <div><strong>Description:</strong><br>{{ $request->requested_description ?? '—' }}</div>
                        <div class="edit-images-label"><strong>Requested Images:</strong></div>
                        <div class="edit-request-attachments">
                            @foreach (json_decode($request->requested_images ?? '[]', true) as $image)
                                <img src="{{ asset('storage/' . $image) }}" class="edit-thumbnail"
                                    alt="Requested Image">
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="edit-request-footer">
                <!-- Accept Button inside Modal -->
                <form method="POST"
                    action="{{ route('reporting.staff.updateRequest.accept', ['id' => $editRequest->id]) }}"
                    class="form-accept">
                    @csrf
                    <button type="submit" class="btn-accept">Accept</button>
                </form>

                <!-- Reject Button inside Modal -->
                <form method="POST"
                    action="{{ route('reporting.staff.updateRequest.reject', ['id' => $editRequest->id]) }}"
                    class="form-reject">
                    @csrf
                    <button type="submit" class="btn-reject">Reject</button>
                </form>
            </div>
        </div>
    </div>
</div>
