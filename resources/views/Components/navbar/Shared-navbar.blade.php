<!-- Navbar (now just icons) -->
<nav class="navbar d-flex justify-content-end align-items-center px-4 shadow-sm">
    <ul class="navbar__menu d-flex align-items-center gap-3 mb-0 list-unstyled">
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

<!-- Layout -->
<div class="layout">
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar py-3 px-2">
        <div class="sidebar__brand d-flex align-items-center gap-2 px-3 mb-4">
            <i class="fas fa-shield-alt fs-5"></i>
            <span class="fw-semibold fs-6">Incident Reporting</span>
        </div>

        <ul class="sidebar__nav d-flex flex-column gap-2 mb-0 list-unstyled">
            <li class="sidebar__item">
                <a href="{{ route('reporting.staff.dashboard') }}"
                   class="sidebar__link {{ request()->routeIs('reporting.staff.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('reporting.staff.staffReportView') }}"
                   class="sidebar__link {{ request()->routeIs('reporting.staff.staffReportView') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i>
                    <span>Reports List</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('reporting.staff.staffDeletionRequests') }}"
                   class="sidebar__link {{ request()->routeIs('reporting.staff.staffDeletionRequests') ? 'active' : '' }}">
                    <i class="fas fa-trash-alt me-2"></i>
                    <span>Delete Requests</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('reporting.staff.staffUpdateRequests') }}"
                   class="sidebar__link {{ request()->routeIs('reporting.staff.staffUpdateRequests') ? 'active' : '' }}">
                    <i class="fas fa-edit me-2"></i>
                    <span>Edit Requests</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
