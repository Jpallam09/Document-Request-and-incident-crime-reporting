<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Incident Reporting Platform</title>
    {{-- Css --}}
    @vite('resources/css/userCss/userDashboardReporting.css')
    @vite('resources/css/userCss/userIncidentReporting.css')
    @vite('resources/css/userCss/userProfileReporting.css')
    @vite('resources/css/userCss/viewReports.css')
    {{-- Js --}}
    @vite('resources/js/userJs/viewReports.js')
    @vite('resources/js/userJs/userIncidentReporting.js')
</head>

<body>
  <header>
    @yield('navbar')
  </header>

  <main>    
    <section>
        @yield('reportBanner')
    </section>

    <section>
        @yield('flashCard')
    </section>

    <section>
        @yield('reportForm')
      </form>
    </section>
  </main>

  <footer>

  </footer>
</body>
</html>

