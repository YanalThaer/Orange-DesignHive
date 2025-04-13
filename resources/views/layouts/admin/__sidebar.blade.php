<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/admin/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            {{-- <i class="fas fa-laugh-wink"></i> --}}
            <span class="material-icons">hive</span>
        </div>
        <div class="sidebar-brand-text mx-3">Hive Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('/admin/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Home Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Request::is('admin/admins') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/admins') }}">
            <i class="fa-solid fa-user-shield"></i>
            <span>Admins</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/users') }}">
            <i class="fa-solid fa-user"></i>
            <span>Users</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/categories') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/categories') }}">
            <i class="fa-solid fa-list"></i>
            <span>Categories</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/tags') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/tags') }}">
            <i class="fa-solid fa-list"></i>
            <span>Tags</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/subscriptions') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/subscriptions') }}">
            <i class="fa-solid fa-credit-card"></i>
            <span>Subscriptions</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/projects') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/projects') }}">
            <i class="fa-solid fa-toolbox"></i>
            <span>Projects</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/comments') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/comments') }}">
            <i class="fa-solid fa-comment"></i>
            <span>Comments</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/payments') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/payments') }}">
            <i class="fa-solid fa-coins"></i>
            <span>Payments</span>
        </a>
    </li>

    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>