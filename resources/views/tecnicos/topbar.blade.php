<!-- Topbar Start -->
<div class="navbar-custom">
    <ul class="list-unstyled topbar-menu float-end mb-0">

        <li class="dropdown notification-list">
            <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#" role="button"
                aria-haspopup="false" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="{{ asset('images/tecnicos/UIMG202204266268204a466bc.jpg') }}" alt="user-image"
                        class="rounded-circle">
                </span>
                <span>
                    <span class="account-user-name">{{ Auth::user()->name }}</span>
                    <span class="account-position">Tecnico</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                <!-- item-->
                <div class=" dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Bem-vindo !</h6>
                </div>

                <!-- item-->
                <a href="#" class="dropdown-item notify-item" id="logout">
                    <i class="mdi mdi-logout me-1"></i>
                    <span>Logout</span>
                </a>
            </div>
        </li>

    </ul>
    <button class="button-menu-mobile open-left">
        <i class="mdi mdi-menu"></i>
    </button>

</div>
<!-- end Topbar -->
