<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | Business Development</title>
    <meta name="viewport" con tent="width=device-width, initial-scale=1.0" />

    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <!-- links -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" />

    <!-- Plugins css -->
    <link href="{{ asset('assets/css/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{ asset('assets/css/bootstrap-creative.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/app-creative.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
    <link href="{{ asset('assets/css/bootstrap-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{ asset('assets/css/app-creative-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dropify.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- end links -->
    <script src="{{ asset('assets/js/jquery-v3.6.0.js') }}"></script>
</head>

<body class="{{ request()->is('dashboard') ? '' : 'loading bg-white' }}" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

    <!-- loader -->
    <div id="preloader" style="display:none">
        <div id="loader"></div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">
        <!-- Topbar Start -->

        <!-- header -->
        <div class="progress-bar">
            <div class="progress-bar__line"></div>
        </div>
        <div class="navbar-custom">
            <div class="container-fluid">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    <li class="mt-2">
                        @if(session()->get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success! </strong> {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                    </li>
                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="badge badge-danger rounded-circle noti-icon-badge">9</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right notbx dropdown-lg">
                            <!-- item-->
                            <div class="dropdown-item noti-title">
                                <h5 class="m-0">
                                    <span class="float-right">
                                        <a href="#" class="text-dark">
                                            <small>Clear All</small>
                                        </a> </span>Notification
                                </h5>
                            </div>

                            <div class="noti-scroll" data-simplebar>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                    <div class="notify-icon">
                                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-circle" alt="" />
                                    </div>
                                    <p class="notify-details">Cristina Pride</p>
                                    <p class="text-muted mb-0 user-msg">
                                        <small>Hi, How are you? What about our next meeting</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-primary">
                                        <i class="mdi mdi-comment-account-outline"></i>
                                    </div>
                                    <p class="notify-details">
                                        Caleb Flakelar commented on Admin
                                        <small class="text-muted">1 min ago</small>
                                    </p>
                                </a>

                            </div>

                            <!-- All-->
                            <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                                View all
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </li>

                    <li class="dropdown notification-list topbar-dropdown">
                        <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><span class="pro-user-name ml-1">
                                @if(session()->has('userId')){{ session()->get('userEmail') }} @endif <i class="fa fa-angle-down"></i>
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fa fa-user"></i>
                                <span>My Account</span>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <i class="fa fa-lock"></i>
                                <span>Lock Screen</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <!-- item-->
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                                <i class="fa fa-sign-out"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>

                <!-- LOGO -->
                <div class="logo-box">
                    <a href="{{ URL('dashboard') }}" class="logo logo-dark text-center">
                        <span class="logo-sm">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="22" />

                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="20" />

                        </span>
                    </a>

                    <a href="{{ URL('dashboard') }}" class="logo logo-light text-center">
                        <span class="logo-lg">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="" height="60" />
                        </span>
                    </a>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- end Topbar -->

        <div class="topnav shadow-lg">
            <div class="container-fluid">
                <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                    <div class="collapse navbar-collapse" id="topnav-menu-content">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link arrow-none" href="{{ URL('dashboard') }}" id="topnav-dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Supplier
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-apps">
                                    <a href="{{ route('supplier.list') }}" class="dropdown-item">List</a>
                                    <a href="{{ route('supplier.create') }}" class="dropdown-item">Add New</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link arrow-none" href="{{ URL('inventory') }}" id="topnav-dashboard">Inventory</a>
                            </li>
                        </ul>
                        <!-- end navbar-->
                    </div>
                    <!-- end .collapsed-->
                </nav>
            </div>
            <!-- end container-fluid -->
        </div>
        <!-- end topnav-->
        <!-- end header -->

        @yield('content')

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        &copy; <a href="#">Resellmall</a>
                    </div>

                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    </div>
    <!-- END wrapper -->

    <!-- scripts -->
    <!-- Vendor js -->
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('assets/js/flatpickr.min.js') }}"></script>

    <script src="{{ asset('assets/js/selectize.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>


    <!-- App js-->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>

    <script src="{{ asset('assets/js/footable.all.min.js') }}"></script>


    <!-- Below JS is used for creating more than one tables  for using in panel-->
    <script src="{{ asset('assets/js/foo-tables.init.js') }}"></script>


    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <!-- Gallery Init-->
    <script src="{{ asset('assets/js/gallery.init.js') }}"></script>

    <!-- Below Js is used to highlight the searched word inside the datatable -->

    <script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

    <!-- Sweet alert init js-->
    <script src="{{ asset('assets/js/sweet-alerts.init.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropify.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.init.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- end script -->

</body>

</html>