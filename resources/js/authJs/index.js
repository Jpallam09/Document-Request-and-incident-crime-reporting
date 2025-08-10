document.addEventListener('DOMContentLoaded', () => {
  // Initialize carousel
  const introCarousel = document.querySelector('#introCarousel');
  const carousel = new bootstrap.Carousel(introCarousel, {
    interval: 3000,
    ride: 'carousel',
    wrap: true
  });

  // Navbar scroll behavior
  const navbar = document.querySelector('.transparent-navbar');
  function onScroll() {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  }

  window.addEventListener('scroll', onScroll);
  onScroll(); // Initialize state on page load
});
