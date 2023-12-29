@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->offset(0)->limit(3)->get())
<style>
label{
    font-weight: 700;
    color: black;
    font-size: 15px;
}
</style>
@section('content')
<div class="text-dark" style="margin-bottom: 100px;">
    <h3 class="mt-3">Nạp tiền cá nhân</h3>
    @if (!empty($msg))
        <div class="text-center">
            <p class="text-success fs-5">{{ $msg }}</p>
        </div>
    @endif
    <div class="table-responsive p-4">
        <form action="{{ route('customer.create_payment') }}" id="frmCreateOrder" method="post">
            @csrf
            @method('POST')
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label  class="form-label">Ảnh đại diện</label><br>
                        <img src="{{ asset('storage/images/customer-images/'.Auth::guard('customer')->user()->avatar)  }}" id="preview-image-before-upload" style="width: 180px;" class="mb-2">
                        @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label  class="form-label">Tên người dùng</label>
                        <input type="text" class="form-control "  value="{{ Auth::guard('customer')->user()->name }}" disabled>

                    </div>
                    <div class="col-6">
                        <label  class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control"  value="{{  Auth::guard('customer')->user()->address }}" disabled>
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label  class="form-label">Điện thoại</label>
                        <input type="text" class="form-control" value="{{ Auth::guard('customer')->user()->phone }}" disabled>
                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-6">
                        <label  class="form-label">Số dư </label>
                        <input type="text" class="form-control" value="{{ number_format(Auth::guard('customer')->user()->account_balance, 0) }} " disabled>
                        <i class="text-dark">VNĐ</i>
                    </div>
                </div>
            </div>

            <a href="{{ route('customer.pay') }}" class="btn btn-primary">Tiếp tục nạp tiền</a>
        </form>
    </div>

</div>


@endsection
@section('scripts')
@endsection
