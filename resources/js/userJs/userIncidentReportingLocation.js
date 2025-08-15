/* userIncidentReporting.js
   -------------------------------------------------------------
   Handles:
   - Image input preview and modal viewer
   - Smooth scroll to report form
   - Form submission with images + current location
   - Intersection reveal animations
   - Prevents duplicate buttons or repeated images
------------------------------------------------------------- */

const MAX_IMAGES = 5;
let selectedFiles = [];   // Array storing selected File objects
let thumbUrls = [];       // Data URLs for preview
let currentIdx = 0;       // Index of currently displayed modal image

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- DOM ELEMENTS ---------- */
  const imageInput    = document.getElementById('incident-image');
  const reportBtn     = document.getElementById('report-button');
  const reportSection = document.getElementById('report');
  const form          = document.querySelector('form[action*="userIncidentReporting.store"]');
  const useLocationBtn = document.getElementById("useCurrentLocation");
  const latInput       = document.getElementById("latitude");
  const lngInput       = document.getElementById("longitude");
  const mapContainer   = document.getElementById("mapPreview");

  let map, marker;

  /* ---------- IMAGE PREVIEW GRID ---------- */
  if (imageInput) {
    let previewGrid = imageInput.parentNode.querySelector('.preview-grid');
    if (!previewGrid) {
        previewGrid = document.createElement('div');
        previewGrid.className = 'preview-grid';
        imageInput.insertAdjacentElement('afterend', previewGrid);
    }

    // File selection
    imageInput.addEventListener('change', e => {
      handleNewFiles([...e.target.files]);
      e.target.value = '';
    });

    // Drag & drop
    const dropArea = imageInput.parentNode;
    dropArea.addEventListener('dragover', e => { e.preventDefault(); dropArea.classList.add('drag-over'); });
    dropArea.addEventListener('dragleave', () => dropArea.classList.remove('drag-over'));
    dropArea.addEventListener('drop', e => {
      e.preventDefault();
      dropArea.classList.remove('drag-over');
      handleNewFiles([...e.dataTransfer.files]);
    });

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
        remove.addEventListener('click', () => removeImage(idx));

        item.append(img, remove);
        previewGrid.appendChild(item);
      });
    }

    function removeImage(idx) {
      URL.revokeObjectURL(thumbUrls[idx]);
      selectedFiles.splice(idx, 1);
      thumbUrls.splice(idx, 1);
      if (modal.classList.contains('open')) {
        if (idx === currentIdx) hideModal();
        else if (idx < currentIdx) currentIdx--;
      }
      renderPreviews();
    }
  }

  /* ---------- MODAL IMAGE VIEWER ---------- */
  const modal     = document.getElementById('imageModal');
  const modalImg  = document.getElementById('modalImage');
  const closeBtn  = document.getElementById('closeModal');

  const prevBtn = document.createElement('span');
  prevBtn.className = 'modal-prev';
  prevBtn.innerHTML = '&#10094;';
  const nextBtn = document.createElement('span');
  nextBtn.className = 'modal-next';
  nextBtn.innerHTML = '&#10095;';
  modal.append(prevBtn, nextBtn);

  function showImage(idx) {
    if (!thumbUrls.length) return;
    currentIdx = (idx + thumbUrls.length) % thumbUrls.length;
    modalImg.src = thumbUrls[currentIdx];
  }
  function openModal(idx) { modal.classList.add('open'); showImage(idx); }
  function hideModal() { modal.classList.remove('open'); }

  closeBtn?.addEventListener('click', hideModal);
  modal.addEventListener('click', e => { if (e.target === modal) hideModal(); });
  prevBtn.addEventListener('click', e => { e.stopPropagation(); showImage(currentIdx - 1); });
  nextBtn.addEventListener('click', e => { e.stopPropagation(); showImage(currentIdx + 1); });
  document.addEventListener('keydown', e => {
    if (!modal.classList.contains('open')) return;
    if (e.key === 'Escape') hideModal();
    if (e.key === 'ArrowLeft') showImage(currentIdx - 1);
    if (e.key === 'ArrowRight') showImage(currentIdx + 1);
  });

  /* ---------- SMOOTH SCROLL TO FORM ---------- */
  reportBtn?.addEventListener('click', () => {
    reportSection?.scrollIntoView({ behavior: 'smooth', block: 'center' });
    reportSection?.querySelector('input, textarea, select')?.focus({ preventScroll: true });
  });

  /* ---------- LOCATION BUTTON ---------- */
  useLocationBtn?.addEventListener("click", () => {
    if (!navigator.geolocation) return alert("Geolocation is not supported by your browser.");
    navigator.geolocation.getCurrentPosition(
      (pos) => {
        const lat = pos.coords.latitude;
        const lng = pos.coords.longitude;
        latInput.value = lat;
        lngInput.value = lng;

        if (!map) {
          map = L.map("mapPreview").setView([lat, lng], 13);
          L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; OpenStreetMap contributors',
          }).addTo(map);
        }

        marker ? marker.setLatLng([lat, lng]) : marker = L.marker([lat, lng]).addTo(map).bindPopup("Incident Location").openPopup();
        map.setView([lat, lng], 15);
      },
      () => alert("Unable to retrieve your location. Please enter manually."),
      { enableHighAccuracy: true, timeout: 10000, maximumAge: 0 }
    );
  });

  /* ---------- FORM SUBMISSION FIXED ---------- */
  form?.addEventListener('submit', e => {
      e.preventDefault();

      const formData = new FormData(form);

      // Append selected images manually ✅
      selectedFiles.forEach(file => formData.append('report_images[]', file));
      console.log('Files being submitted:', selectedFiles);

      // Append latitude and longitude if available
      if (latInput.value) formData.set('latitude', latInput.value);
      if (lngInput.value) formData.set('longitude', lngInput.value);

      // CSRF token
      const csrfInput = form.querySelector('input[name=_token]');
      if (csrfInput) formData.set('_token', csrfInput.value);

      // Send POST request without setting headers
      fetch(form.action, {
          method: 'POST',
          body: formData
      })
      .then(r => r.redirected ? window.location = r.url
                              : r.text().then(html => document.body.innerHTML = html))
      .catch(() => alert('There was an error submitting the report.'));
  });

  /* ---------- INTERSECTION REVEAL ANIMATIONS ---------- */
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) { entry.target.classList.add('visible'); obs.unobserve(entry.target); }
    });
  }, { threshold: 0.15 });

  ['.feature-card', '.report-form-section', '.hero'].forEach(sel =>
    document.querySelectorAll(sel).forEach(el => observer.observe(el))
  );

});
