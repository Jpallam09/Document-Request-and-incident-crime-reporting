<nav class="navbar">
    <div class="navbar-brand">Staff Panel</div>

    <ul class="navbar-menu">
        <!-- Navigation Links -->
        <li>
            <a href="{{ route('staffDashboard') }}" class="{{ request()->routeIs('staffDashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        <li>
            <a href="{{ route('staffReportView') }}" class="{{ request()->routeIs('staffReportView') ? 'active' : '' }}">Reports lists</a>
        </li>
        <li>
            <a href="{{ route('staffDeletionRequests') }}" class="{{ request()->routeIs('staffDeletionRequests') ? 'active' : '' }}">Delete Requests</a>
        </li>
        <li>
            <a href="{{ route('staffUpdateRequests') }}" class="{{ request()->routeIs('staffUpdateRequests') ? 'active' : '' }}">Edit Requests</a>
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
                <li><a href="#">Logout</a></li>
                <li><a href="#">Random Link</a></li>
            </ul>
        </li>
    </ul>
</nav>
