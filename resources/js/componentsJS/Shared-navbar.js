document.addEventListener('DOMContentLoaded', () => {
    // Optional: Enhance dropdown accessibility/behavior
    const dropdowns = document.querySelectorAll('.dropdown details');

    dropdowns.forEach(dropdown => {
        const summary = dropdown.querySelector('summary');

        summary?.addEventListener('click', (e) => {
            // Close other open dropdowns (if multiple exist)
            dropdowns.forEach(other => {
                if (other !== dropdown) other.removeAttribute('open');
            });
        });
    });

    // Optional: Highlight current sidebar link manually if needed
    const currentUrl = window.location.href;
    document.querySelectorAll('.sidebar__link').forEach(link => {
        if (currentUrl.includes(link.href)) {
            link.classList.add('active');
        }
    });

    // Optional: Sidebar toggler (if you plan to add a collapse button)
    const toggleBtn = document.querySelector('#sidebarToggle');
    const sidebar = document.querySelector('#sidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });
    }
});
