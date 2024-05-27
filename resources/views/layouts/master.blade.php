<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <title>MMY JCD - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/siqtheme.css') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/dashboard1.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-select/bootstrap-select.min.css') }}">

</head>

<body class="theme-dark">
    <div class="grid-wrapper sidebar-bg bg1">

        <!-- Theme switcher -->
        <div id="theme-tab">
            <div class="theme-tab-item switch-theme bg-white" data-theme="theme-default" data-toggle="tooltip" title="Light"></div>
            <div class="theme-tab-item switch-theme bg-dark" data-theme="theme-dark" data-toggle="tooltip" title="Dark"></div>
        </div>

        <!-- BOF HEADER -->
        <div class="header">
            <div class="header-bar">
                <div class="brand">
                    <a href="index.html" class="logo"><span class="text-carolina">MMY</span>JCD</a>
                    <a href="index.html" class="logo-sm text-carolina" style="display: none;">siQ</a>
                </div>
                <div class="btn-toggle">
                    <a href="#" class="slide-sidebar-btn" style="display: none;"><i class="ti-menu"></i></a>
                </div>
                <div class="navigation d-flex">
                    <!-- BOF Header Nav -->
                    <div class="navbar-menu d-flex">
                        <div class="menu-item">
                            <a href="#" class="btn" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <span class="badge badge-pill badge-danger">3</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-alert">
                                <li class="dropdown-header text-center"><a href="#"><i class="ti-comment-alt"></i> View
                                        All Alerts <i class="ti-angle-right"></i></a></li>
                                <li><a href="#"><i class="fa fa-user"></i> New user registered <span>Just now</span></a>
                                </li>
                                <li><a href="#"><i class="fa fa-calendar-plus-o"></i> New event created <span>5 min
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-area-chart"></i> Report ready to download <span>1 day
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-bank"></i> Bill payment reminder <span>1 day
                                            ago</span></a></li>
                                <li><a href="#"><i class="fa fa-clock-o"></i> Staff meeting <span>3 days ago</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <a href="#" class="btn" data-toggle="dropdown">
                                <i class="ti-email"></i>
                                <span class="badge badge-pill badge-success">7</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right dropdown-message">
                                <li class="dropdown-header text-center"><a href="#"><i class="ti-comments"></i> View All
                                        Messages <i class="ti-angle-right"></i></a></li>
                                <li>
                                    <img src="assets/img/profile/profile-04.jpg">
                                    <div class="message-row">
                                        <small>24h ago</small>
                                        <a href="#"><span class="message-user">Pear Appleton</span><br>
                                            Staff meeting on Tuesday at 4PM, remember to set date</a>
                                    </div>
                                </li>
                                <li>
                                    <img src="assets/img/profile/profile-07.jpg">
                                    <div class="message-row">
                                        <small>2h ago</small>
                                        <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                            RE: Remember to generate PNL for October</a>
                                    </div>
                                </li>
                                <li>
                                    <img src="assets/img/profile/profile-06.jpg">
                                    <div class="message-row">
                                        <small>3d ago</small>
                                        <a href="#"><span class="message-user">Lemony Tang</span><br>
                                            Appointment with lawyer, better call Saul!</a>
                                    </div>
                                </li>
                                <li>
                                    <img src="assets/img/profile/profile-07.jpg">
                                    <div class="message-row">
                                        <small>4d ago</small>
                                        <a href="#"><span class="message-user">siQuang Humbleman</span><br>
                                            Theme designed by siQuang for siQthemes</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="menu-item">
                            <a href="#" class="btn right-sidebar-toggle"><i class="ti-user"></i></a>
                        </div>
                    </div>
                    <!-- EOF Header Nav -->

                </div>
            </div>
        </div>
        <!-- EOF HEADER -->

        <!-- BOF ASIDE-LEFT -->
        <div id="sidebar" class="sidebar">
            <div class="sidebar-content">
                <!-- sidebar-menu  -->
                <div class="sidebar-menu">
                    <ul>
                        <li class="header-menu">
                            Menu
                        </li>
                        <li class="active">
                            <a href="/dashboard">
                                <i class="ti-dashboard"></i>
                                <span class="menu-text">Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <li class="maincat ">
                                <a href="#">
                                    <i class="ti-file"></i>
                                    <span class="menu-text">Kategori Data</span>
                                </a>
                                <div class="subcat">
                                    <ul>
                                        <li>
                                            <a href="/penggunaan-produk">Penggunaan Produk</a>
                                        </li>
                                        <li>
                                            <a href="/jenis-kategori">Jenis Produk</a>
                                        </li>
                                        <li>
                                            <a href="/kelas-produk">Kelas dan Varian Produk</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="active">
                                <a href="/inventory-list">
                                    <i class="ti-view-grid"></i>
                                    <span class="menu-text">Inventory List</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="/toko">
                                    <i class="ti-shopping-cart"></i>
                                    <span class="menu-text">Toko</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="/supplier">
                                    <i class="ti-truck"></i>
                                    <span class="menu-text">Supplier</span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="/user">
                                    <i class="ti-user"></i>
                                    <span class="menu-text">Users</span>
                                </a>
                            </li>
                        @endif
                        
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                            <li class="active">
                                <a href="/gudang-purchase">
                                    <i class="ti-shopping-cart"></i>
                                    <span class="menu-text">Gudang Purchase</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 5)
                            <li class="active">
                                <a href="/gudang-produksi">
                                    <i class="ti-package"></i>
                                    <span class="menu-text">Gudang Produksi</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 6)
                            <li class="active">
                                <a href="/gudang-toko">
                                    <i class="ti-bag"></i>
                                    <span class="menu-text">Gudang Toko</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 7)
                            <li class="active">
                                <a href="/gudang-frozen">
                                    <i class="fa fa-snowflake-o"></i>    
                                    <span class="menu-text">Gudang Frozen</span>
                                </a>
                            </li>
                        @endif
                        
                        @if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 3 )
                            <li class="active">
                                <a href="/pengajuan-purchase">
                                    <i class="fa  fa-paper-plane"></i>    
                                    <span class="menu-text">Pengajuan Purchase</span>
                                </a>
                            </li>
                        @endif

                        
                    </ul>
                </div>
                <!-- sidebar-menu  -->
            </div>
        </div>
        <!-- EOF ASIDE-LEFT -->

        <!-- BOF MAIN -->
        @yield('content')
        <!-- EOF MAIN -->

        <!-- BOF FOOTER -->
        <div class="footer">
            <p class="text-center">
                <a class="ml-2" href="https://opensource.org/licenses/MIT" target="_blank"><img src="https://img.shields.io/badge/License-MIT-green.svg" alt="siQtheme License"></a>
                <a class="ml-2" href="https://github.com/siQuang/siqtheme/releases" target="_blank"><img src="https://img.shields.io/github/release/siQuang/siqtheme.svg" alt="Github siQtheme"></a>
                <a class="ml-2" href="https://www.npmjs.com/package/siqtheme" target="_blank"><img src="https://img.shields.io/npm/v/siqtheme/latest.svg" alt="NPM siQtheme"></a>
            </p>

            <p class="text-center">Copyright © 2019-2020 siQtheme by <a href="https://siquang.com/" target="_blank">3M Square</a>. All rights reserved.</p>
        </div>
        
        <!-- Preloader -->
        <div id="preloader"></div>

        <!-- EOF FOOTER -->

        <!-- BOF ASIDE-RIGHT -->
        <div id="sidebar-right">
            <div class="sidebar-right-container">

                <!-- BOF TABS -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="#tab-1" data-toggle="tab" class="nav-link active">Profile</a>
                    </li>
                </ul>
                <!-- EOF TABS -->

                <!-- BOF TAB PANES -->
                <div class="tab-content">
                    <!-- BOF TAB-PANE #1 -->
                    <div id="tab-1" class="tab-pane show active">
                        <div class="pane-header">
                            <h3><i class="ti-user"></i> User Panel</h3>
                            <i class="fa fa-circle text-success"></i> <span class="profile-user">{{ Auth::user()->name }}</span>
                            <span class="float-right"><a href="{{ route('auth.logout') }}" class="text-carolina">Log-Out</a></span>
                        </div>
                        <div class="pane-body">
                            <div class="card bg-transparent mb-3">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <h5 class="mb-3">My Theme</h5>
                                        <div class="btn-group mb-2">
                                            <button type="button" class="btn switch-theme btn-light" data-theme="theme-default">Light</button>
                                            <button type="button" class="btn switch-theme btn-dark" data-theme="theme-dark">Dark</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <h5 class="mb-3">My Profile</h5>
                                        <form class="form-update-profile">
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">User Name:</label>
                                                <div class="col">
                                                    <input type="text" name="first_name" class="form-control-plaintext"
                                                        value="{{ Auth::user()->name }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Email:</label>
                                                <div class="col">
                                                    <input type="text" name="email" class="form-control-plaintext"
                                                        value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-md-4">Password:</label>
                                                <div class="col">
                                                    <input type="password" name="password" class="form-control-plaintext"
                                                        value="{{ Auth::user()->password }}">
                                                </div>
                                            </div>
                                            <div class="col offset-md-4 pl-2">
                                                <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- EOF TAB-PANE #1 -->
                </div>
                <!-- EOF TAB PANES -->

            </div>
        </div>
        <!-- EOF ASIDE-RIGHT -->

        <div id="overlay"></div>

    </div> <!-- END WRAPPER -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/scripts/siqtheme.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/scripts/pages/fm_control.js') }}"></script>
    <script src="{{ asset('assets/scripts/pages/dashboard1.js') }}"></script>
    <script src="{{ asset('assets/scripts/pages/tb_datatables.js') }}"></script>
    <script src="{{ asset('assets/scripts/pages/ui_modal.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('script')
</body>


<!-- Mirrored from siqtheme.siquang.com/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 04 May 2024 13:35:46 GMT -->
</html>