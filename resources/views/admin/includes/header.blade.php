<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Secure Me Admin Panel</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/app.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/css/components.css') }}">

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/custom.css') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-assets/img/favicon.ico') }}">
</head>


<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar sticky">
                <div class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg collapse-btn"> <i
                                    data-feather="align-justify"></i></a></li>
                        <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                                <i data-feather="maximize"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown"
                           class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('admin-assets/img/users/user-3.png') }}" class="user-img-radious-style">
                            <span class="d-sm-none d-lg-inline-block"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right pullDown">
                            <div class="dropdown-title">
                                {{ session('admin_email', 'Guest') }}
                            </div>

                            <a href="{{ url('admin/profile') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>
                            <a href="{{ url('admin/activities') }}" class="dropdown-item has-icon">
                                <i class="fas fa-bolt"></i> Activities
                            </a>
                            <a href="{{ url('admin/settings') }}" class="dropdown-item has-icon">
                                <i class="fas fa-cog"></i> Settings
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="{{ url('admin/logout') }}" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>

            <!-- Sidebar starts -->
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ url('/admin-login') }}"> <img src="{{ asset('admin-assets/img/logo.png') }}"
                                class="header-logo" /> <span class="logo-name">Secure Me</span>
                        </a>
                    </div>
                    <ul class="sidebar-menu">
                        <!-- Dashboard -->
                        <li class="dropdown {{ Request::is('admin/admin-dashboard') ? 'active' : '' }}">
                            <a href="{{ url('admin/admin-dashboard') }}" class="nav-link">
                                <i data-feather="home"></i><span>Dashboard</span>
                            </a>
                        </li>

                        <!-- Manage Users -->
                        <li class="dropdown {{ Request::is('admin/users-list*') || Request::is('admin/users-details*') ? 'active' : '' }}">
                            <a href="{{ url('admin/users-list') }}" class="nav-link">
                                <i data-feather="users"></i><span>Manage Users</span>
                            </a>
                        </li>

                        </li>

                        <!-- Emergency Signals -->
                        <li class="dropdown {{ Request::is('admin/all-emergency-signals') ? 'active' : '' }}">
                            <a href="{{ url('admin/all-emergency-signals') }}" class="nav-link"><i data-feather="alert-triangle"></i><span>Emergency Signals</span></a>
                        </li>

                        <!-- Emergency Responses -->
                        <li class="dropdown {{ Request::is('admin/all-emergency-responses') ? 'active' : '' }}">
                            <a href="{{ url('admin/all-emergency-responses') }}" class="nav-link"><i data-feather="activity"></i><span>Emergency Responses</span></a>
                        </li>

                        <!-- Instant Emergency Groups -->
                        <li class="dropdown">
                            <a href="{{ url('admin/instant-emergency-groups') }}" class="nav-link"><i data-feather="users"></i><span>Instant Emergency Groups</span></a>
                        </li>

                        <!-- Reports & Logs -->
                        <li class="dropdown">
                            <a href="{{ url('admin/reports-and-logs') }}" class="nav-link"><i data-feather="file-text"></i><span>Reports & Logs</span></a>
                        </li>

                        <!-- Settings -->
                        <li class="dropdown">
                            <a href="{{ url('admin/settings') }}" class="nav-link"><i data-feather="settings"></i><span>Settings</span></a>
                        </li>
                    </ul>

                    <script>
                    // Initialize Feather icons
                    feather.replace();
                    </script>

                </aside>
            </div>