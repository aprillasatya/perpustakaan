<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>

        <!-- Scripts -->
        <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

        <!-- Fonts -->
        <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

        <!-- Styles -->
        <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

        <!-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" /> -->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"
        />
        @stack('styles')

        <script
            src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"
            crossorigin="anonymous"
        ></script>
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script> -->
        <script defer src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script
            defer
            src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"
        ></script>
        <script
            defer
            src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"
        ></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        @stack('scripts')
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a
                class="navbar-brand ps-3"
                href="{{ Auth::guard('admin')->check() ? route('admin.home') : route('home') }}"
                >Perpustakaan</a
            >
            <!-- Sidebar Toggle-->
            <button
                class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
                id="sidebarToggle"
                href="#!"
            >
                <i class="fas fa-bars"></i>
            </button>
            <!-- Navbar Search-->
            <form
                class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0"
            >
                <div class="input-group">
                    <!-- <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button> -->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        id="navbarDropdown"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                        ><i class="fas fa-user fa-fw"></i
                    ></a>
                    <ul
                        class="dropdown-menu dropdown-menu-end"
                        aria-labelledby="navbarDropdown"
                    >
                        <li>
                            <a
                                class="dropdown-item"
                                href="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"
                            >
                                {{ __("Logout") }}
                            </a>

                            <form
                                id="logout-form"
                                action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('logout') }}"
                                method="POST"
                                class="d-none"
                            >
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav
                    class="sb-sidenav accordion sb-sidenav-dark"
                    id="sidenavAccordion"
                >
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a
                                class="nav-link"
                                href="{{ Auth::guard('admin')->check() ? route('admin.home') : route('home') }}"
                            >
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            @if(Auth::guard('admin')->check())
                            <a
                                class="nav-link"
                                href="{{ route('admin.form-member') }}"
                            >
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                Anggota
                            </a>
                            <a
                                class="nav-link"
                                href="{{ route('admin.form-book') }}"
                            >
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                Buku
                            </a>
                            <a
                                class="nav-link"
                                href="{{ route('admin.borrowing-book') }}"
                            >
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-chart-area"></i>
                                </div>
                                Peminjaman Buku
                            </a>
                            @endif @if(Auth::guard('web')->check())
                            <a class="nav-link" href="{{ route('view-book') }}">
                                <div class="sb-nav-link-icon">
                                    <i class="fas fa-table"></i>
                                </div>
                                Buku
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        @if(Auth::guard('admin')->check())
                        {{ Auth::guard('admin')->user()->name }}
                        @elseif(Auth::guard('web')->check())
                        {{Auth::guard('web')->user()->name}}
                        @endif
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>@yield('content')</main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div
                            class="d-flex align-items-center justify-content-between small"
                        >
                            <div class="text-muted">
                                Copyright &copy; Your Website 2023
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>
