@extends('layouts.main', $jobs = App\Models\Job::where('status', 1)->offset(0)->limit(3)->get())

@section('content')
    <div class="title-list-dworker">
        <h2 class="text-dark">Danh sách người nhận việc</h2>
    </div>
    <!-- Dánh sach người chạy việc -->
    <div class="row mt-4">
        @foreach ($errand_workers as $errand_worker)
            <div class="col-sm-6 col-md-6 col-lg-6 mb-3">
                <div class="card">
                    <div class="card-body d-flex">
                        <img src="{{ asset('storage/images/errand_worker-images/'. $errand_worker->avatar) }}" alt="" class="img-fluid rounded-start" style="width: 100px; height: 100px;">
                        <div class="mx-3">
                            <h5 class="card-title text-dark">{{ $errand_worker->name }}</h5>
                            <p class="card-text text-dark">Số công việc đã làm: {{ $errand_worker->rental_histories->count() }}</p>
                            {{-- <p class="card-text text-dark">Số người nhận việc: {{ $job->errand_workers->count() }}</p> --}}
                            <a href="#" class="btn btn-primary">Xem chi tiết</a>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        {{ $errand_workers->links() }}

    </div>
    <!-- End Dánh sach người chạy việc -->

    <div class="title-list-dworker">
        <h2 class="text-dark">Danh sách công việc hiện có</h2>
    </div>
    <!-- Dánh sach công việchiện có -->
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
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            <a href="{{ route('job-list') }}" class="btn btn-primary mt-3" style="width: 100%;">Xem thêm</a>
        </div>
    </div>
    <!-- End Dánh sach người chạy việc -->

@endsection


