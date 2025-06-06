<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="ialsmxvxbFVMvehWybzdppDZtGxGJ4kODeqmi07p">
    <title>Sellar | Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" href="{{asset('user/account/storage/app/public/photos/uPYDzhfavicon.png1677339254')}}"
        type="image/png">
    <link rel="shortcut icon" href="{{asset('page/assets/images/icons/favicon.png')}}">

    <!-- Stripe JS -->
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>

    <!-- Fonts and icons -->
    <script src="{{asset('user/account/dash/js/plugin/webfont/webfont.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('user/account/dash/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/account/dash/css/fonts.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/account/dash/css/atlantis.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/account/dash/css/customs.css')}}">
    <link rel="stylesheet" href="{{asset('user/account/dash/css/style.css')}}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/bs4/dt-1.10.21/af-2.3.5/b-1.6.3/b-flash-1.6.3/b-html5-1.6.3/b-print-1.6.3/r-2.2.5/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">

    <!-- W3CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{asset('user/account/dash/js/plugin/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('user/account/dash/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.1/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


</head>

<body data-background-color="light">
    <div id="app">

        <div class="wrapper">
            <div class="main-header">
                <!-- Logo Header -->

                <div class="logo-header" data-background-color="blue">
                    <a href="{{route('admin.home')}}" class="logo" style="font-size: 27px; color:#fff;">
                        Sellar
                    </a>
                    <button class="ml-auto navbar-toggler sidenav-toggler" type="button" data-toggle="collapse"
                        data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="fa fa-bars"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more"><i class="icon-options-vertical "></i></button>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                </div>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue">

                    <div class="container-fluid">
                        <div class="collapse" id="search-nav">


                        </div>
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">

                            <li class="nav-item dropdown hidden-caret">
                                <div id="google_translate_element"></div>
                            </li>
                            <li class="nav-item dropdown hidden-caret">
                                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                                    <i class="text-white fa fa-user"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <a class="dropdown-item" href="#">Account Settings</a>
                                            <a class="dropdown-item" href="#">Change Password</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#"
                                                onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                                Logout
                                            </a>
                                            <form id="logoutform" action="" method="POST" style="display: none;">
                                                @csrf
                                            </form>

                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>


            <script type="text/javascript">
                //create investment
        $("#styleform").on('change',function(){
        $.ajax({
            url: "https://stockmarket-hq.com/account/admin/dashboard/changestyle",
            type: 'POST',
            data:$("#styleform").serialize(),
            success: function (data) {
				location.reload(true);
            },
            error: function (data) {
                console.log('Something went wrong');
            },

        });
    });
    
            </script>
            <!-- Stored in resources/views/child.blade.php -->

            <!-- Sidebar -->
            <div class="sidebar sidebar-style-2" data-background-color="white">
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <div class="user">
                            <div class="info">
                                <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                                    <span>
                                        {{ Auth::guard('admin')->user()->name }}
                                        <span class="user-level">{{ Auth::guard('admin')->user()->name }}</span>
                                    </span>

                                </a>
                            </div>
                        </div>

                        <ul class="nav nav-primary">
                            <li class="nav-item active">
                                <a href="{{route('admin.home')}}">
                                    <i class="fas fa-home"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.packages.create')}}">
                                    <i class="fas fa-cubes " aria-hidden="true"></i>
                                    <p>Create A new Package</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('admin.packages.index')}}">
                                    <i class="fas fa-cubes " aria-hidden="true"></i>
                                    <p>Edit Package</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{route('admin.packages.show.index')}}">
                                    <i class="fas fa-cubes " aria-hidden="true"></i>
                                    <p>Show Package</p>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{route('admin.change-password')}}">
                                    <i class="fas fa-cubes " aria-hidden="true"></i>
                                    <p>Change Password</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{route('logout')}}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <p>Logout</p>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>






                        </ul>
                    </div>
                </div>
            </div>