@extends('layouts.admin.main')
@section('content')
    <style>
        label {
            font-weight: 700;
            color: black;
            font-size: 15px;
        }
    </style>
    <h1 class="text-dark">Hình thức thuê</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <div>
            <i class="text-dark">(VD: thuê theo giờ, thuê theo lần, theo doanh số,...)</i><br>
            <a href="{{ route('admin.job.index') }}" class="btn btn-secondary mt-2"><b>Quay lại</b></a>
        </div>
    </div>
    <div class="container pt-4">
        <table class="table mb-4">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col" style="width:10%; text-align: center;">Sửa</th>
                    <th scope="col" style="width:10%; text-align: center;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php $customers = []; @endphp --}}
                @foreach ($type_rentals as $type_rental)
                    <tr>
                        <th scope="row">{{ $type_rental->id }}</th>
                        <td>{{ $type_rental->name }}</td>
                        <td>{{ $type_rental->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-danger"><i class="fa-solid fa-lock"></i></a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <h3 class="text-dark mt-5">Thêm hình thức thuê</h3>
        <div class="row">
            <div class="col-4">
                <form action="{{ route('admin.job.create_type_rental') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label class="form-label">Tên hình thức</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm mới</button>
                </form>
            </div>
        </div>
        {{-- {{ $errand_workers->links() }} --}}
    </div>
@endsection


