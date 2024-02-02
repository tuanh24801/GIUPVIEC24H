@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->orderBy('id','desc')->offset(0)->limit(5)->get())
<style>
label{
    font-weight: 700;
    color: black;
    font-size: 15px;
}
</style>
@section('content')
<div class="text-dark" style="margin-bottom: 100px;">
    <h3 class="mt-3">Lịch sử nạp tiền</h3>
    @if (!empty(session('msg')))
        <div class="text-center">
            <p class="text-success fs-5">{{ session('msg') }}</p>
        </div>
    @endif
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Trở lại</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Hình thức nạp</th>
                <th scope="col">Ngân hàng</th>
                <th scope="col">Số tiền</th>
                <th scope="col">Trạng thái</th>
                {{-- <th scope="col" style="width:10%; text-align: center;">Lịch sử thuê</th>
                <th scope="col" style="width:10%; text-align: center;">Chỉnh sửa</th>
                <th scope="col" style="width:10%; text-align: center;">Khóa tài khoản</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($customer->payments as $payment)
                <tr>
                    <th scope="row">{{ $payment->id }}</th>
                    <td>{{ $payment->card_type }}</td>
                    <td>{{ $payment->bank_code }}</td>
                    <td> {{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($payment->amount) }}</td>
                    <td>
                        <a href="" class="btn {{ $payment->status == 1 ? 'btn-success' : 'btn-secondary'}}">{{ $payment->status == 1 ? 'Thành công' : 'Thất bại'}}</a>
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>


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
