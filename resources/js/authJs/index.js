document.addEventListener('DOMContentLoaded', () => {
  // -----------------------------
  // Carousel Initialization
  // -----------------------------
  const introCarousel = document.querySelector('#introCarousel');
  if (introCarousel) {
    new bootstrap.Carousel(introCarousel, {
      interval: 6000,   // Slide every 
      ride: 'carousel', // Auto-start
      wrap: true        // Loop slides
    });
  }

  // -----------------------------
  // Navbar Scroll Behavior
  // -----------------------------
  const navbar = document.querySelector('.transparent-navbar');
  if (navbar) {
    const toggleNavbar = () => {
      navbar.classList.toggle('scrolled', window.scrollY > 50);
    };

    window.addEventListener('scroll', toggleNavbar);
    toggleNavbar(); // Run once on load
  }
});
