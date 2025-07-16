/* userIncidentReporting.js
   -------------------------------------------------------------
   Drop‑zone upload, thumbnail preview, smooth scroll button,
   modal viewer with next / prev, reveal animations,
   and custom form submission
------------------------------------------------------------- */

const MAX_IMAGES = 5;
let selectedFiles = [];   // File objects in the order chosen
let thumbUrls    = [];    // Matching data‑URLs (same order)
let currentIdx   = 0;     // Index currently shown in modal

document.addEventListener('DOMContentLoaded', () => {
  /* ---------- Elements ---------- */
  const imageInput    = document.getElementById('incident-image');
  const reportBtn     = document.getElementById('report-button');
  const reportSection = document.getElementById('report');
  const form          = document.querySelector('form[action*="userIncidentReporting.store"]');

  /* ---------- Drop‑zone & Preview Grid ---------- */
  if (imageInput) {
    const previewGrid = document.createElement('div');
    previewGrid.className = 'preview-grid';
    imageInput.insertAdjacentElement('afterend', previewGrid);

    const dropZone = document.createElement('div');
    dropZone.className = 'drop-zone';
    dropZone.textContent = 'Add images here';
    imageInput.parentNode.insertBefore(dropZone, imageInput);
    imageInput.style.display = 'none';

    dropZone.addEventListener('click', () => imageInput.click());
    dropZone.addEventListener('dragover', e => { e.preventDefault(); dropZone.classList.add('drag-over'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('drag-over'));
    dropZone.addEventListener('drop', e => {
      e.preventDefault();
      dropZone.classList.remove('drag-over');
      handleNewFiles([...e.dataTransfer.files]);
    });
    imageInput.addEventListener('change', e => handleNewFiles([...e.target.files]));

    function handleNewFiles(files) {
      const allowed = MAX_IMAGES - selectedFiles.length;
      if (allowed <= 0) return alert(`You can only upload up to ${MAX_IMAGES} images.`);
      const toAdd = files.slice(0, allowed);
      selectedFiles.push(...toAdd);
      thumbUrls.push(...toAdd.map(f => URL.createObjectURL(f)));
      renderPreviews();
    }

    function renderPreviews() {
      previewGrid.innerHTML = '';
      selectedFiles.forEach((file, idx) => {
        const item = document.createElement('div');
        item.className = 'preview-item';

        const img = document.createElement('img');
        img.src = thumbUrls[idx];
        img.alt = 'Selected image';
        img.addEventListener('click', () => openModal(idx));

        const remove = document.createElement('button');
        remove.className = 'remove-image';
        remove.innerHTML = '&times;';
        remove.addEventListener('click', () => {
          URL.revokeObjectURL(thumbUrls[idx]);
          selectedFiles.splice(idx, 1);
          thumbUrls.splice(idx, 1);
          if (modal.classList.contains('open')) {
            if (idx === currentIdx) hideModal();
            else if (idx < currentIdx) currentIdx--;
          }
          renderPreviews();
        });

        item.append(img, remove);
        previewGrid.appendChild(item);
      });
    }
  }

  /* ---------- Smooth scroll button ---------- */
  reportBtn?.addEventListener('click', () => {
    reportSection?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    reportSection?.querySelector('input, textarea, select')?.focus({ preventScroll: true });
  });

  /* ---------- Modal Viewer with Prev / Next ---------- */
  const modal     = document.getElementById('imageModal');
  const modalImg  = document.getElementById('modalImage');
  const closeBtn  = document.getElementById('closeModal');

  // Add arrows once
  const prevBtn = document.createElement('span');
  prevBtn.className = 'modal-prev';
  prevBtn.innerHTML = '&#10094;';
  const nextBtn = document.createElement('span');
  nextBtn.className = 'modal-next';
  nextBtn.innerHTML = '&#10095;';
  modal.append(prevBtn, nextBtn);

  function showImage(idx) {
    if (!thumbUrls.length) return;
    currentIdx = (idx + thumbUrls.length) % thumbUrls.length; // wrap
    modalImg.src = thumbUrls[currentIdx];
  }

  function openModal(idx) {
    if (!modal) return;
    showImage(idx);
    modal.classList.add('open');
  }
  function hideModal() {
    modal.classList.remove('open');
  }

  closeBtn?.addEventListener('click', hideModal);
  modal.addEventListener('click', e => { if (e.target === modal) hideModal(); });

  prevBtn.addEventListener('click', e => { e.stopPropagation(); showImage(currentIdx - 1); });
  nextBtn.addEventListener('click', e => { e.stopPropagation(); showImage(currentIdx + 1); });

  document.addEventListener('keydown', e => {
    if (!modal.classList.contains('open')) return;
    if (e.key === 'Escape') hideModal();
    if (e.key === 'ArrowLeft')  showImage(currentIdx - 1);
    if (e.key === 'ArrowRight') showImage(currentIdx + 1);
  });

  /* ---------- Intersection reveal ---------- */
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
        obs.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  ['.feature-card', '.report-form-section', '.hero'].forEach(sel =>
    document.querySelectorAll(sel).forEach(el => observer.observe(el))
  );

  /* ---------- Custom form submit ---------- */
  form?.addEventListener('submit', e => {
    e.preventDefault();
    const formData = new FormData(form);
    selectedFiles.forEach(file => formData.append('report_image[]', file));

    fetch(form.action, {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': document.querySelector('input[name=_token]')?.value },
      body: formData,
    })
      .then(r => r.redirected ? (window.location = r.url)
                              : r.text().then(html => (document.body.innerHTML = html)))
      .catch(() => alert('There was an error submitting the report.'));
  });
});
