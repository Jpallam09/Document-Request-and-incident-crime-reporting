<nav class="navbar">
    <div class="navbar-brand">Report</div>

    <ul class="navbar-menu">
        <li>
            <a href="{{ route('userMainDashboard') }}" class="{{ request()->routeIs
            ('user.userMainDashboard') ? 'active' : '' }}">Main Dashboard</a>
        </li>
        <li>
            <a href="{{ route('user.report.userIncidentReporting.create') }}" class="{{ request()->routeIs('user.report.userIncidentReporting.create') ? 'active' : '' }}">Report</a>
        </li>
        <li>
            <a href="{{ route('user.report.userDashboardReporting') }}" class="{{ request()->routeIs('user.report.userDashboardReporting') ? 'active' : '' }}">Reports lists</a>
        </li>

        <!-- Notification Dropdown -->
        <li class="dropdown-wrapper notification">
            <a href="#" class="dropdown-toggle" title="Notifications">🔔 <span class="badge">0</span></a>
            <ul class="dropdown-menu">
                <li><a href="#">New report submitted</a></li>
                <li><a href="#">1 update request</a></li>
            </ul>
        </li>

        <!-- Settings Dropdown -->
        <li class="dropdown-wrapper">
            <a href="#" class="dropdown-toggle" title="Settings">⚙️</a>
            <ul class="dropdown-menu">
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </li>
                <li><a href="#">Profile</a></li>
            </ul>
        </li>
    </ul>
</nav>
