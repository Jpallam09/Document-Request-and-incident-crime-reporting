<nav class="navbar">
    <div class="navbar-brand">Admin Panel</div>

    <ul class="navbar-menu">
        <!-- Navigation Links -->
        <li>
            <a href="{{ route('reporting.admin.dashboard') }}" class="{{ request()->routeIs('reporting.admin.dashboard') ? 'active' : '' }}">Dashboard</a>
        </li>
        {{-- <li>
            <a href="{{ route('reporting.admin.viewReports') }}" class="{{ request()->routeIs('reporting.admin.viewReports') ? 'active' : '' }}">Reports lists</a>
        </li>
        <li>
            <a href="{{ route('reporting.admin.deletionRequests') }}" class="{{ request()->routeIs('reporting.admin.deletionRequests') ? 'active' : '' }}">Delete Requests</a>
        </li>
        <li>
            <a href="{{ route('reporting.admin.updateRequests') }}" class="{{ request()->routeIs('reporting.admin.updateRequests') ? 'active' : '' }}">Edit Requests</a>
        </li> --}}

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
                <li><a href="#">Random Link</a></li>
            </ul>
        </li>
    </ul>
</nav>
