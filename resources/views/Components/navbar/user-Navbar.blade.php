<!-- Navbar (Icons only, aligned right) -->
<nav class="navbar d-flex justify-content-end align-items-center px-4 shadow-sm">
    <ul class="navbar__menu d-flex align-items-center gap-3 mb-0 list-unstyled">
        <!-- User info -->
        <li class="d-flex align-items-center gap-2">
            <span class="d-none d-md-inline">{{ auth()->user()->user_name }}</span>
            <img src="{{ Auth::user()?->profile_picture
    ? asset('storage/profile_pictures/' . Auth::user()->profile_picture)
    : asset('images/pfp.png') }}"
                class="rounded-circle" width="32" height="32" alt="User Avatar">
        </li>
        <!-- Notification Dropdown -->
        <li class="nav-item dropdown position-relative"> <a class="nav-link" href="#" id="notificationDropdown"
                role="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Notifications"> <i
                    class="fas fa-bell"></i>
                @if (isset($unreadNotifications) && $unreadNotifications->count() > 0)
                    <span
                        class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle p-1 notification-badge">
                        {{ $unreadNotifications->count() }} </span>
                @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end notification-dropdown-menu"
                aria-labelledby="notificationDropdown">
                @if (!isset($notifications) || $notifications->isEmpty())
                    <li class="dropdown-item text-muted small d-flex align-items-center gap-2"> <i
                            class="fas fa-info-circle"></i> No notifications </li>
                @else
                    @foreach ($notifications as $index => $notification)
                        <li> <a href="{{ route('user.report.notifications.markRead', $notification->id) }}"
                                class="dropdown-item d-flex align-items-start gap-2 {{ is_null($notification->read_at) ? 'fw-bold' : 'text-muted' }}">
                                <i class="fas fa-info-circle mt-1"></i>
                                <div>
                                    <strong>{{ $notification->data['title'] ?? class_basename($notification->type) }}</strong><br>
                                    <small class="text-muted submitted-by-text"> <strong>User:</strong>
                                        {{ $notification->data['submitted_by'] ?? 'Unknown' }} </small><br> <small
                                        class="notification-message">
                                        {{ \Illuminate\Support\Str::limit($notification->data['message'] ?? '', 60) }}
                                    </small> <small class="text-muted notification-time">
                                        {{ $notification->created_at->diffForHumans() }} </small>
                                </div>
                            </a> </li>
                        @if ($index !== $notifications->count() - 1)
                            <hr class="my-2 mx-3" />
                        @endif
                    @endforeach
                @endif
            </ul>
        </li> <!-- Settings Dropdown -->
        <li class="navbar__item dropdown">
            <details>
                <summary class="dropdown__toggle" aria-haspopup="true" aria-label="Settings"> <i class="fas fa-cog"></i>
                </summary>
                <ul class="dropdown__menu" role="menu">
                    <li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"> @csrf <button
                                type="submit" class="dropdown__item"> <i class="fas fa-sign-out-alt"></i> Logout
                            </button> </form>
                    </li>
                    <li>
                        <a href="{{ route('user.report.user.profile.show') }}" class="dropdown__item">
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
    <aside id="sidebar" class="sidebar py-3 px-2">
        <!-- Brand -->
        <div class="sidebar__brand d-flex align-items-center gap-2 px-3 mb-4">
            <i class="fas fa-shield-alt fs-5"></i>
            <span class="fw-semibold fs-6">Incident Reporting</span>
        </div>

        <!-- Navigation -->
        <ul class="sidebar__nav d-flex flex-column gap-2 mb-0 list-unstyled">
            <li class="sidebar__item">
                <a href="{{ route('user.report.userMainDashboard') }}"
                    class="sidebar__link {{ request()->routeIs('user.report.userMainDashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('user.report.userDashboardReporting') }}"
                    class="sidebar__link {{ request()->routeIs('user.report.userDashboardReporting') ? 'active' : '' }}">
                    <i class="fas fa-file-alt me-2"></i>
                    <span>Reports List</span>
                </a>
            </li>
            <li class="sidebar__item">
                <a href="{{ route('user.report.userIncidentReporting.create') }}"
                    class="sidebar__link {{ request()->routeIs('user.report.userIncidentReporting.create') ? 'active' : '' }}">
                    <i class="fas fa-edit me-2"></i>
                    <span>Create Report</span>
                </a>
            </li>
        </ul>
    </aside>
</div>
