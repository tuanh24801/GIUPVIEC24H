@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->get())
<style>
label{
    font-weight: 700;
    color: black;
    font-size: 15px;
}
</style>
@section('content')
<div class="text-dark" style="margin-bottom: 100px;">
    <h3  class="mt-3">Thông tin cá nhân</h3>
    @if (!empty(session('msg')))
        <div class="text-center">
            <p class="text-success fs-5">{{ session('msg') }}</p>
        </div>
    @endif
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Trở lại</a>

    <div class="table-responsive p-4">
    <form action="{{ route('customer.update') }}" method="post" enctype="multipart/form-data" >
        @csrf
        @method('POST')
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label  class="form-label">Ảnh đại diện</label><br>
                    <img src="{{ asset('storage/images/customer-images/'.Auth::guard('customer')->user()->avatar)  }}" id="preview-image-before-upload" style="width: 180px;" class="mb-2">
                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="image">
                    @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label  class="form-label">Tên người dùng</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? Auth::guard('customer')->user()->name }}">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-6">
                    <label  class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? Auth::guard('customer')->user()->address }}">
                    @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label  class="form-label">Điện thoại</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? Auth::guard('customer')->user()->phone }}">
                    @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-6">
                    <label  class="form-label">Số dư </label>
                    <input type="text" class="form-control" value="{{ number_format(Auth::guard('customer')->user()->account_balance, 0) }} " disabled>
                    <i class="text-dark">VNĐ</i><br>
                    <a href="{{ route('customer.pay') }}" class="btn btn-primary">Nạp tiền</a>
                    <a href="{{ route('customer.payment_history') }}" class="btn btn-primary">Lịch sử nạp tiền</a>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label  class="form-label">Ngày tạo</label>
                    <input type="datetime" class="form-control" value="{{ Auth::guard('customer')->user()->created_at->format('d-m-Y H:i:s') }}" disabled>
                </div>
                <div class="col-6">
                    <label  class="form-label">Ngày cập nhật</label>
                    <input type="datetime" class="form-control" value="{{ Auth::guard('customer')->user()->created_at->format('d-m-Y H:i:s') }}" disabled>
                </div>
            </div>
        </div>

        <h3 class="text-dark">Thông tin đăng nhập</h3>
        <div class="mb-3" >
            <a href="#" onclick="event.preventDefault()"  class="btn-login-info-customer">Cập nhật thông tin đăng nhập</a>
            <a href="#" onclick="event.preventDefault()"  class="btn-login-info-customer-cancle" style="display:none;">Hủy</a>
        </div>
        @if($errors->has('password') || $errors->has('cpassword'))
            <div class="mb-3 login-info-customer-errors">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control login-info-customer-errors @error('email') is-invalid @enderror" name="email" value="{{ Auth::guard('customer')->user()->email }}" disabled>
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
        @elseif ($errors->has('email'))
            <div class="mb-3 login-info-customer-errors">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control login-info-customer-errors @error('email') is-invalid @enderror" name="email" value="{{ Auth::guard('customer')->user()->email }}" disabled>
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
            <input type="email" class="form-control login-info-customer @error('email') is-invalid @enderror" name="email" value="{{ Auth::guard('customer')->user()->email }}" disabled>
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
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
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
