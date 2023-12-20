@extends('layouts.main', $jobs)

@section('content')
    <div class="title-list-dworker">
        <h2 class="text-dark">Chi tiết công việc</h2>
    </div>

    <div class="row mt-3">
        <div class="col-3">
            <img src="{{ asset('storage/images/job-images/' . $job->avatar) }}" id="preview-image-before-upload" style="width: 180px;" class="mb-2">
        </div>
        <div class="col-6">
            <p class="text-dark" style="font-size: 25px;">{{ $job->name }}</p>
            <p class="text-dark">Note: {{ $job->note }} </p>
        </div>
    </div>
    <div class="row mt-3">
        <h2 class="text-dark">Chọn người thực hiện</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="width:10%;">Avatar</th>
                    <th scope="col" style="width:20%;">Tên</th>
                    <th scope="col">Hình thức thuê</th>
                    <th scope="col">Giá thuê</th>
                    <th scope="col" style="width:15%;">Nhập số lần thuê</th>
                    <th scope="col" style="width:20%;">Ghi chú công việc</th>
                    <th scope="col" style="width:10%; text-align: center;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php $customers = []; @endphp --}}
                @foreach ($job->errand_workers as $key => $errand_worker)
                    <tr>
                        <td style="width:10%;" >
                            <img  src="{{ !empty($errand_worker->avatar) ? asset('storage/images/errand_worker-images/'.$errand_worker->avatar) :  asset('storage/images/customer-images/user_1.png')}} "  alt="" style="width: 100%;"/>
                        </td>
                        <td>{{ $errand_worker->name }}</td>
                        <td>@php  $job_rental = App\Models\JobRental::where('job_id', $job->id)->where('errand_worker_id', $errand_worker->id)->get(); @endphp
                            {{ $job_rental[0]->type_rental->name }}
                        </td>
                        <td class="table_cost"> {{ number_format($job_rental[0]->cost, 0) }} vnđ</td>
                        <td style="width:10%;"><input type="number" class="form-control" value="1" min="1"></td>
                        <td style="width:20%;" class="text-dark">{{ $job_rental[0]->note }}</td>
                        <td class="text-center">
                            <a href="" class="btn btn-success">Thuê</a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
    </div>


@endsection
@section('scripts')
@endsection
