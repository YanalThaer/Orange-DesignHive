<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
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
    <li class="nav-item {{ Request::is('admin/categories') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/categories') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Category</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/posts') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/posts') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Posts</span>
        </a>
    </li>

    <li class="nav-item {{ Request::is('admin/posts') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('/admin/posts') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Posts</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>