@extends('layouts.admin.main')
@section('content')
    <style>
        label {
            font-weight: 700;
            color: black;
            font-size: 15px;
        }
    </style>
    <h1 class="text-dark">Cập nhật công việc</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <a href="{{ route('admin.job.index') }}" class="btn btn-secondary"><b>Quay lại</b></a>
    </div>
    <div class="container pt-4">
        <form action="{{ route('admin.job.update', ['job_id' => $job->id]) }}" method="post" enctype="multipart/form-data" class="w-90"
            style="width: 70%;margin: auto;">
            @csrf
            @method('POST')
            <h3 class="text-dark">Thông tin công việc</h3>
            <div class="mb-3">
                <label class="form-label">Tên công việc</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') ?? $job->name }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">ghi chú</label>
                <input type="text" class="form-control @error('note') is-invalid @enderror" name="note"
                    value="{{ old('note') ?? $job->note }}">
                @error('note')
                    <span class="text-danger">{{ $message  }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label class="form-label">Ảnh</label>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                    id="image">
                <img src="{{ asset('storage/images/job-images/'.$job->avatar)  }}" id="preview-image-before-upload" style="width: 180px;" class="mt-2">
                @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Trạng thái</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioDefault1" @if($job->status == 1) checked @endif>
                    <label class="form-check-label" for="flexRadioDefault1">
                        Kích hoạt
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioDefault2" @if($job->status == 0) checked @endif>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Chưa kích hoạt
                    </label>
                </div>
                @error('status')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>

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
    });

</script>
@endsection
