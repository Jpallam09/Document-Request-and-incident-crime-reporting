let currentImageIndex = 0;
let images = [];

document.addEventListener("DOMContentLoaded", () => {
    images = document.querySelectorAll(".thumbnail");

    // ---------- IMAGE MODAL ----------
    window.openImageModal = function (index) {
        if (!images.length) return;

        currentImageIndex = index;
        const modal = document.getElementById("imageModal");
        const img = images[currentImageIndex];

        document.getElementById("expandedImg").src =
            img.dataset.full || img.src;
        document.getElementById("caption").textContent = img.alt || "Image";
        modal.style.display = "flex";

        document.querySelector(".prev").style.display =
            images.length > 1 ? "block" : "none";
        document.querySelector(".next").style.display =
            images.length > 1 ? "block" : "none";
    };

    window.closeModal = function () {
        document.getElementById("imageModal").style.display = "none";
    };

    window.changeImage = function (step) {
        if (!images.length) return;

        currentImageIndex =
            (currentImageIndex + step + images.length) % images.length;
        const img = images[currentImageIndex];

        document.getElementById("expandedImg").src =
            img.dataset.full || img.src;
        document.getElementById("caption").textContent = img.alt || "Image";
    };

    window.onclick = function (event) {
        const modal = document.getElementById("imageModal");
        if (event.target === modal) {
            closeModal();
        }
    };

    document.addEventListener("keydown", function (e) {
        const modalOpen =
            document.getElementById("imageModal").style.display === "flex";
        if (!modalOpen) return;

        if (e.key === "ArrowRight") changeImage(1);
        if (e.key === "ArrowLeft") changeImage(-1);
        if (e.key === "Escape") closeModal();
    });

    // ---------- DELETE REQUEST ----------
const deleteButtons = document.querySelectorAll(".btn-delete-request");

deleteButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
        e.preventDefault();
        const form = this.closest("form");
        const isPending = form.dataset.deletePending === "true";
        const reasonInput = form.querySelector(".delete-reason");

        if (isPending) {
            // Show pending alert
            Swal.fire({
                icon: "info",
                title: "Pending Request",
                text: "You already have a pending delete request for this report.",
                confirmButtonColor: "#d33",
            });
            return; // stop execution
        }

        // Normal delete SweetAlert if not pending
        Swal.fire({
            title: "Request Deletion",
            input: "textarea",
            inputLabel: "Reason",
            inputPlaceholder:
                "Please provide a reason for requesting deletion...",
            inputAttributes: {
                "aria-label": "Reason for deletion",
            },
            showCancelButton: true,
            confirmButtonText: "Submit Request",
            cancelButtonText: "Cancel",
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            inputValidator: (value) => {
                if (!value.trim()) {
                    return "You need to provide a reason!";
                }
            },
        }).then((result) => {
            if (result.isConfirmed) {
                reasonInput.value = result.value;
                form.submit();
            }
        });
    });
});

// ---------- EDIT REQUEST ----------
const editButtons = document.querySelectorAll(".btn-edit-request");

editButtons.forEach((button) => {
    button.addEventListener("click", function () {
        const hasPending = button.dataset.editPending === "true";
        const editUrl = button.dataset.editUrl;

        if (hasPending) {
            Swal.fire({
                icon: "info",
                title: "Pending Request",
                text: "You already have a pending edit request for this report.",
                confirmButtonColor: "#2563eb",
            });
        } else {
            window.location.href = editUrl;
        }
    });
});


    // LEAFLET MAP
    const mapContainer = document.getElementById("reportMap");
    const lat = parseFloat(mapContainer.dataset.lat);
    const lng = parseFloat(mapContainer.dataset.lng);

    if (lat && lng) {
        // Create map with disabled interactions
        const map = L.map("reportMap", {
            zoomControl: false, // remove + / - buttons
            dragging: false, // disable dragging
            scrollWheelZoom: false, // disable scroll zoom
            doubleClickZoom: false, // disable double click zoom
            boxZoom: false, // disable shift+drag zoom
            keyboard: false, // disable keyboard controls
            touchZoom: false, // disable pinch zoom on mobile
        }).setView([lat, lng], 15);

        // Add tiles
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "&copy; OpenStreetMap contributors",
        }).addTo(map);

        // Add marker
        L.marker([lat, lng])
            .addTo(map)
            .bindPopup("Incident Location")
            .openPopup();
    }

    const editBtn = document.getElementById("editBtn");
    const deleteBtn = document.getElementById("deleteBtn");

    // Hidden span with report status
    const reportStatusEl = document.getElementById("reportStatus");
    const reportStatus = reportStatusEl
        ? reportStatusEl.textContent.trim().toLowerCase()
        : "";

    if (reportStatus === "success") {
        // Hide buttons
        if (editBtn) editBtn.style.display = "none";
        if (deleteBtn) deleteBtn.style.display = "none";

        // Show resolved badge
        const actionContainer = editBtn.closest(".action-buttons");
        if (
            actionContainer &&
            !actionContainer.querySelector(".resolved-badge")
        ) {
            const badge = document.createElement("span");
            badge.className = "badge bg-success resolved-badge";
            badge.innerHTML =
                '<i class="fa-solid fa-check-circle me-1"></i> Report is resolved';
            actionContainer.prepend(badge);
        }
    }
});
