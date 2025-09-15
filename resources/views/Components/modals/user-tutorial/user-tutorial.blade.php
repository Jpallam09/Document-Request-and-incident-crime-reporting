<!-- Create Report Modal -->
<div class="modal fade" id="createReportModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered ">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title">Create a Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="createReportSteps">
          <div class="step" data-step="1">
            <h6>Step 1: Click "Create Report"in the sidebar to open the report form page</h6>
            <img src="{{ asset('images/tutorials/create_tuts_2.png') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 1">
          </div>
          <div class="step d-none" data-step="2">
            <h6>Step 2: Fill in required details from the form</h6>
            <img src="{{ asset('images/tutorials/create_tuts_1.png') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 2">
          </div>
          <div class="step d-none" data-step="3">
            <h6>Step 3: Click Submit to send your report for review</h6>
            <img src="{{ asset('images/tutorials/create_tuts_3.png') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 3">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary prevBtn btn-sm">Previous</button>
        <button type="button" class="btn btn-primary nextBtn btn-sm">Next</button>
      </div>
    </div>
  </div>
</div>

<!-- View Reports Modal -->
<div class="modal fade" id="viewReportsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">View Reports</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="viewReportsSteps">
          <div class="step" data-step="1">
            <h6>Step 1: Navigate to "View reports list" from your sidebar</h6>
            <img src="{{ asset('images/tutorials/view_tuts_1.png') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 1">
          </div>
          <div class="step d-none" data-step="2">
            <h6>Step 2: Click on "view" button to see detailed information</h6>
            <img src="{{ asset('images/tutorials/view_tuts_2.png') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 2">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary prevBtn btn-sm">Previous</button>
        <button type="button" class="btn btn-primary nextBtn btn-sm">Next</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit/Delete Modal -->
<div class="modal fade" id="editDeleteModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit or Delete Report</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="editDeleteSteps">
          <div class="step" data-step="1">
            <h6>Step 1: Select the report you want to edit or delete</h6>
            <img src="{{ asset('images/edit-delete-step1.jpg') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 1">
          </div>
          <div class="step d-none" data-step="2">
            <h6>Step 2: Make your edits or click "Request Delete"</h6>
            <img src="{{ asset('images/edit-delete-step2.jpg') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 2">
          </div>
          <div class="step d-none" data-step="3">
            <h6>Step 3: Submit changes. Staff will review your request</h6>
            <img src="{{ asset('images/edit-delete-step3.jpg') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 3">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary prevBtn btn-sm">Previous</button>
        <button type="button" class="btn btn-primary nextBtn btn-sm">Next</button>
      </div>
    </div>
  </div>
</div>

<!-- Track Status Modal -->
<div class="modal fade" id="trackStatusModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Track Status</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div id="trackStatusSteps">
          <div class="step" data-step="1">
            <h6>Step 1: Navigate to "View reports list" from your sidebar</h6>
            <img src="{{ asset('images/tutorials/view_tuts_1.png') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 1">
          </div>
          <div class="step d-none" data-step="2">
            <h6>Step 2: Check status updates displayed next to each report</h6>
            <img src="{{ asset('images/track-status-step2.jpg') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 2">
          </div>
          <div class="step d-none" data-step="3">
            <h6>Step 3: Click on a report to see detailed progress</h6>
            <img src="{{ asset('images/track-status-step3.jpg') }}" class="img-fluid rounded shadow-lg mb-3" alt="Step 3">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary prevBtn btn-sm">Previous</button>
        <button type="button" class="btn btn-primary nextBtn btn-sm">Next</button>
      </div>
    </div>
  </div>
</div>
