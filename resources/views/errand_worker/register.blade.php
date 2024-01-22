<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Errand Worker Registration</title>
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <style>
        body{
            font-family: 'Roboto', sans-serif;

        }
    </style>
</head>

<body>
    <div class="container">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-8">
                        <div class="login-wrap p-4 p-md-5">
                            <h4 class="text-center mb-4">Người nhận việc đăng ký</h4>
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif
                            @if (Session::has('error'))
                                <div class="alert alert-danger">{{ Session::get('error') }}</div>
                            @endif
                            <form action="{{ route('errand_worker.register') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" class="form-control" name="name" id=""
                                        placeholder="Nhập họ và tên ..." value="{{ old('name') }}" />
                                    <span class="text-danger">
                                        @error('name')
                                            {{ $errors->first('name') }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" id=""
                                        placeholder="Nhập email ..." value="{{ old('email') }}" />
                                    <span class="text-danger">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Địa chỉ</label>
                                    <input type="text" class="form-control" name="address" id=""
                                        placeholder="Địa chỉ ..." value="{{ old('email') }}" />
                                    <span class="text-danger">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Số điện thoại</label>
                                    <input type="number" class="form-control" name="phone" id=""
                                        placeholder="Nhập số điện thoại ..." value="{{ old('phone') }}" />
                                    <span class="text-danger">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="email">Số căn cước công dân</label>
                                    <input type="number" class="form-control" name="identification" id=""
                                        placeholder="Nhập số căn cước công dân ..."
                                        value="{{ old('identification') }}" />
                                    <span class="text-danger">
                                        @error('identification')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="password">Mật khẩu</label>
                                    <input type="password" class="form-control" name="password" id=""
                                        placeholder="Nhập mật khẩu ..." value="{{ old('password') }}" />
                                    <span class="text-danger">
                                        @error('password')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <label for="cpassword">Xác nhận mật khẩu</label>
                                    <input type="password" class="form-control" name="cpassword" id=""
                                        placeholder="Xác nhận mật khẩu..." value="{{ old('cpassword') }}" />
                                    <span class="text-danger">
                                        @error('cpassword')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <button type="submit" class="btn btn-primary">Đăng ký</button>
                                <p class="mt-3">
                                    Bạn đã có tài khoản <a href="{{ route('errand_worker.login') }}">Đăng nhập</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
