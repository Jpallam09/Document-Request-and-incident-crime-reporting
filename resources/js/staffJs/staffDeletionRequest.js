document.addEventListener("DOMContentLoaded", () => {
    // Modal open/close handling
    document.querySelectorAll(".openModalBtn").forEach((button) => {
        const modalId = button.getAttribute("data-modal");
        const modal = document.getElementById(modalId);

        button.addEventListener("click", () => {
            modal.classList.remove("hidden");
        });

        modal.querySelector(".close-modal").addEventListener("click", () => {
            modal.classList.add("hidden");
        });
    });

    // SweetAlert for Accept/Reject confirmation
    document.querySelectorAll(".modal-actions form").forEach((form) => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Prevent default submit

            const isAccept = form.querySelector("button.btn-accept") !== null;

            Swal.fire({
                title: isAccept
                    ? "Accept this deletion request?"
                    : "Reject this deletion request?",
                text: isAccept
                    ? "This will permanently delete the report."
                    : "This request will be marked as rejected.",
                icon: isAccept ? "warning" : "question",
                showCancelButton: true,
                confirmButtonColor: isAccept ? "#28a745" : "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: isAccept ? "Yes, Accept" : "Yes, Reject",
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Proceed if confirmed
                }
            });
        });
    });
});
