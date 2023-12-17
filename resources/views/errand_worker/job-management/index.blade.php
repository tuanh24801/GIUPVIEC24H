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
        <h1>Quản lý công việc</h1>
        @if (!empty(session('msg')))
            <div class="text-center">
                <p class="text-success fs-5">{{ session('msg') }}</p>
            </div>
        @endif
        <form action="" class="d-flex">
            <input type="text" class="form-control" name="s"
                value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Nhập tên công việc">
            <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="{{ request()->fullUrlWithQuery(['s' => '']) }}" class="btn btn-danger "><i
                    class="fa-solid fa-trash"></i></a>
        </form>

        <div class="row">

            @foreach ($jobs as $job)
                <div class="col-sm-6 col-md-6 col-lg-3 mb-3">
                    <div class="card">
                        <div class="card-body d-flex">
                            <img src="{{ asset('storage/images/job-images/'. $job->avatar) }}" alt="" class="img-fluid rounded-start" style="width: 100px; height: 100px;">
                            <div class="mx-3">
                                <h5 class="card-title text-dark">{{ $job->name }}</h5>
                                {{-- <p class="card-text text-dark">{{ $job->note }}</p> --}}
                                <p class="card-text text-dark">Số người nhận việc: 10</p>
                                <a href="{{ route('errand_worker.job.detail', $job->id) }}" class="btn btn-primary">Xem chi tiết</a>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
            {{ $jobs->links() }}
        </div>
    </div>
@endsection
