    // Smooth scroll for "Report an Incident" button (+ focus first form input)
    const reportButton = document.getElementById('report-button');
    const reportSection = document.getElementById('report');
    reportButton.addEventListener('click', () => {
      if (reportSection) {
        reportSection.scrollIntoView({ behavior: 'smooth', block: 'center' });
        const firstInput = reportSection.querySelector('input, select, textarea');
        if (firstInput) firstInput.focus({ preventScroll: true });
      }
    });

    // IntersectionObserver for fade-in on scroll
    const observerOptions = {
      threshold: 0.15
    };

    const observer = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, observerOptions);

    // Observe feature cards and report form section
    document.querySelectorAll('.feature-card').forEach(el => observer.observe(el));
    const reportFormSection = document.querySelector('.report-form-section');
    if (reportFormSection) observer.observe(reportFormSection);
    const heroSection = document.querySelector('.hero');
    if (heroSection) observer.observe(heroSection);
