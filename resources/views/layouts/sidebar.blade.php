<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">Book Rent</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    @if (Auth()->user())
                    {{ Auth()->user()->username }}
                    @endif 
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @if (Auth::user())
                    @if (Auth::user()->role_id == 1)
                        <li class="nav-item">
                            <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/books" class="nav-link {{ request()->is('books', 'books/add', 'books/{slug}/edit') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Books</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/categories" class="nav-link {{ request()->is('categories', 'categories/add', 'categories/{slug}/edit', 'categories/show-deleted') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/users" class="nav-link {{ request()->is('users', 'users/add', 'users/{slug}/edit', 'users/registered-user', 'users/show-banned', 'users/{slug}/detail') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/rent-logs" class="nav-link {{ request()->is('rent-logs') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Rent Logs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Book List</p>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="/users/profile" class="nav-link {{ request()->is('users', 'users/profile', 'users/add', 'users/{slug}/edit', 'users/registered-user', 'users/show-banned', 'users/{slug}/detail') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Book List</p>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a href="/login" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Login</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
