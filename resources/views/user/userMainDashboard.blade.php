<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Main Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  @vite('resources/css/authCss/userMainDashboard.css')
  @vite('resources/css/componentsCss/navbarCss/navbar.css')
  @vite('resources/js/componentsJs/navbar.js')
</head>
<body>
  @include('components.navbar.user-navbar')

  <main class="container" role="main">
    <section class="greeting-box">
      <h1 class="dashboard-header">👋 Hello, {{ Auth::user()->name }}!</h1>
      <p class="dashboard-intro">Hope you're having a wonderful {{ now()->format('l') }}. Choose what you’d like to do below.</p>
    </section>

    {{-- Widgets --}}
    <section class="section">
      <h2 class="section-label">Overview</h2>
      <p class="section-description">Your activity summary</p>

      <div class="widgets">
        <article id="myReportsWidget" class="widget">
          <h2>My Reports</h2>
          <p>{{ $reportCount ?? 0 }}</p>
        </article>
        <article id="myRequestsWidget" class="widget">
          <h2>My Requests</h2>
          <p>{{ $requestCount ?? 0 }}</p>
        </article>
      </div>
    </section>

    {{-- App Cards --}}
    <section class="section">
        <section class="Tesxt-section">
            <h2 class="section-label">Choose an Application</h2>
            <p class="section-description">Click below to open a module</p>
        </section>

      <section class="card-grid" role="list">
        <a href="../" class="card" role="listitem" tabindex="0" aria-label="Go to Document Request">
          <span class="material-icons card-icon" aria-hidden="true">description</span>
          <h2 class="card-title">Document Request</h2>
          <p class="card-description">Submit and manage your document requests.</p>
        </a>
        <a href="../Incident-reporting/Pages/User/user-dashboard.php" class="card" role="listitem" tabindex="0" aria-label="Go to Incident Report">
          <span class="material-icons card-icon" aria-hidden="true">report_problem</span>
          <h2 class="card-title">Incident Report</h2>
          <p class="card-description">Report and track incidents efficiently.</p>
        </a>
      </section>
    </section>

    {{-- Fun Quote --}}

  </main>
</body>
</html>
