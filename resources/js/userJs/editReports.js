const images = [
    {
        src: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1374fd6c-9deb-4842-b2da-503e1d8801db.png",
        alt: "Network rack with diagnostic equipment"
    },
    {
        src: "https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/b72a43db-11e7-4798-9b6f-3845d49a2997.png",
        alt: "Monitoring dashboard"
    }
];

let currentImageIndex = 0;

function openImageModal(src, alt) {
    currentImageIndex = images.findIndex(img => img.src === src);
    document.getElementById('expandedImg').src = src;
    document.getElementById('caption').textContent = alt;

    const modal = document.getElementById('imageModal');
    modal.style.display = "block";

    document.querySelector(".prev").style.display = images.length > 1 ? "block" : "none";
    document.querySelector(".next").style.display = images.length > 1 ? "block" : "none";
}

function closeModal() {
    document.getElementById('imageModal').style.display = "none";
}

function changeImage(step) {
    currentImageIndex = (currentImageIndex + step + images.length) % images.length;

    const { src, alt } = images[currentImageIndex];
    document.getElementById('expandedImg').src = src;
    document.getElementById('caption').textContent = alt;
}

window.onclick = function(event) {
    const modal = document.getElementById('imageModal');
    if (event.target === modal) {
        closeModal();
    }
};

function removeImage(container) {
    if (confirm('Are you sure you want to remove this image?')) {
        container.remove();
    }
}

document.getElementById('newImage').addEventListener('change', function (e) {
    const fileName = document.getElementById('fileName');
    fileName.textContent = this.files.length > 0 ? this.files[0].name : 'No file selected';
});

function confirmDelete() {
    if (confirm('Are you sure you want to delete this report? This action cannot be undone.')) {
        alert('Report deleted successfully.');
        window.location.href = 'reports-list.html'; // replace with actual route if needed
    }
}
