document.addEventListener("DOMContentLoaded", () => {
    /* ============================
       UPDATE REQUEST TABLE ACTIONS
    ============================ */

    // View Request
    document.querySelectorAll(".btn-view").forEach(button => {
        button.addEventListener("click", () => {
            const row = button.closest("tr");
            const reportTitle = row.children[2].textContent;
            const changeRequest = row.children[3].textContent;

            alert(`View Request:\n\nTitle: ${reportTitle}\nChange: ${changeRequest}`);
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
