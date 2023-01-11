<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">E-MANAGE</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{auth()->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{url('/')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('personnels') ? 'active' : '' }}" href="{{route('personnels.index')}}">
                        <i class="far fa-user nav-icon"></i>
                        <p>Personnels</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('permission') ? 'active' : '' }}" href="{{route('permission.index')}}">
                        <i class="fas fa-lock"></i>
                        <p>Permissions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>Congés & Abscences</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('departements') ? 'active' : '' }}" href="{{route('departements.index')}}">
                        <i class="fas fa-building nav-icon"></i>
                        <p>Départements</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('directions') ? 'active' : '' }}" href="{{route('directions.index')}}">
                        <i class="fas fa-location-arrow nav-icon"></i>
                        <p>Directions</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="fas fa-file nav-icon"></i>
                        <p>Documents</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="fas fa-arrow-right nav-icon"></i>
                        Déconnexion
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


