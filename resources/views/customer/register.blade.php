<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Customer Registration</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2 class="mt-3">User registration</h2>
            <div class="col-md-5">
                @if (Session::has('success'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                @endif
                <form action="{{ route('customer.create') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Full name</label>
                        <input type="name" class="form-control" name="name" id="" placeholder="Enter full name ..." value="{{ old('name') }}"/>
                        <span class="text-danger">@error('name'){{ $errors->first('name') }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="email" >Email address</label>
                        <input type="email" class="form-control" name="email" id="" placeholder="Enter email ..." value="{{ old('email') }}"/>
                        <span class="text-danger">@error('email'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="password" >Password</label>
                        <input type="password" class="form-control" name="password" id="" placeholder="Enter password ..." value="{{ old('password') }}"/>
                        <span class="text-danger">@error('password'){{ $message }} @enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" >Confirm password</label>
                        <input type="password" class="form-control" name="cpassword" id="" placeholder="Confirm password ..." value="{{ old('cpassword') }}"/>
                        <span class="text-danger">@error('cpassword'){{ $message }} @enderror</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <p class="mt-3">
                        Already Registered <a href="{{ route('customer.login') }}">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>
</html>
