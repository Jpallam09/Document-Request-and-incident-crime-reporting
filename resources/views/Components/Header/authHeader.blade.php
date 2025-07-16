<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Component Library - Build Your UI</title>
</head>

    <body>
      <header>
        <nav>@yield('navbar');</nav>
        @yield('header');
      </header>

      <h2 class="our-services" id="our-services">Our services</h2>

      <section>
          @yield('banner');
      </section>

      <section">
        @yield('cards');
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
    </body>
</html>
