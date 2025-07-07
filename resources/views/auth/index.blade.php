<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Component Library - Build Your UI</title>
  @vite('resources/css/authCss/index.css')
</head>



<body>
  <nav role="navigation" aria-label="Primary navigation" id="main-nav">
    <div class="container nav-container">
      <div class="logo" aria-label="Homepage Logo">UI Library</div>
      <ul>
        <li><a href="#features">Features</a></li>
        <li><a href="#docs">Docs</a></li>
        <li><a href="#blog">Blog</a></li>
        <li><a href="#community">Community</a></li>
      </ul>
    </div>
  </nav>

  <header class="hero" role="banner" id="hero-section" aria-label="Hero section with background image and headline">
    <div class="hero-background-container">
      <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1920&q=80" alt="Abstract artistic pattern background" id="hero-bg-image" />
      <div class="hero-overlay"></div>
    </div>
    <div class="hero-content container">
      <h1>Document requests and incident report</h1>
      <p>Create beautiful, reusable UI components faster with our elegant and customizable library.</p>
      <a href="{{ route('register') }}"><button class="cta-button" type="button" onclick="alert('Register Account?')">Get Started</button></a>
    </div>
  </header>

  <h2 class="our-services" id="our-services">Our services</h2>

  <section class="features" aria-label="Feature cards section" id="features">
    <div class="container">
      <a href="#" class="feature-card" aria-labelledby="doc-request-title" aria-describedby="doc-request-desc" tabindex="0">
        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 17H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h7"></path>
          <path d="M13 7h5a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-3"></path>
          <path d="M9 22h6"></path>
          <path d="M9 14h6"></path>
          <circle cx="9" cy="10" r="2"></circle>
        </svg>
        <h3 id="doc-request-title">Document Request</h3>
        <p id="doc-request-desc">Submit and track your document requests efficiently through our easy-to-use platform. Stay updated with real-time notifications throughout the process.</p>
      </a>

      <a href="#" class="feature-card" aria-labelledby="incident-report-title" aria-describedby="incident-report-desc" tabindex="0">
        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 9v2"></path>
          <path d="M12 15h.01"></path>
          <path d="M3 19h18"></path>
          <path d="M4 19V7a2 2 0 0 1 2-2h3.5"></path>
          <path d="M17 10v6a2 2 0 0 1-2 2h-5"></path>
        </svg>
        <h3 id="incident-report-title">Incident Report</h3>
        <p id="incident-report-desc">Quickly file incident reports with all essential details in one place. Benefit from timely updates and streamlined resolution tracking.</p>
      </a>
    </div>
  </section>

  <section class="facility" aria-label="Our facility location section">
    <h1 id="facility-heading">Our Facility Location</h1>
    <div class="facility-images-container">
      <div class="facility-image-container" tabindex="0" aria-describedby="facility-info-1">
        <img src="https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=800&q=80" alt="Facility Location Map or Image 1" />
        <div class="facility-overlay" id="facility-info-1" role="region" aria-label="Address and facility information">
          <h4>123 Main Street, Suite 456</h4>
          <p>Springfield, State 12345</p>
          <p>Phone: (123) 456-7890</p>
          <p>Email: contact@uilibrary.com</p>
          <p>Open: Mon-Fri, 9:00 AM - 6:00 PM</p>
        </div>
      </div>
      <div class="facility-image-container" tabindex="0" aria-describedby="facility-info-2">
        <img src="https://images.unsplash.com/photo-1501594907352-04cda38ebc29?auto=format&fit=crop&w=800&q=80" alt="Facility Location Map or Image 2" />
        <div class="facility-overlay" id="facility-info-2" role="region" aria-label="Address and facility information">
          <h4>789 Elm Avenue, Floor 3</h4>
          <p>Capital City, State 67890</p>
          <p>Phone: (987) 654-3210</p>
          <p>Email: support@uilibrary.com</p>
          <p>Open: Mon-Fri, 8:00 AM - 5:00 PM</p>
        </div>
      </div>
    </div>
  </section>

  <footer role="contentinfo">
    <div class="container">
      <div class="copyright">&copy; 2024 UI Library. All rights reserved.</div>
      <nav class="social-links" aria-label="Social media links">
        <a href="https://github.com/" target="_blank" rel="noopener" aria-label="GitHub">
          <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <title>GitHub</title>
            <path d="M12 2C6.477 2 2 6.477 2 12a10 10 0 0 0 6.839 9.487c.5.09.682-.217.682-.482 0-.237-.009-.868-.013-1.703-2.782.604-3.369-1.342-3.369-1.342-.455-1.155-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.004.07 1.532 1.032 1.532 1.032.893 1.528 2.341 1.087 2.91.832.09-.647.35-1.087.636-1.338-2.22-.253-4.555-1.11-4.555-4.942 0-1.09.39-1.98 1.029-2.677-.103-.254-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.025a9.564 9.564 0 0 1 2.5-.337 9.54 9.54 0 0 1 2.5.337c1.91-1.296 2.75-1.025 2.75-1.025.546 1.378.202 2.396.1 2.65.64.697 1.028 1.586 1.028 2.677 0 3.842-2.337 4.685-4.564 4.935.359.31.678.923.678 1.86 0 1.342-.012 2.423-.012 2.753 0 .268.18.577.688.48A10 10 0 0 0 22 12c0-5.523-4.477-10-10-10z" />
          </svg>
        </a>
        <a href="https://twitter.com/" target="_blank" rel="noopener" aria-label="Twitter">
          <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <title>Twitter</title>
            <path d="M23 3a10.9 10.9 0 0 1-3.14.86 4.48 4.48 0 0 0 1.98-2.48c-.88.52-1.85.9-2.88 1.1A4.52 4.52 0 0 0 16.67 2c-2.5 0-4.51 2-4.51 4.48 0 .35.04.7.1 1.03-3.76-.2-7.1-2-9.33-4.75a4.47 4.47 0 0 0-.61 2.27c0 1.56.8 2.94 2.02 3.75a4.52 4.52 0 0 1-2.04-.57v.06c0 2.18 1.57 3.98 3.65 4.39a4.55 4.55 0 0 1-2.02.08c.57 1.78 2.22 3.08 4.18 3.12A9.06 9.06 0 0 1 2 19.54c-.38 0-.75-.02-1.12-.06a13 13 0 0 0 7.1 2.07c8.52 0 13.17-7.06 13.17-13.17 0-.2 0-.42-.02-.63A9.3 9.3 0 0 0 23 3z" />
          </svg>
        </a>
        <a href="https://linkedin.com/" target="_blank" rel="noopener" aria-label="LinkedIn">
          <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
            <title>LinkedIn</title>
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-4 0v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 3a2 2 0 1 1 0 4 2 2 0 0 1 0-4z" />
          </svg>
        </a>
      </nav>
    </div>
  </footer>

