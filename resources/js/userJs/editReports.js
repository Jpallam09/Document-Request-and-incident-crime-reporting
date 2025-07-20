document.addEventListener('DOMContentLoaded', function () {
  const fileInput = document.getElementById('requested_image');
  const previewContainer = document.getElementById('attachmentsGrid');

  // Modal elements
  const modal = document.getElementById('imageModal');
  const modalImg = document.getElementById('modalImage');
  const captionText = document.getElementById('caption');
  const closeBtn = document.getElementById('modalCloseBtn');
  const nextBtn = document.getElementById('modalNextBtn');
  const prevBtn = document.getElementById('modalPrevBtn');

  let currentIndex = 0;

  function getThumbnails() {
    return Array.from(document.querySelectorAll('.attachment-thumb'));
  }

  function showModalImage(index) {
    const thumbs = getThumbnails();
    if (!thumbs[index]) return;

    currentIndex = index;
    modalImg.src = thumbs[index].src;
    captionText.textContent = thumbs[index].alt || `Image ${index + 1}`;
    modal.style.display = 'block';
  }

  document.addEventListener('click', (e) => {
    const thumb = e.target.closest('.attachment-thumb');
    if (!thumb) return;

    const thumbs = getThumbnails();
    const index = thumbs.indexOf(thumb);
    if (index === -1) return;

    showModalImage(index);
  });

  nextBtn.addEventListener('click', () => {
    const thumbs = getThumbnails();
    if (thumbs.length === 0) return;
    const nextIndex = (currentIndex + 1) % thumbs.length;
    showModalImage(nextIndex);
  });

  prevBtn.addEventListener('click', () => {
    const thumbs = getThumbnails();
    if (thumbs.length === 0) return;
    const prevIndex = (currentIndex - 1 + thumbs.length) % thumbs.length;
    showModalImage(prevIndex);
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('keydown', (e) => {
    if (modal.style.display !== 'block') return;
    if (e.key === 'Escape') modal.style.display = 'none';
    if (e.key === 'ArrowRight') nextBtn.click();
    if (e.key === 'ArrowLeft') prevBtn.click();
  });

  window.removeExistingImage = function (imageId, buttonElement) {
    if (!confirm('Are you sure you want to remove this image?')) return;

    const item = buttonElement.closest('.attachment-item');
    if (item) item.remove();

    const hidden = document.createElement('input');
    hidden.type = 'hidden';
    hidden.name = 'deleted_images[]';
    hidden.value = imageId;
    const form = document.querySelector('form');
    if (form) form.appendChild(hidden);

    const thumbs = getThumbnails();
    if (thumbs.length === 0) {
      modal.style.display = 'none';
      return;
    }
    if (currentIndex >= thumbs.length) {
      currentIndex = thumbs.length - 1;
      showModalImage(currentIndex);
    }
  };

  if (fileInput && previewContainer) {
    fileInput.addEventListener('change', function () {
      const files = Array.from(this.files);

      files.forEach((file) => {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = function (e) {
          const item = document.createElement('div');
          item.className = 'attachment-item';

          const img = document.createElement('img');
          img.src = e.target.result;
          img.alt = file.name;
          img.className = 'attachment-thumb';

          const removeBtn = document.createElement('button');
          removeBtn.className = 'delete-btn';
          removeBtn.type = 'button';
          removeBtn.innerHTML = '&times;';
          removeBtn.onclick = function () {
            if (!confirm('Are you sure you want to remove this image?')) return;
            item.remove();
          };

          item.appendChild(img);
          item.appendChild(removeBtn);
          previewContainer.appendChild(item);
        };
        reader.readAsDataURL(file);
      });
    });
  }
});
