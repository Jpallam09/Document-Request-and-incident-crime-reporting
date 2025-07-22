document.addEventListener("DOMContentLoaded", () => {
    /* ============================
       UPDATE REQUEST TABLE ACTIONS
    ============================ */

    // View Request – removed alert logic to use modal instead
    document.querySelectorAll(".btn-view").forEach(button => {
        button.addEventListener("click", () => {
            // Modal is triggered via inline onclick="openRequestModal(this)"
            // So no logic needed here anymore
        });
    });

    // Approve Request
    document.querySelectorAll(".btn-approve").forEach(button => {
        button.addEventListener("click", () => {
            if (confirm("Are you sure you want to approve this update request?")) {
                const row = button.closest("tr");
                const statusSpan = row.querySelector(".status");
                statusSpan.textContent = "Approved";
                statusSpan.className = "status approved";
                disableButtons(row);
                console.log("Update request approved.");
            }
        });
    });

    // Reject Request
    document.querySelectorAll(".btn-reject").forEach(button => {
        button.addEventListener("click", () => {
            if (confirm("Are you sure you want to reject this update request?")) {
                const row = button.closest("tr");
                const statusSpan = row.querySelector(".status");
                statusSpan.textContent = "Rejected";
                statusSpan.className = "status rejected";
                disableButtons(row);
                console.log("Update request rejected.");
            }
        });
    });

    // Helper: Disable all action buttons in a row
    function disableButtons(row) {
        row.querySelectorAll("button").forEach(btn => {
            btn.disabled = true;
        });
    }
});
