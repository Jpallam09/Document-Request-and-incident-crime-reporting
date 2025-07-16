<nav class="navbar">
    {{-- Hamburger button (mobile only, toggles sidebar via external JS) --}}
    <button id="sidebarToggle"
            class="navbar__burger"
            aria-label="Toggle sidebar"
            aria-expanded="false">
        ☰
    </button>

    <div class="navbar__brand">Staff Panel</div>

    <ul class="navbar__menu">
        {{-- Notifications Dropdown --}}
        <li class="navbar__item dropdown">
            <details>
                <summary aria-haspopup="true" aria-label="Notifications" class="dropdown__toggle">
                    🔔 <span class="dropdown__badge">0</span>
                </summary>
                <ul class="dropdown__menu" role="menu">
                    <li><a href="#" class="dropdown__item">New report submitted</a></li>
                    <li><a href="#" class="dropdown__item">1 update request</a></li>
                </ul>
            </details>
        </li>

        {{-- Settings Dropdown --}}
        <li class="navbar__item dropdown">
            <details>
                <summary aria-haspopup="true" aria-label="Settings" class="dropdown__toggle">
                    ⚙️
                </summary>
                <ul class="dropdown__menu" role="menu">
                    <li>
                        {{-- Logout form --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown__item">Logout</button>
                        </form>
                    </li>
                    <li>
                        <a href="#" class="dropdown__item">Profile</a>
                    </li>
                </ul>
            </details>
        </li>
    </ul>
</nav>
