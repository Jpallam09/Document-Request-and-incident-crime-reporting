document.addEventListener('DOMContentLoaded', () => {
  const viewButtons = document.querySelectorAll('.btn-view-request');
  const acceptButtons = document.querySelectorAll('.btn-accept');
  const rejectButtons = document.querySelectorAll('.btn-reject');

  // Handle View Button & Modal
  viewButtons.forEach(button => {
    const requestId = button.dataset.requestId;
    const modal = document.getElementById(`viewEditRequestModal-${requestId}`);
    if (!modal) return;

    const closeButton = modal.querySelector('.edit-request-close');

    // Open modal
    button.addEventListener('click', () => {
      modal.classList.add('active');
      document.body.classList.add('no-scroll');
    });

    // Close modal via X button
    closeButton?.addEventListener('click', () => {
      modal.classList.remove('active');
      document.body.classList.remove('no-scroll');
    });

    // Close modal via clicking outside the dialog
    modal.addEventListener('click', (event) => {
      if (event.target === modal) {
        modal.classList.remove('active');
        document.body.classList.remove('no-scroll');
      }
    });
  });

  // Handle Accept Button
  acceptButtons.forEach(button => {
    button.addEventListener('click', () => {
      const requestId = getRequestIdFromModal(button);
      if (requestId && confirm('Are you sure you want to accept this edit request?')) {
        window.location.href = `/staff/update-request/accept/${requestId}`;
      }
    });
  });

    // Handle Reject Button
rejectButtons.forEach(button => {
  button.addEventListener('click', () => {
    const requestId = getRequestIdFromModal(button);
    if (requestId && confirm('Are you sure you want to reject this edit request?')) {
      const form = document.querySelector(`#viewEditRequestModal-${requestId} .form-reject`);
      if (form) {
        form.submit(); // ✅ Submit POST request
      }
    }
  });
});



  // Helper: Get request ID from modal ID
  function getRequestIdFromModal(button) {
    const modal = button.closest('.edit-request-modal');
    const idMatch = modal?.id.match(/viewEditRequestModal-(\d+)/);
    return idMatch ? idMatch[1] : null;
  }
});
