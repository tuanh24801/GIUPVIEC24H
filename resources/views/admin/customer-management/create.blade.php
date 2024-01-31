@extends('layouts.admin.main')
@section('content')
    <style>
        label{
            font-weight: 700;
            color: black;
            font-size: 15px;
        }

    </style>
    <h1 class="text-dark">Thêm khách hàng mới</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <a href="{{ route('admin.customer.index') }}" class="btn btn-secondary"><b>Quay lại</b></a>
    </div>
    <div class="container pt-4">
        <form action="{{ route('admin.customer.create') }}" method="post" enctype="multipart/form-data" class="w-90" style="width: 70%;margin: auto;">
            @csrf
            @method('POST')
            <h3 class="text-dark">Thông tin khách hàng</h3>
            <div class="mb-3">
                <label  class="form-label">Tên khách hàng</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label  class="form-label">Địa chỉ</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" id="autocomplete">
                {{-- <input type="text" class="form-control" id="autocomplete"> --}}
                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label">Điện thoại</label>
                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">
                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label  class="form-label">Ảnh đại diện</label>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" id="image">
                <img src="a" id="preview-image-before-upload" style="width: 180px;" class="mt-2">
                @error('avatar') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <h3 class="text-dark">Thông tin đăng nhập</h3>
            <div class="mb-3">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}">
                @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Nhập lại mật khẩu</label>
                <input type="password" class="form-control @error('cpassword') is-invalid @enderror" name="cpassword">
                @error('cpassword') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
@endsection
{{-- AIzaSyAHcnCAa_lzBc7xwUSOclugmwKVSEhDk3s --}}


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
        let autocomplete;
        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById('autocomplete'), {
                types: ['address'],
                componentRestrictions: { 'country': ['VN'] },
                fields: ['name']
            });
            autocomplete.addListener('place_changed', onPlaceChanged);
        }

        function onPlaceChanged() {
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                document.getElementById('autocomplete').placeholder = 'Enter a location';
            } else {
                document.getElementById('autocomplete').innerHTML = place.name;
            }
        }

    </script>
@endsection
