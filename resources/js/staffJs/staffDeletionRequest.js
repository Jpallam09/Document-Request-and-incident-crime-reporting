document.addEventListener('DOMContentLoaded', () => {
    // === DELETION REQUEST ACTION BUTTONS ===
    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', () => {
            alert('View report logic here...');
        });
    });

    document.querySelectorAll('.btn-approve').forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Approved!');
        });
    });

    document.querySelectorAll('.btn-reject').forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Rejected!');
        });
    });
});
