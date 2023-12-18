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
    <h1 class="text-dark">Đề xuất công việc</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <a href="{{ route('errand_worker.job.index') }}" class="btn btn-secondary"><b>Quay lại</b></a>
    </div>
    <div class="container pt-4">
        <form action="#" method="post" enctype="multipart/form-data" class="w-90"
            style="width: 70%;margin: auto;">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label class="form-label">Tên công việc</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <div class="row">
                    <label class="form-label">Ghi chú</label>
                    <div class="form-floating">
                        <textarea class="form-control @error('note') is-invalid @enderror" name="note" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                        {{-- <label for="floatingTextarea2">Comments</label> --}}
                      </div>
                      @error('note') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Ảnh</label>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                    id="image">
                <img src="" id="preview-image-before-upload" style="width: 180px;" class="mt-2">
                @error('avatar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Đề xuất</button>
        </form>

    </div>
</div>
@endsection
{{-- AIzaSyAHcnCAa_lzBc7xwUSOclugmwKVSEhDk3s --}}


@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(e) {
            $('#image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endsection
