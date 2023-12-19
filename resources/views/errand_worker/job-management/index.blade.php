@extends('layouts.errand_worker.main')
<style>
    label {
        font-weight: 700;
        color: black;
        font-size: 15px;
    }
</style>
@section('content')
    <div class="container pt-4 text-dark" style="margin-bottom: 100px;">
        {{-- <h1>Quản lý công việc</h1> --}}
        @if (!empty(session('msg')))
            <div class="text-center">
                <p class="text-success fs-5">{{ session('msg') }}</p>
            </div>
        @endif
        <a href="{{ route('errand_worker.job.add') }}" class="btn btn-success">Đề xuất công việc</a>

        <form action="" class="d-flex mt-3">
            <input type="text" class="form-control" name="s"
                value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Nhập tên công việc">
            <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="{{ request()->fullUrlWithQuery(['s' => '']) }}" class="btn btn-danger "><i
                    class="fa-solid fa-trash"></i></a>
        </form>

        <div class="row ">
            @foreach ($jobs as $job)
                <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-body d-flex">
                            <img src="{{ asset('storage/images/job-images/'. $job->avatar) }}" alt="" class="img-fluid rounded-start" style="width: 100px; height: 100px;">
                            <div class="mx-3">
                                <h5 class="card-title text-dark">{{ $job->name }}</h5>
                                {{-- <p class="card-text text-dark">{{ $job->note }}</p> --}}
                                <p class="card-text text-dark">Số người nhận việc: 10</p>
                                @if (in_array($job->id,$array_id_jobs))
                                    <a href="#" class="btn btn-secondary">Đã nhận</a>
                                @else
                                    <a href="{{ route('errand_worker.job.detail', $job->id) }}" class="btn btn-primary">Xem chi tiết</a>
                                @endif
                                {{-- <a href="{{ route('errand_worker.job.detail', $job->id) }}" class="btn btn-primary">Xem chi tiết</a> --}}
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $jobs->links() }}
        </div>

        <h2 class="mt-3">Công việc đã nhận</h2>
        <div class="row">
            @foreach ($errand_worker->jobs as $job)
                <div class="col-sm-6 col-md-6 col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-body d-flex">
                            <img src="{{ asset('storage/images/job-images/'. $job->avatar) }}" alt="" class="img-fluid rounded-start" style="width: 100px; height: 100px;">
                            <div class="mx-3">
                                <h5 class="card-title text-dark">{{ $job->name }}</h5>
                                {{-- <p class="card-text text-dark">{{ $job->note }}</p> --}}
                                <p class="card-text text-dark">Số lần thực hiện: 10</p>
                                <p class="card-text text-dark">Hình thức thuê: 50.000/ngày</p>
                                <a href="" class="btn btn-sm {{ $job->status == 1 ? 'btn-success' : 'btn-secondary' }}">{{ $job->status == 1 ? 'Hoạt động' : 'Đã tạm dừng' }}</a><br><br>
                                <a href="#" class="btn btn-primary ">Tùy chỉnh</a>
                                <a href="#" class="btn btn-outline-danger ">Hủy việc</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            {{-- {{ $jobs->links() }} --}}
        </div>
    </div>
@endsection
