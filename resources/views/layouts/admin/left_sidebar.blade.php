<div class="leftside-menu">
    <div class="h-100" id="leftside-menu-container" data-simplebar>

        <!--- Sidemenu -->
        <ul class="side-nav">

            <li class="side-nav-title side-nav-item">Menu</li>

            <li class="side-nav-item">
                <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false"
                    aria-controls="sidebarDashboards" class="side-nav-link">
                    <i class="uil-home-alt"></i>
                    <span> Dashboard</span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                    <ul class="side-nav-second-level">
                        <li>
                            <a href="{{ route('admin.dashboard') }}">Dashboard 1</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.dashboard.stripe') }}">Dashboard 2</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="side-nav-item menuitem">
                <a href="{{ route('admin.transfers') }}" class="side-nav-link ">
                    <i class="uil-calender"></i>
                    <span> Transações </span>
                </a>
            </li>
        </ul>

        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
