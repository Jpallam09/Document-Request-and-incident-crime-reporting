<!-- Navbar -->
<nav class="navbar">
    <div class="navbar__brand">
        <span><i class="fas fa-shield-alt"></i> Incident Reporting</span>
    </div>

    <ul class="navbar__menu">
        <!-- Notification Dropdown -->
        <li class="navbar__item dropdown">
            <details>
                <summary class="dropdown__toggle" aria-haspopup="true" aria-label="Notifications">
                    <i class="fas fa-bell"></i>
                </summary>
                <ul class="dropdown__menu" role="menu">
                    <li><span class="dropdown__item"><i class="fas fa-info-circle"></i> No new notifications</span></li>
                </ul>
            </details>
        </li>

        <!-- Settings Dropdown -->
        <li class="navbar__item dropdown">
            <details>
                <summary class="dropdown__toggle" aria-haspopup="true" aria-label="Settings">
                    <i class="fas fa-cog"></i>
                </summary>
                <ul class="dropdown__menu" role="menu">
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown__item">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                    <li>
                        <a href="#" class="dropdown__item">
                            <i class="fas fa-user-circle"></i> Profile
                        </a>
                    </li>
                </ul>
            </details>
        </li>
    </ul>
</nav>

<!-- Layout Container -->
<div class="layout">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar__nav">
            <li class="sidebar__item">
                <a href="{{ route('userMainDashboard') }}"
                   class="sidebar__link {{ request()->routeIs('user.userMainDashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('user.report.userDashboardReporting') }}"
                   class="sidebar__link {{ request()->routeIs('user.report.userDashboardReporting') ? 'active' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Reports List</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('user.report.userIncidentReporting.create') }}"
                   class="sidebar__link {{ request()->routeIs('user.report.userIncidentReporting.create') ? 'active' : '' }}">
                    <i class="fas fa-edit"></i>
                    <span>Create Report</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
