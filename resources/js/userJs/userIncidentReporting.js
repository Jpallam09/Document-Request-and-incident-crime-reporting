const MAX_IMAGES = 5;
let selectedFiles = [];

const imageInput = document.getElementById('incident-image');
const previewContainer = document.createElement('div');
previewContainer.classList.add('preview-grid');
imageInput.insertAdjacentElement('afterend', previewContainer);

// Create drop zone
const dropZone = document.createElement('div');
dropZone.textContent = 'Add images here';
dropZone.className = 'drop-zone';
imageInput.parentNode.insertBefore(dropZone, imageInput);
imageInput.style.display = 'none';

// Click drop zone to open file dialog
dropZone.addEventListener('click', () => imageInput.click());

imageInput.addEventListener('change', (event) => {
  const newFiles = Array.from(event.target.files);
  handleNewFiles(newFiles);
});

dropZone.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropZone.classList.add('drag-over');
});

dropZone.addEventListener('dragleave', () => {
  dropZone.classList.remove('drag-over');
});

dropZone.addEventListener('drop', (e) => {
  e.preventDefault();
  dropZone.classList.remove('drag-over');
  const droppedFiles = Array.from(e.dataTransfer.files);
  handleNewFiles(droppedFiles);
});

function handleNewFiles(newFiles) {
  const allowed = MAX_IMAGES - selectedFiles.length;
  if (allowed <= 0) {
    alert(`You can only upload up to ${MAX_IMAGES} images.`);
    return;
  }

  const filesToAdd = newFiles.slice(0, allowed);
  selectedFiles = [...selectedFiles, ...filesToAdd];
  renderPreviews();
}

function renderPreviews() {
  previewContainer.innerHTML = '';

  selectedFiles.forEach((file, index) => {
    const reader = new FileReader();
    reader.onload = (e) => {
      const previewItem = document.createElement('div');
      previewItem.className = 'preview-item';

      const img = document.createElement('img');
      img.src = e.target.result;

      const removeBtn = document.createElement('button');
      removeBtn.className = 'remove-image';
      removeBtn.innerHTML = '&times;';
      removeBtn.addEventListener('click', () => {
        selectedFiles.splice(index, 1);
        renderPreviews();
      });

      previewItem.appendChild(img);
      previewItem.appendChild(removeBtn);
      previewContainer.appendChild(previewItem);
    };
    reader.readAsDataURL(file);
  });
}

// Smooth scroll for "Report an Incident" button
const reportButton = document.getElementById('report-button');
const reportSection = document.getElementById('report');
reportButton?.addEventListener('click', () => {
  if (reportSection) {
    reportSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
    const firstInput = reportSection.querySelector('input, select, textarea');
    if (firstInput) firstInput.focus({ preventScroll: true });
  }
});

// Animate sections on scroll
const observerOptions = { threshold: 0.15 };
const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

document.querySelectorAll('.feature-card').forEach(el => observer.observe(el));
document.querySelector('.report-form-section') && observer.observe(document.querySelector('.report-form-section'));
document.querySelector('.hero') && observer.observe(document.querySelector('.hero'));

// Manual Form Submission to include selectedFiles
const form = document.querySelector('.report-form');
form?.addEventListener('submit', function (e) {
  e.preventDefault();

  const formData = new FormData(form);
  selectedFiles.forEach((file) => {
    formData.append('report_image[]', file);
  });

  fetch(form.action, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
    },
    body: formData
  })
    .then(response => {
      if (response.redirected) {
        window.location.href = response.url;
      } else {
        return response.text().then(text => {
          document.body.innerHTML = text;
        });
      }
    })
    .catch(error => {
      console.error('Form submission failed:', error);
      alert('There was an error submitting the report.');
    });
});
