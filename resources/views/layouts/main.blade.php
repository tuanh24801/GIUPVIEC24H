<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang chủ</title>
    <script src="https://kit.fontawesome.com/9e3f7a47c1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="top-head d-flex">
                <a href="{{ route('errand_worker.login') }}" class="text-white">Đăng ký làm việc | Hotline: 1900.8888</a>
                <a href="" class="btn btn-position-top text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M12 6C11.2583 6 10.5333 6.21993 9.91661 6.63199C9.29993 7.04404 8.81928 7.62971 8.53545 8.31494C8.25162 9.00016 8.17736 9.75416 8.32205 10.4816C8.46675 11.209 8.8239 11.8772 9.34835 12.4017C9.8728 12.9261 10.541 13.2833 11.2684 13.4279C11.9958 13.5726 12.7498 13.4984 13.4351 13.2145C14.1203 12.9307 14.706 12.4501 15.118 11.8334C15.5301 11.2167 15.75 10.4917 15.75 9.75C15.75 8.75544 15.3549 7.80161 14.6517 7.09835C13.9484 6.39509 12.9946 6 12 6ZM12 12C11.555 12 11.12 11.868 10.75 11.6208C10.38 11.3736 10.0916 11.0222 9.92127 10.611C9.75097 10.1999 9.70642 9.7475 9.79323 9.31105C9.88005 8.87459 10.0943 8.47368 10.409 8.15901C10.7237 7.84434 11.1246 7.63005 11.561 7.54323C11.9975 7.45642 12.4499 7.50097 12.861 7.67127C13.2722 7.84157 13.6236 8.12996 13.8708 8.49997C14.118 8.86998 14.25 9.30499 14.25 9.75C14.25 10.3467 14.0129 10.919 13.591 11.341C13.169 11.7629 12.5967 12 12 12ZM12 1.5C9.81273 1.50248 7.71575 2.37247 6.16911 3.91911C4.62247 5.46575 3.75248 7.56273 3.75 9.75C3.75 12.6938 5.11031 15.8138 7.6875 18.7734C8.84552 20.1108 10.1489 21.3151 11.5734 22.3641C11.6995 22.4524 11.8498 22.4998 12.0037 22.4998C12.1577 22.4998 12.308 22.4524 12.4341 22.3641C13.856 21.3147 15.1568 20.1104 16.3125 18.7734C18.8859 15.8138 20.25 12.6938 20.25 9.75C20.2475 7.56273 19.3775 5.46575 17.8309 3.91911C16.2843 2.37247 14.1873 1.50248 12 1.5ZM12 20.8125C10.4503 19.5938 5.25 15.1172 5.25 9.75C5.25 7.95979 5.96116 6.2429 7.22703 4.97703C8.4929 3.71116 10.2098 3 12 3C13.7902 3 15.5071 3.71116 16.773 4.97703C18.0388 6.2429 18.75 7.95979 18.75 9.75C18.75 15.1153 13.5497 19.5938 12 20.8125Z"
                            fill="white" />
                    </svg>
                    Nam Từ Liêm, Hà Nội
                </a>
            </div>
            <div class="bot-head mt-3">
                <div class="bot-head-content">
                    <div class="bot-head-logo">
                        <a href="{{ route('home') }}" class="text-white">
                            <img src="{{ asset('images/logo_viecvat.png') }}" alt="">
                        </a>
                    </div>
                    <div class="bot-head-search" style="margin:auto;">
                        <input type="text" class="form-control bot-head-search-form" placeholder="Từ khóa tìm kiếm tên hoặc công việc ... "
                            style="border-radius: 40px;">
                    </div>
                    <div class="bot-head-login">
                        @guest('customer')
                            <a href="{{ route('customer.login') }}" class="text-white me-3">Đăng nhập</a>
                            <a href="{{ route('customer.register') }}" class="text-white">Đăng ký</a>
                        @else
                            <div class="btn-group">
                                <button class="btn btn-sm" type="button">
                                    <ul style="list-style-type: none; margin-bottom: 0; margin-left: 0; text-align: right;" class="p-1">
                                        <li>
                                            <b>{{ Auth::guard('customer')->user()->name }}</b>
                                        </li>
                                        <li>
                                            <b style="float: 0;">(test)1.000vnđ</b>
                                        </li>
                                    </ul>

                                </button>
                                <button type="button"
                                    class="btn btn-lg dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false" style="border: 0px;">
                                    <span class="visually-hidden">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('customer.profile') }}"><b class="text-dark">Cá nhân</b></a></li>
                                    <li><a class="dropdown-item" href="{{ route('customer.logout') }}"><b class="text-dark">Đăng xuất</b></a></li>
                                </ul>
                            </div>
                        @endguest
                    </div>
                </div>
                <div class="bot-head-tag">
                    <a href="" class="text-white"><b>
                            <h3>Tìm ảnh custom xong giao diện trang chủ</h3>
                        </b></a>
                    <!-- <a href="" class="text-white">Giúp việc2</a>
                    <a href="" class="text-white">Giúp việc3</a>
                    <a href="" class="text-white">Giúp việc3</a>
                    <a href="" class="text-white">Giúp việc4</a>
                    <a href="" class="text-white">Giúp việc4</a> -->
                </div>
            </div>
        </div>
    </div>
    <div class="content container">
        <div class="side-bar">
            <b class="side-bar-title">Danh mục việc vặt nổi bật</b>
            <ul class="side-bar-list-job">
                <li class="btn-item-list-job btn-item-list-job-new"><a class="btn-job" href="">Đề xuất công
                        việc </a>
                </li>
                @foreach ($jobs as $job)
                    <li class="btn-item-list-job"><a class="btn-job" href="">{{ $job->name }}</a></li>
                @endforeach
                <li class="btn-item-list-job btn-item-list-seemore"><a class="btn-job" href="{{ route('job-list') }}">Xem thêm</a></li>

                <li class="mt-5 btn-item-list-job btn-item-list-history input_money">
                    <a class="btn-job-history" href="#">Nạp tiền</a>
                </li>
                <li class="btn-item-list-job btn-item-list-history"><a class="btn-job-history" href="{{ route('job-list') }}">Lịch sử thuê</a></li>
                <li class="btn-item-list-job btn-item-list-history"><a class="btn-job-history" href="{{ route('job-list') }}">Đang thực hiện: 1</a></li>
                <li class="btn-item-list-job btn-item-list-history"><a class="btn-job-history" href="{{ route('job-list') }}">Đang chờ: 1</a></li>
            </ul>
        </div>
        <div class="main-content">
            {{-- <div class="main-cover">
                <img src="{{ asset('images/cover_main.png') }}" class="main-cover-img" alt="">
            </div> --}}
            <div class="main-list-dworker-work" style="margin-top: -25px; margin-bottom: 100px;">

                @yield('content')

            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    @yield('scripts')

</body>

</html>
