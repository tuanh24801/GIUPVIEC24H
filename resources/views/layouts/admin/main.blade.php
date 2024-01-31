<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản trị admin</title>
    <script src="https://kit.fontawesome.com/9e3f7a47c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyChNNTJnl-Yy-ipzVszlROovhy9mPX9CEc&callback=initAutocomplete&libraries=places" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .pac-matched{
                color: black !important;
            }
            .pac-item-query{
                color: black !important;
            }
            .pac-item{
                background-color: #cdcfcf !important;
            }
            .pac-item:hover {
                background-color: #dde0e0 !important;
            }
        </style>
</head>

<body>
    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse">
            <div class="position-sticky">
                <div class="list-group list-group-flush list-option-dworker p-3">
                    <a href="{{ route('admin.dashboard') }}" class="text-dark item-list-dworker p-3" aria-current="true">
                        <i class="fa-solid fa-user fa-fw me-3" style="color: rgb(156, 156, 156);"></i><span
                            class="text-dark text-item-list-dworker">Tổng quát</span>
                    </a>
                    <a href="{{ route('admin.customer.index') }}" class="text-dark item-list-dworker p-3 mt-3" aria-current="true">
                        <i class="fa-solid fa-user fa-fw me-3" style="color: rgb(156, 156, 156);"></i><span
                            class="text-dark text-item-list-dworker">Quản lý khách hàng</span>
                    </a>
                    <a href="{{ route('admin.errand_worker.index') }}" class="text-dark item-list-dworker p-3 mt-3" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3" style="color: rgb(156, 156, 156);"></i><span
                            class="text-dark text-item-list-dworker">Quản lý người nhận việc</span>
                    </a>
                    <a href="{{ route('admin.job.index') }}" class="text-dark item-list-dworker p-3 mt-3" aria-current="true">
                        <i class="fa-solid fa-bell fa-fw me-3" style="color: rgb(156, 156, 156);"></i><span
                            class="text-dark text-item-list-dworker">Quản lý việc làm</span>
                        <span class="badge rounded-pill badge-notification bg-danger fs-5" style="float: right;">
                            {{ DB::table('jobs')->where('status', 0)->get()->count(); }}
                        </span>
                    </a>
                    <a href="#" class="text-dark item-list-dworker p-3 mt-3" aria-current="true">
                        <i class="fa-solid fa-money-bill-1 fa-fw me-3" style="color: rgb(156, 156, 156);"></i><span
                            class="text-dark text-item-list-dworker">Quản lý thuê</span>
                    </a>
                    <a href="{{ route('admin.payment.index') }}" class="text-dark item-list-dworker p-3 mt-3" aria-current="true">
                        <i class="fa-solid fa-money-bill-1 fa-fw me-3" style="color: rgb(156, 156, 156);"></i><span
                            class="text-dark text-item-list-dworker">Quản lý nạp tiền</span>
                    </a>
                    <a href="{{ route('admin.logout') }}" class="text-dark item-list-dworker p-3 mt-3" aria-current="true">
                        <i class="fa-solid fa-power-off fa-fw me-2" style="color: red;"></i>
                        <span class="text-dark text-item-list-dworker">Đăng xuất</span>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light fixed-top top-menu-main-navbar">
            <!-- Container wrapper -->
            <div class="container-fluid dropdown">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand mx-4" href="#">
                    <p class="">
                        <img src="{{ asset('./images/logo_viecvat.png') }}" height="45" alt="" /><br>
                    </p>
                </a>

                <a href="" class="fs-5 text-white fw-bold">
                    Trang quản trị
                </a>

                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
                    <!-- Avatar -->
                    <li class="nav-item dropdown me-4 d-flex align-item-center mx-3">
                        <a class="nav-link d-flex align-items-center " type="button"
                            id="dropdownMenuButton1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <ul class="me-3 info-name-cash-dworker">
                                <li class="info-name-dworker">
                                    <b>{{ Auth::guard('admin')->user()->name }}</b>
                                </li>
                            </ul>
                            <img src="{{ asset('https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg') }}"
                                class="rounded-circle " height="55" alt="" loading="lazy" />
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 120px;">
        <div class="container">
            @yield('content')
        </div>
    </main>
    <!--Main layout-->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    {{-- <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBRGTgg0Q16ZQ3m0_sGrxtecmOhVOdIJTY&libraries=places">
    </script> --}}
    @yield('scripts')

</body>
</html>
