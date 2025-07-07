<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>User Dashboard – Incident Reports</title>
  @vite('resources/css/userCss/userDashboardReporting.css')
</head>
<body>

<header>
  <nav aria-label="Primary navigation">
    <div class="logo" tabindex="0">IncidentReport</div>
    <div class="user-menu" tabindex="0"><strong><a href="{{ route('user.report.userIncidentReporting.index') }}">Report Incident</a></strong></div>
    <div class="user-menu" tabindex="0"><strong><a href="{{ route('user.report.userProfileReporting') }}">User Profile</a></strong></div>
    <div class="user-menu" tabindex="0"><strong><a href="#">Log out</a></strong></div>
  </nav>
</header>

<main>
  <section class="hero" aria-labelledby="dashboard-title">
    <h1 id="dashboard-title">Your Report lists</h1>
    <p id="summary-text">You have <strong>{{ $reports->count() }}</strong> total reports.</p>
  </section>

  <section class="metrics-grid" aria-label="Incident report metrics">
    <article class="card">
      <strong class="card-value">{{ $reports->count() }}</strong>
      <p class="card-label">Total Reports</p>
    </article>
    <article class="card">
      <strong class="card-value">{{ $reports->where('is_actioned', false)->count() }}</strong>
      <p class="card-label">Open</p>
    </article>
    <article class="card">
      <strong class="card-value">{{ $reports->where('is_actioned', true)->count() }}</strong>
      <p class="card-label">Resolved</p>
    </article>
    <article class="card">
      <strong class="card-value">{{ $reports->where('is_actioned', false)->count() }}</strong>
      <p class="card-label">Pending</p>
    </article>
  </section>

  <section aria-label="Incident Reports Table">
    <div class="table-container">
      <table id="reportsTable" role="grid">
        <thead>
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Date</th>
            <th>Type</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reports as $report)
            <tr>
              <td>{{ $report->id }}</td>
              <td>{{ $report->report_title }}</td>
              <td>{{ \Carbon\Carbon::parse($report->report_date)->format('F d, Y') }}</td>
              <td>{{ $report->report_type }}</td>
              <td>
                <span class="status {{ $report->is_actioned ? 'status-closed' : 'status-pending' }}">
                  {{ $report->is_actioned ? 'Actioned' : 'pending' }}
                </span>
              </td>
              <td>
            <a href="{{ url('user/report/viewReports/' . $report->id) }}" class="btn-view">View</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </section>
</main>

<footer>
  &copy; {{ date('Y') }} IncidentReport. All rights reserved.
</footer>

</body>
</html>
