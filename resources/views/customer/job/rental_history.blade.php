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
    <h3 class="mt-3">Lịch sử thuê</h3>
    @if (!empty(session('msg')))
        <div class="text-center">
            <p class="text-success fs-5">{{ session('msg') }}</p>
        </div>
    @endif
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-secondary">Trở lại</a>
    <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true"><b class="text-dark">Đang chờ ({{ $customer->rentalHistories->where('errand_worker_status','Đang chờ')->count(); }})</b></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false"><b class="text-dark">Đang thực hiện ({{ $customer->rentalHistories->where('errand_worker_status','Đang thực hiện')->count(); }})</b></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false"><b class="text-danger">Từ chối ({{ $customer->rentalHistories->where('errand_worker_status','Từ chối')->count(); }})</b></button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane" type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false"><b class="text-success">Hoàn thành ({{ $customer->rentalHistories->where('errand_worker_status','Hoàn thành')->count(); }})</b></button>
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
                        <th scope="col">Người thực hiện</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái NTH</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rentalHistories_1 =  $customer->rentalHistories->where('errand_worker_status','Đang chờ'); @endphp
                    @foreach ($rentalHistories_1  as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->job_rental->errand_workers->name }}</td>
                                <td>{{ $rentalHistory->total }}</td>
                                <td>{{ $rentalHistory->errand_worker_status == '' ? 'Đang chờ' : $rentalHistory->errand_worker_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>

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
                        <th scope="col">Người thực hiện</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái NTH</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rentalHistories_2 =  $customer->rentalHistories->where('errand_worker_status','Đang thực hiện'); @endphp
                    @foreach ($rentalHistories_2 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->job_rental->errand_workers->name }}</td>
                                <td>{{ $rentalHistory->total }}</td>
                                <td>{{ $rentalHistory->errand_worker_status == '' ? 'Đang chờ' : $rentalHistory->errand_worker_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>

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
                        <th scope="col">Người thực hiện</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái NTH</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rentalHistories_3 =  $customer->rentalHistories->where('errand_worker_status','Từ chối'); @endphp
                    @foreach ($rentalHistories_3 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->job_rental->errand_workers->name }}</td>
                                <td>{{ $rentalHistory->total }}</td>
                                <td>{{ $rentalHistory->errand_worker_status == '' ? 'Đang chờ' : $rentalHistory->errand_worker_status }}</td>
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
                        <th scope="col">Người thực hiện</th>
                        <th scope="col">Số tiền</th>
                        <th scope="col">Trạng thái NTH</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian cập nhật</th>
                        <th scope="col">Xác nhận Hoàn thành</th>
                    </tr>
                </thead>
                <tbody>
                    @php $rentalHistories_4 =  $customer->rentalHistories->where('errand_worker_status','Hoàn thành'); @endphp
                    @foreach ($rentalHistories_4 as $rentalHistory)
                            <tr>
                                <th scope="row">{{ $rentalHistory->id }}</th>
                                <td>{{ $rentalHistory->job_rental->jobs->name }}</td>
                                <td>{{ $rentalHistory->job_rental->errand_workers->name }}</td>
                                <td>{{ $rentalHistory->total }}</td>
                                <td>{{ $rentalHistory->errand_worker_status == '' ? 'Đang chờ' : $rentalHistory->errand_worker_status }}</td>
                                <td> <a href="">xem</a></td>
                                <td>{{ $rentalHistory->created_at }}</td>
                                <td>{{ $rentalHistory->updated_at }}</td>
                                <td>
                                    <a href="" class="">Xác nhận | Đã xác nhận</a>
                                </td>

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
