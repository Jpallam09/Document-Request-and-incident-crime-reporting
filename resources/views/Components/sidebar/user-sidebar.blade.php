<aside id="sidebar" class="sidebar">
    <ul class="sidebar__nav">
        <li class="sidebar__item">
            <a href="{{ route('userMainDashboard') }}"
               class="sidebar__link {{ request()->routeIs('user.userMainDashboard') ? 'active' : '' }}">
               Main Dashboard
            </a>
        </li>

        <li class="sidebar__item">
            <a href="{{ route('user.report.userIncidentReporting.create') }}"
               class="sidebar__link {{ request()->routeIs('user.report.userIncidentReporting.create') ? 'active' : '' }}">
               Report
            </a>
        </li>

        <li class="sidebar__item">
            <a href="{{ route('user.report.userDashboardReporting') }}"
               class="sidebar__link {{ request()->routeIs('user.report.userDashboardReporting') ? 'active' : '' }}">
               Reports lists
            </a>
        </li>
    </ul>
</aside>
