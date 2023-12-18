@extends('layouts.errand_worker.main')
<style>
    label {
        font-weight: 700;
        color: black;
        font-size: 15px;
    }

    option,
    select {
        font-weight: 700;
        color: black;
        font-size: 13px;
    }
</style>
@section('content')
    <div class="container pt-4 text-dark" style="margin-bottom: 100px;">
        <h1>Chi tiết công việc</h1>
        @if (!empty(session('msg')))
            <div class="text-center">
                <p class="text-success fs-5">{{ session('msg') }}</p>
            </div>
        @endif

        <a href="{{ route('errand_worker.job.index') }}" class="btn btn-secondary">Quay lại</a>

        <form action="{{ route('errand_worker.job.accept_job', $job->id) }}" method="post" enctype="multipart/form-data" class="w-90 p-4" style="width: 70%;margin: auto;">
            @csrf
            @method('POST')
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <img src="{{ asset('storage/images/job-images/' . $job->avatar) }}" id="preview-image-before-upload"
                            style="width: 180px;" class="mb-2">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">
                    <h3>{{ $job->name }}</h3>
                </label>
            </div>
            <div class="mb-3 text-dark">
                Note: {{ $job->note }}
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Chọn hình thức nhận thuê</label>
                        <select class="form-select @error('type_rental_id') is-invalid @enderror" aria-label="Default select example" name="type_rental_id">
                            {{-- <option selected>Hình thức thuê</option> --}}
                            @foreach ($typeRentals as $typeRental)
                                <option value="{{ $typeRental->id }}">{{ $typeRental->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-sm btn-primary mt-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Thêm hình thức mới
                        </button><br>
                        @error('type_rental_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="col-6">
                        <label class="form-label">Giá thuê</label>
                        <input type="number" name="cost" id="" class="form-control @error('cost') is-invalid @enderror">
                        <div id="emailHelp" class="form-text"><i class="text-dark">VNĐ</i></div>
                        @error('cost') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <label class="form-label">Ghi chú của bạn</label>
                    <div class="form-floating">
                        <textarea class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        {{-- <label for="floatingTextarea2">Comments</label> --}}
                      </div>
                      @error('note') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Số người đã nhận: 1.122</label><br>
                        <label class="form-label">Số lần hoàn thành: 1.122</label>
                    </div>
                    {{-- <div class="col-6">
                        <label class="form-label">Giá thuê trung bình: 1.121</label>
                    </div> --}}
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Nhận việc</button>
        </form>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">Thêm hình thức mới</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('errand_worker.job.create_type_rental') }}" method="post">
                        @csrf
                        @method("POST")
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="" class="form-label">Tên hình thức</label>
                                <input type="text" class="form-control" name = "name">
                                <div class="form-text"><i class="text-dark">VD: Theo doanh số, theo số lượng,...</i></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
