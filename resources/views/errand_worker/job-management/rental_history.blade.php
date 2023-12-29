@extends('layouts.errand_worker.main')
<style>
label{
    font-weight: 700;
    color: black;
    font-size: 15px;
}
</style>
@section('content')
<div class="text-dark container" style="margin-bottom: 100px;">
    <h3 class="mt-3">Lịch sử thuê người làm việc</h3>
    @if (!empty(session('msg')))
        <div class="text-center">
            <p class="text-success fs-5">{{ session('msg') }}</p>
        </div>
    @endif
    {{-- <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Trở lại</a> --}}
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><b class="text-dark">Đang chờ ({{ $errand_worker->rental_histories->where('customer_status','Đang chờ')->count(); }})</b></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><b class="text-dark">Đang thực hiện ({{ $errand_worker->rental_histories->where('errand_worker_status','Đang thực hiện')->count(); }})</b></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><b class="text-danger">Từ chối ({{ $errand_worker->rental_histories->where('errand_worker_status', '=' ,'KH Đã hủy')->count() + $errand_worker->rental_histories->where('errand_worker_status', '=' ,'NTH Đã hủy')->count(); }})</b></button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false"><b class="text-success">Hoàn thành ({{ $errand_worker->rental_histories->where('errand_worker_status','Hoàn thành')->count(); }})</b></button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        {{-- TAB ĐANG CHỜ --}}
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Công việc</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái khách hàng</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                        <th scope="col">Nhận việc</th>
                        <th scope="col">Hủy việc</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @php $rentalHistories_1 =  $customer->rentalHistories->where('errand_worker_status','Đang chờ'); @endphp --}}
                    @php
                        $rentalHistories_1 =  $errand_worker->rental_histories->where('customer_status','Đang chờ');
                        $rentalHistories_1 = !empty($rentalHistories_1) ? $rentalHistories_1 : [];
                    @endphp
                    @foreach ($rentalHistories_1  as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->customer->name }}</td>
                                <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($rentalHistory->total) }}</td>
                                <td>{{ $rentalHistory->customer_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>
                                <td>
                                    <a href="{{ route('errand_worker.job.status_job', ['rental_history_id' => $rentalHistory->id, 'e_status' => 'Đang thực hiện', 'c_status' => 'Đang chờ thực hiện']) }}">Nhận việc</a>
                                </td>
                                <td>

                                    <a href="{{ route('errand_worker.job.status_job', ['rental_history_id' => $rentalHistory->id, 'e_status' => 'NTH Đã hủy', 'c_status' => 'NTH Đã hủy']) }}">Hủy</a>
                                </td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- TAB ĐANG THỰC HIỆN--}}
        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Công việc</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái Khách hàng</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                        <th scope="col">Hoàn thành</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $rentalHistories_2 =  $errand_worker->rental_histories->where('errand_worker_status','Đang thực hiện');
                        $rentalHistories_2 = !empty($rentalHistories_2) ? $rentalHistories_2 : [];
                    @endphp
                    @foreach ($rentalHistories_2 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->customer->name }}</td>
                                <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($rentalHistory->total) }}</td>
                                <td>{{ $rentalHistory->customer_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>
                                <td>
                                    <a href="{{ route('errand_worker.job.status_job', ['rental_history_id' => $rentalHistory->id, 'e_status' => 'Hoàn thành', 'c_status' => 'Chưa xác nhận']) }}">Xác nhận</a>
                                </td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- TAB ĐANG TỪ CHỐI--}}
        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
            <table class="table mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Công việc</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái Khách hàng</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @php $rentalHistories_3 =  $customer->rentalHistories->where('errand_worker_status','Từ chối'); @endphp --}}
                    @php
                        $rentalHistories_3 =  $errand_worker->rental_histories->where('customer_status', 'LIKE' ,'NTH Đã hủy');
                        // dd($rentalHistories_3);
                        $rentalHistories_3 = !empty($rentalHistories_3) ? $rentalHistories_3 : [];
                    @endphp
                    @foreach ($rentalHistories_3 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->customer->name }}</td>
                                <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($rentalHistory->total) }}</td>
                                <td>{{ $rentalHistory->customer_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>

                            </tr>
                    @endforeach

                    @php
                        $rentalHistories_3 =  $errand_worker->rental_histories->where('customer_status', 'LIKE', 'KH Đã hủy');
                        // dd($rentalHistories_3);
                        $rentalHistories_3 = !empty($rentalHistories_3) ? $rentalHistories_3 : [];
                    @endphp
                    @foreach ($rentalHistories_3 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->customer->name }}</td>
                                <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($rentalHistory->total) }}</td>
                                <td>{{ $rentalHistory->customer_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- TAB HOÀN THÀNH--}}
        <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
            <table class="table table-lg mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Công việc</th>
                        <th scope="col">Khách hàng</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái Khách hàng</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @php $rentalHistories_4 =  $customer->rentalHistories->where('errand_worker_status','Hoàn thành'); @endphp --}}
                    @php
                        $rentalHistories_4 =  $errand_worker->rental_histories->where('errand_worker_status', 'like', 'Hoàn thành');
                        $rentalHistories_4 = !empty($rentalHistories_4) ? $rentalHistories_4 : [];
                    @endphp
                    @foreach ($rentalHistories_4 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->customer->name }}</td>
                                <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($rentalHistory->total) }}</td>
                                <td>{{ $rentalHistory->customer_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>

                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
