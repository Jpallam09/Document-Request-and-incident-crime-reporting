<aside id="sidebar" class="sidebar">
    <ul class="sidebar__nav">
        <li class="sidebar__item">
            <a href="{{ route('reporting.staff.dashboard') }}"
               class="sidebar__link {{ request()->routeIs('reporting.staff.dashboard') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>

        <li class="sidebar__item">
            <a href="{{ route('reporting.staff.staffReportView') }}"
               class="sidebar__link {{ request()->routeIs('reporting.staff.staffReportView') ? 'active' : '' }}">
                Reports List
            </a>
        </li>

        <li class="sidebar__item">
            <a href="{{ route('reporting.staff.staffDeletionRequests') }}"
               class="sidebar__link {{ request()->routeIs('reporting.staff.staffDeletionRequests') ? 'active' : '' }}">
                Delete Requests
            </a>
        </li>

        <li class="sidebar__item">
            <a href="{{ route('reporting.staff.staffUpdateRequests') }}"
               class="sidebar__link {{ request()->routeIs('reporting.staff.staffUpdateRequests') ? 'active' : '' }}">
                Edit Requests
            </a>
        </li>
    </ul>
</aside>
