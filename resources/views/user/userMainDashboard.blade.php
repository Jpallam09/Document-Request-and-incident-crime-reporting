<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Main Dashboard - News Reader App</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  @vite('resources/css/authCss/userMainDashboard.css')>
</head>

<body>
  <header role="banner">
    <div class="nav-content">
      <div class="nav-left">
        <div class="logo" aria-label="News Reader App Logo" tabindex="0">News Reader</div>
        <nav class="primary-nav" role="navigation" aria-label="Primary Navigation">
          <a href="#" aria-current="page">Dashboard</a>
        </nav>
      </div>

      <nav class="user-actions" role="navigation" aria-label="User actions">
        <a href="" aria-label="View notifications" tabindex="0" title="Notifications">
          <span class="material-icons" aria-hidden="true">notifications</span>
        </a>
        <a href="#" aria-label="Edit user profile" tabindex="0" title="Edit Profile">
          <span class="material-icons" aria-hidden="true">person</span>
          Edit
        </a>
        <a href="#" class="logout" aria-label="Logout" tabindex="0" title="Logout">
          <span class="material-icons" aria-hidden="true">logout</span>
          Logout
        </a>
      </nav>
    </div>
  </header>

  <main class="container" role="main">
    <h1 class="dashboard-header">Main Dashboard</h1>
    <section class="card-grid" role="list">
      <a href="../" class="card" role="listitem" tabindex="0" aria-label="Go to Document Request">
        <span class="card-icon" aria-hidden="true">description</span>
        <h2 class="card-title">Document Request</h2>
        <p class="card-description">Submit and manage your document requests quickly and easily.</p>
      </a>
      <a href="../Incident-reporting/Pages/User/user-dashboard.php" class="card" role="listitem" tabindex="0" aria-label="Go to Incident Report">
        <span class="card-icon" aria-hidden="true">report_problem</span>
        <h2 class="card-title">Incident Report</h2>
        <p class="card-description">Report and track incidents with a streamlined reporting system.</p>
      </a>
    </section>
  </main>
</body>
</html>

