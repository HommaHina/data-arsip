<body id="page-top">

    <div id="wrapper">

        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-brands fa-phoenix-squadron"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item" id="pengguna">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="nav-item" id="pengguna">
                <a class="nav-link" href="{{ route('pegawai.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Pegawai</span></a>
            </li>

            <li class="nav-item" id="pengguna">
                <a class="nav-link" href="{{ route('pangkat.index') }}">
                    <i class="fas fa-fw fa-angle-double-up"></i>
                    <span>Pangkat</span></a>
            </li>
            <li class="nav-item" id="log_pengguna">
                <a class="nav-link" href="{{ route('berkala.index') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Berkala</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand-lg navbar-light bg-white topbar mb-4 static-top shadow">

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa-regular fa-circle-user mr-2"></i>
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ session('user_nama') }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('IndexPassword') }}">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>