<script>
  (function() {
    const heroBgImage = document.getElementById('hero-bg-image');
    const heroContent = document.querySelector('.hero-content');
    const ourServicesHeading = document.querySelector('h2.our-services');
    const facilityHeading = document.getElementById('facility-heading');
    const mainNav = document.getElementById('main-nav');

    let lastScrollTop = 0;
    function onScroll() {
      const scrollY = window.scrollY || window.pageYOffset;
      const directionDown = scrollY > lastScrollTop;
      lastScrollTop = scrollY <= 0 ? 0 : scrollY;

      const threshold = 80;
      let progress;

      if (directionDown && scrollY > threshold) {
        const clamped = Math.min(scrollY, threshold + 220);
        progress = (clamped - threshold) / 220;
      } else if (!directionDown && scrollY > threshold) {
        const clamped = Math.min(scrollY, threshold + 220);
        progress = (clamped - threshold) / 220;
        progress = 1 - progress;
      } else {
        progress = 0;
      }
      progress = Math.min(Math.max(progress, 0), 1);

      const scale = 1 + 0.1 * progress;
      const translateY = -50 * progress;
      const opacity = 1 - 0.4 * progress;
      heroBgImage.style.transform = `scale(${scale}) translateY(${translateY}px)`;
      heroBgImage.style.opacity = opacity;

      const textOpacity = 1 - progress;
      const textTranslateY = 40 * progress;
      heroContent.style.opacity = textOpacity;
      heroContent.style.transform = `translateY(${textTranslateY}px)`;

      const serviceFadeStart = 280;
      const serviceFadeEnd = 480;
      let serviceProgress = (scrollY - serviceFadeStart) / (serviceFadeEnd - serviceFadeStart);
      serviceProgress = Math.min(Math.max(serviceProgress, 0), 1);
      ourServicesHeading.style.opacity = serviceProgress;
      ourServicesHeading.style.transform = `translateY(${30 * (1 - serviceProgress)}px)`;

      const facilityFadeStart = 480;
      const facilityFadeEnd = 680;
      let facilityProgress = (scrollY - facilityFadeStart) / (facilityFadeEnd - facilityFadeStart);
      facilityProgress = Math.min(Math.max(facilityProgress, 0), 1);
      if (facilityHeading) {
        facilityHeading.style.opacity = facilityProgress;
        facilityHeading.style.transform = `translateY(${30 * (1 - facilityProgress)}px)`;
      }

      if (scrollY > threshold) {
        mainNav.classList.add('solid-bg');
      } else {
        mainNav.classList.remove('solid-bg');
      }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('load', onScroll);
  })();
</script>
</body>
</html>
