<header class="pc-header">
    <div class="header-wrapper">
        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled">
                <li class="pc-h-item header-mobile-collapse">
                    <a href="#" class="pc-head-link head-link-secondary ms-0" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link head-link-secondary ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>
        </div>
        <!-- [Mobile Media Block end] -->
        <div class="ms-auto d-flex align-items-center">
            <span class="fw-semibold text-dark me-2">Hi, {{ Auth::user()->first_name }}</span>
            <ul class="list-unstyled mb-0">
                <li class="dropdown pc-h-item header-user-profile">
                    <a
                        class="pc-head-link head-link-primary d-flex align-items-center justify-content-center p-0"
                        data-bs-toggle="dropdown"
                        href="#"
                        role="button"
                        aria-haspopup="true"
                        aria-expanded="false"
                        style="background: none; border: none; width: 40px; height: 40px;"
                    >
                        <span class="user-avatar-initials-circle">
                            {{ Auth::user()->getUserAvatarName() }}
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <h4>
                                <span class="small text-muted"> {{ Auth::user()->name }}</span>
                            </h4>
                            <p class="text-muted"><span class="sub-text">{{ Auth::user()->email }}</span></p>
                            <hr />
                            <div class="profile-notification-scroll position-relative" style="max-height: calc(100vh - 280px)">
                                <a href="#" class="dropdown-item">
                                    <i class="ti ti-settings"></i>
                                    <span>Account Settings</span>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="ti ti-user"></i>
                                    <span>Social Profile</span>
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    <i class="ti ti-logout"></i>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <style>
        .user-avatar-initials-circle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: #e9ecef;
            color: #495057;
            font-size: 1.2rem;
            font-weight: 600;
            border-radius: 50%;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            transition: box-shadow 0.2s;
        }
        .user-avatar-initials-circle:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        }
        .fw-semibold {
            font-weight: 500;
        }
        .header-user-profile .dropdown-toggle::after {
            display: none;
        }
    </style>
</header>