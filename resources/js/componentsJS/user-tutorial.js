  function initModalSteps(modalId) {
    const modal = document.getElementById(modalId);
    const steps = modal.querySelectorAll('.step');
    const prevBtn = modal.querySelector('.prevBtn');
    const nextBtn = modal.querySelector('.nextBtn');
    let currentStep = 1;

    function showStep(step) {
      steps.forEach(s => s.classList.add('d-none'));
      const stepEl = modal.querySelector(`.step[data-step="${step}"]`);
      if (stepEl) stepEl.classList.remove('d-none');

      prevBtn.style.display = step === 1 ? 'none' : 'inline-block';
      nextBtn.textContent = step === steps.length ? 'Close' : 'Next';
    }

    prevBtn.addEventListener('click', () => {
      if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
      }
    });

    nextBtn.addEventListener('click', () => {
      if (currentStep < steps.length) {
        currentStep++;
        showStep(currentStep);
      } else {
        const bsModal = bootstrap.Modal.getInstance(modal);
        bsModal.hide();
        currentStep = 1;
        showStep(currentStep);
      }
    });

    showStep(currentStep);
  }

  ['createReportModal','viewReportsModal','editDeleteModal','trackStatusModal'].forEach(initModalSteps);