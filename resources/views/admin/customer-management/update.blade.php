@extends('layouts.admin.main')
@section('content')
    <style>
        label{
            font-weight: 700;
            color: black;
            font-size: 15px;
        }
    </style>
    <h1 class="text-dark">Cập nhật thông tin khách hàng</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary"><b>Quay lại</b></a>
    </div>
    @if (!empty(session('msg')))
        <div class="text-center">
            <p class="text-success fs-5">{{ session('msg') }}</p>
        </div>
    @endif


    <div class="container pt-4" style="margin-bottom: 100px;">

        <form action="{{ route('admin.customer.update', ['customer_id' => $customer->id]) }}" method="post" enctype="multipart/form-data" class="w-90" style="width: 70%;margin: auto;">
            @csrf
            @method('POST')
            <h3 class="text-dark">Thông tin khách hàng</h3>
            <div class="mb-3">
                <label  class="form-label">Tên khách hàng</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $customer->name }}">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label  class="form-label">Địa chỉ</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $customer->address }}">
                {{-- <input type="text" class="form-control" id="autocomplete"> --}}
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label">Điện thoại</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $customer->phone }}">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label  class="form-label">Ngày tạo</label>
                        <input type="datetime" class="form-control" value="{{ $customer->created_at->format('d-m-Y H:i:s') }}" disabled>
                    </div>
                    <div class="col-6">
                        <label  class="form-label">Ngày cập nhật</label>
                        <input type="datetime" class="form-control" value="{{ $customer->updated_at->format('d-m-Y H:i:s') }}" disabled>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label  class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="image">
                <img src="{{ asset('storage/images/customer-images/'.$customer->avatar)  }}" id="preview-image-before-upload" style="width: 180px;" class="mt-2">
                @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <h3 class="text-dark">Thông tin đăng nhập</h3>
            <div class="mb-3" >
                <a href="#" onclick="event.preventDefault()"  class="btn-login-info-customer">Cập nhật thông tin đăng nhập</a>
                <a href="#" onclick="event.preventDefault()"  class="btn-login-info-customer-cancle" style="display:none;">Hủy</a>
            </div>
            @if($errors->any())
                <div class="mb-3 login-info-customer-errors">
                    <label  class="form-label">Email</label>
                    <input type="email" class="form-control login-info-customer-errors @error('email') is-invalid @enderror" name="email" value="{{ $customer->email }}" disabled>
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 login-info-customer-errors">
                    <label class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control login-info-customer-errors-password @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" >
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 login-info-customer-errors">
                    <label class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" class="form-control login-info-customer-errors-cpassword @error('cpassword') is-invalid @enderror" name="cpassword" >
                    @error('cpassword') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            @endif
            <div class="mb-3 login-info-customer" style="display:none;">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control login-info-customer @error('email') is-invalid @enderror" name="email" value="{{ $customer->email }}" disabled>
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 login-info-customer" style="display:none;">
                <label class="form-label">Mật khẩu</label>
                <input type="password" class="form-control login-info-customer-password @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" disabled>
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3 login-info-customer" style="display:none;">
                <label class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control login-info-customer-cpassword @error('cpassword') is-invalid @enderror" name="cpassword" disabled>
                @error('cpassword') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('#image').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('.btn-login-info-customer').click(function(){
                $('.login-info-customer').css("display", "block");
                $('.btn-login-info-customer-cancle').css("display", "block");
                $('.btn-login-info-customer').css("display", "none");
                $('.login-info-customer-password').prop('disabled', false);
                $('.login-info-customer-cpassword').prop('disabled', false);
                $('.login-info-customer-errors').css("display", "none");
                $('.login-info-customer-errors-password').prop('disabled', true);
                $('.login-info-customer-errors-cpassword').prop('disabled', true);
            });
            $('.btn-login-info-customer-cancle').click(function(){
                $('.login-info-customer').css("display", "none");
                $('.btn-login-info-customer-cancle').css("display", "none");
                $('.btn-login-info-customer').css("display", "block");
                $('.login-info-customer-password').prop('disabled', true);
                $('.login-info-customer-cpassword').prop('disabled', true);
            });
        });

    </script>
@endsection
