<div id="viewEditRequestModal-{{ $request->id }}" class="modal hidden">
    <div class="modal-content">
        <span class="close-modal">&times;</span>

        <h2>Delete Request Details</h2>

        <div class="modal-section">
            <h3>Report Info</h3>
            <p><strong>Title:</strong> {{ $request->report_title ?? 'Untitled' }}</p>
            <p><strong>Date:</strong> {{ $request->report_date }}</p>
            <p><strong>Type:</strong> {{ $request->report_type }}</p>
            <p><strong>Description:</strong> {{ $request->report_description }}</p>
        </div>

        <div class="modal-section">
            <h3>Reason for Deletion</h3>
            <p>{{ $request->reason }}</p>
        </div>

        @if (!empty($request->requested_image) && is_array($request->requested_image))
            <div class="modal-section">
                <h3>Attached Images</h3>
                <div class="image-preview-container">
                    @foreach ($request->requested_image as $img)
                        <img src="{{ asset('storage/' . $img) }}" alt="Requested Image">
                    @endforeach
                </div>  
            </div>
        @endif

        <div class="modal-actions">
            <form method="POST" action="{{ route('reporting.staff.staffDeletionRequests.accept', $request->id) }}">
                @csrf
                <button type="submit" class="btn btn-accept">Accept</button>
            </form>

            <form method="POST" action="{{ route('reporting.staff.staffDeletionRequests.reject', $request->id) }}">
                @csrf
                <button type="submit" class="btn btn-reject">Reject</button>
            </form>
        </div>
    </div>
</div>
