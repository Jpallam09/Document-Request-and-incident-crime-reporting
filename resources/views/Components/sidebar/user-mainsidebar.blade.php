<!-- components/sidebar/user-sidebar.blade.php -->
<aside class="user-sidebar">
  <nav class="sidebar-nav" aria-label="User main navigation sidebar">
    <!-- ==================== DOCUMENT REQUEST ==================== -->
    <h3 class="sidebar-heading">Document Request</h3>
    <ul class="sidebar-section" id="document-request-links">
      <!-- Include your Document Request links here -->
      {{-- Example: <li><a href="{{ route('document.request.index') }}">All Requests</a></li> --}}
    </ul>

    <!-- ==================== INCIDENT REPORT ==================== -->
    <h3 class="sidebar-heading">Incident Report</h3>
    <ul class="sidebar-section" id="incident-report-links">
      <!-- Include your Incident Report links here -->
      {{-- Example: <li><a href="{{ route('user.report.index') }}">My Reports</a></li> --}}
    </ul>
  </nav>
</aside>
