document.addEventListener("DOMContentLoaded", () => {
    // -----------------------------
    // Carousel Initialization
    // -----------------------------
    const introCarousel = document.querySelector("#introCarousel");
    if (introCarousel) {
        new bootstrap.Carousel(introCarousel, {
            interval: 6000, // Slide every 6s
            ride: "carousel", // Auto-start
            wrap: true, // Loop slides
        });
    }

    // -----------------------------
    // Navbar Scroll Behavior
    // -----------------------------
    const navbar = document.querySelector(".transparent-navbar");
    if (navbar) {
        const toggleNavbar = () => {
            navbar.classList.toggle("scrolled", window.scrollY > 50);
        };
        window.addEventListener("scroll", toggleNavbar);
        toggleNavbar(); // Run once on load
    }

    // -----------------------------
    // Bootstrap Tooltips
    // -----------------------------
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.forEach((el) => new bootstrap.Tooltip(el));

    // -----------------------------
    // Smooth Scrolling for Anchors
    // -----------------------------
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", (e) => {
            e.preventDefault();
            const target = document.querySelector(anchor.getAttribute("href"));
            if (target) {
                target.scrollIntoView({ behavior: "smooth", block: "start" });
            }
        });
    });

        const homeLink = document.querySelector("#homeLink");

    if (homeLink) {
        homeLink.addEventListener("click", (e) => {
            e.preventDefault(); // stop reload
            window.scrollTo({
                top: 0,
                behavior: "smooth", // smooth scroll
            });

            // Set active class only on Home
            document.querySelectorAll(".nav-link").forEach((link) =>
                link.classList.remove("active")
            );
            homeLink.classList.add("active");
        });
    }
});
