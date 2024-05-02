<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Aeneas Actu </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="/vendors/feather/feather.css">
    <link rel="stylesheet" href="/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!--<link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">-->
    <link rel="stylesheet" href="/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!--css et js for datatbales-->
    <link rel="stylesheet" href="/vendors/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="/vendors/datatables/css/bootstrap4.5.2.css">
    <!-- end datatables-->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    @if (isset(auth()->user()->full_name))
                        <a class="navbar-brand brand-logo" href="welcome">
                            ÆNEAS WA
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="welcome">
                            <img src="/images/logo-mini.png" alt="logo" />
                        </a>
                    @else
                        <a class="navbar-brand brand-logo" href="customer_welcome">
                            ÆNEAS WA
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="customer_welcome">
                            <img src="/images/logo-mini.png" alt="logo" />
                        </a>
                    @endif
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">

                    <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">{{ __('messages.greeting_home') }} <span
                                class="text-black fw-bold">@yield('full_name', 'John Doe')</span></h1>
                        <h3 class="welcome-sub-text">@lang('messages.First_advise')</h3>
                    </li>
                </ul>
              
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                      @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        
                              @php
                                  //dd($localeCode);
                              @endphp
                               <button class="btn btn-sm btn-outline-secondary btn-fw">
                                  <a class="nav-link" rel="alternate"
                                      hreflang="{{ $localeCode }}"
                                      href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                      {{ $localeCode }}
                                  </a>
                                </button>
                   
                      @endforeach
                    </li>
                    <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img class="img-xs rounded-circle" src="/images/faces/face8.jpg" alt="Profile image"> </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <img class="img-md rounded-circle" src="/images/faces/face8.jpg" alt="Profile image">
                                <p class="mb-1 mt-3 font-weight-semibold">@yield('profile_name', 'Allen Moreno')</p>
                                <p class="fw-light text-muted mb-0">@yield('profile_email', 'allenmoreno@gmail.com')</p>
                            </div>
                            <form method="post" action="admin_profile">
                                @csrf
                                @if (isset(auth()->user()->full_name))
                                    <input type="text" name="id_admin" value="{{ auth()->user()->id }}"
                                        style="display: none;">
                                    <button type="submit" class="dropdown-item"><i
                                            class="dropdown-item-icon mdi mdi-power text-primary me-2"></i> @lang('actions.my_profile') </button>
                                @endif

                            </form>

                            <form method="post" action="logout_admin">
                                @csrf
                                <button type="submit" class="dropdown-item"><i
                                        class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>@lang('actions.Sign_out')</button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">

                </ul>

                <!-- To do section tab ends -->

                <!-- chat tab ends
        </div> -->
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        @if (isset(auth()->user()->full_name))
                            <a class="nav-link"
                                href="welcome"><!--CREER UNE CONDITION ICI POUR AFFICHER CE QU'IL FAUT AFFICHER-->
                                <i class="mdi mdi-grid-large menu-icon"></i>
                                <span class="menu-title">@lang('menu_admin.Dashboard')</span>
                            </a>
                        @endif

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="customers">
                            <i class="menu-icon  mdi mdi-briefcase-check "></i>
                            <span class="menu-title">@lang('menu_admin.Customers')</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="users">
                            <i class="menu-icon  mdi mdi-account-multiple-plus"></i>
                            <span class="menu-title">@lang('menu_admin.Users')</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="press_review">
                            <i class="menu-icon  mdi mdi-folder-multiple-outline "></i>
                            <span class="menu-title">@lang('menu_admin.Press review')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="articles_view">
                            <i class="menu-icon  mdi mdi-folder-multiple-outline "></i>
                            <span class="menu-title">@lang('menu_admin.Press Articles')</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="bhi">
                            <i class="menu-icon  mdi mdi-library-books "></i>
                            <span class="menu-title">@lang('menu_admin.BHI')</span>
                        </a>
                    </li>
                    
                      @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                
                        <li class="nav-item">
                            <a class="nav-link" rel="alternate"
                                hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <span class="menu-title">
                                  {{ $localeCode }}
                                </span>
                            </a>
                        </li>
                  
                      @endforeach
                    
                </ul>
            </nav>
            <!-- partial -->
            <div class="main-panel">
                @yield('content')
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">

                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2024 Æneas
                            West Africa</span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- plugins:js -->
    <script src="/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="/vendors/chart.js/Chart.min.js"></script>
    <script src="/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="/vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="/js/off-canvas.js"></script>
    <script src="/js/hoverable-collapse.js"></script>
    <script src="/js/template.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="/js/dashboard.js"></script>
    <script src="/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->

    <!-- dataTables -->

    <script src="/vendors/datatables/js/dataTables.js"></script>
    <script src="/vendors/datatables/js/dataTables.bootstrap4.js"></script>
    <script src="/vendors/datatables/js/bootstrap.min.js"></script>
    <script src="/vendors/datatables/js/popper.min.js"></script>
    <script src="/vendors/datatables/js/jquery-3.7.1.js"></script>
    <!-- end -->

    <script type="text/javascript">
        new DataTable('#example');
    </script>
</body>

</html>
