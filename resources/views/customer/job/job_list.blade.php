@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->get())

@section('content')
    <div class="title-list-dworker">
        <h2 class="text-dark">Danh sách công việc</h2>
    </div>

    <form action="" class="d-flex mt-3">
        <input type="text" class="form-control" name="s"
            value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Nhập tên công việc">
        <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
        <a href="{{ request()->fullUrlWithQuery(['s' => '']) }}" class="btn btn-danger "><i
                class="fa-solid fa-trash"></i></a>
    </form>

    <div class="row mt-4">
        @foreach ($jobs as $job)
            <div class="col-sm-6 col-md-6 col-lg-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex">
                        <img src="{{ asset('storage/images/job-images/'. $job->avatar) }}" alt="" class="img-fluid rounded-start" style="width: 100px; height: 100px;">
                        <div class="mx-3">
                            <h5 class="card-title text-dark">{{ $job->name }}</h5>
                            {{-- <p class="card-text text-dark">{{ $job->note }}</p> --}}
                            <p class="card-text text-dark">Số người nhận việc: {{ $job->errand_workers->count() }}</p>
                            <a href="{{ route('job-detail', $job->id) }}" class="btn btn-primary">Xem chi tiết</a>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach

    </div>


@endsection
