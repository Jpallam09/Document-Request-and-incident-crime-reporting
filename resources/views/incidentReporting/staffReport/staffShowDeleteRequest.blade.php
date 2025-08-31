<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delete Request Details</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container my-5">

  <h2 class="mb-4">Delete Request Details</h2>
  <a href="deleteRequests.html" class="btn btn-secondary mb-4">Back to All Delete Requests</a>

  <!-- Report Info Section -->
  <div class="card mb-3">
    <div class="card-header fw-bold">Report Info</div>
    <div class="card-body">
      <p class="mb-1"><strong>Title:</strong> Sample Report Title</p>
      <p class="mb-1"><strong>Date:</strong> August 30, 2025</p>
      <p class="mb-1"><strong>Type:</strong> Safety</p>
      <p class="mb-0"><strong>Description:</strong><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
    </div>
  </div>

  <!-- Reason for Deletion Section -->
  <div class="card mb-3">
    <div class="card-header fw-bold">Reason for Deletion</div>
    <div class="card-body">
      <p>The report is no longer relevant and should be removed from the system.</p>
    </div>
  </div>

  <!-- Attached Images Section -->
  <div class="card mb-4">
    <div class="card-header fw-bold">Attached Images</div>
    <div class="card-body">
      <div class="row g-2">
        <!-- Replace with dynamic images -->
        <div class="col-6 col-md-3">
          <img src="https://via.placeholder.com/150" alt="Requested Image 1" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-6 col-md-3">
          <img src="https://via.placeholder.com/150" alt="Requested Image 2" class="img-fluid rounded shadow-sm">
        </div>
        <!-- If no images attached, show fallback -->
        <!-- <p class="text-muted mt-2">No images attached.</p> -->
      </div>
    </div>
  </div>

  <!-- Action Buttons -->
  <div class="d-flex mb-5">
    <button type="button" class="btn btn-success me-2">Accept</button>
    <button type="button" class="btn btn-danger">Reject</button>
  </div>

  <!-- Status if already reviewed -->
  <!-- <p class="text-muted">Reviewed (Approved)</p> -->

</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
