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
    @if (!empty(session('msg')))
        <div class="text-center">
            <p class="text-success fs-5">{{ session('msg') }}</p>
        </div>
    @endif
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Trở lại</a>

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
            <div class="form-group">
                <div class="row">
                    <div class="col-6">
                        <label for="amount" >Số tiền nạp</label>
                        <input class="form-control" data-val="true" data-val-number="The field Amount must be a number." data-val-required="The Amount field is required." id="amount" max="100000000" min="1" name="amount" type="number" value="10000" />
                        <i class="text-dark">(VNĐ)</i>
                        @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
             <h4 class="text-dark mt-4">Chọn phương thức thanh toán</h4>
            <div class="form-group mt-3">
               <input type="radio" id="bankCode" name="bankCode" value="VNPAYQR">
               <label for="bankCode">Thanh toán bằng ứng dụng hỗ trợ VNPAYQR</label><br>

               <input type="radio" id="bankCode" name="bankCode" value="VNBANK">
               <label for="bankCode">Thanh toán qua thẻ ATM/Tài khoản nội địa</label><br>

               <input type="radio" id="bankCode" name="bankCode" value="INTCARD">
               <label for="bankCode">Thanh toán qua thẻ quốc tế</label><br>
            </div>
            <button type="submit" class="btn btn-primary mt-3" href = "#">Thanh toán</button>
        </form>
    </div>

</div>


@endsection
@section('scripts')
@endsection
