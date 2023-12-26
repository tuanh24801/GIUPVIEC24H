@extends('layouts.admin.main')
@section('content')
    <style>

    </style>
    <h1 class="text-dark">Danh sách người làm việc</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <a href="{{ route('admin.errand_worker.add') }}" class="btn btn-success"><b>Thêm người làm việc</b></a>
        <form action="" class="d-flex">
            <input type="text" class="form-control" name="s" value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Tìm kiếm người làm việc">
            <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="{{ request()->fullUrlWithQuery(['s'=>'']) }}" class="btn btn-danger "><i class="fa-solid fa-trash"></i></a>
        </form>
    </div>
    <div class="container pt-4">
        <div class="form-check form-switch">
            <label class="form-check-label text-dark" for="flexSwitchCheckChecked">Ẩn/Hiện Ảnh đại diện</label>
            <input class="form-check-input" type="checkbox" id="toggle_avatar" onchange="toggleAvatar()">
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" style="width:10%; display:none;" id="table-tr-th-avatar">Avatar</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col" style="width:10%; text-align: center;">Công việc</th>
                    <th scope="col" style="width:10%; text-align: center;">Lịch sử thuê</th>
                    <th scope="col" style="width:10%; text-align: center;">Chỉnh sửa</th>
                    <th scope="col" style="width:10%; text-align: center;">Khóa tài khoản</th>
                </tr>
            </thead>
            <tbody>
                {{-- @php $customers = []; @endphp --}}
                @foreach ($errand_workers as $errand_worker)
                    <tr>
                        <th scope="row">{{ $errand_worker->id }}</th>
                        <td style="width:10%;display:none;" class="table-tr-td-avatar">
                            <img class="table-tr-td-img" src="{{ !empty($errand_worker->avatar) ? asset('storage/images/errand_worker-images/'.$errand_worker->avatar) :  asset('storage/images/customer-images/user_1.png')}} "  alt="" style="width: 100%; display:none;"/>
                        </td>
                        <td>{{ $errand_worker->name }}</td>
                        <td>{{ $errand_worker->email }}</td>
                        <td>{{ $errand_worker->phone }}</td>
                        <td class="text-center">
                            <a href="#" class="btn btn-primary"><i class="fa-solid fa-eye"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="#" class="btn btn-success"><i class="fa-solid fa-clock-rotate-left"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.errand_worker.edit', ['errand_worker_id' => $errand_worker->id]) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="" class="btn btn-danger"><i class="fa-solid fa-lock"></i></a>
                        </td>
                    </tr>
                @endforeach


            </tbody>
        </table>
        {{ $errand_workers->links() }}
        <div style="height: 140px;"></div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        function toggleAvatar() {
            let toggle_ = document.getElementById('toggle_avatar');
            let table_tr_th_avatar = document.getElementById('table-tr-th-avatar');
            let table_tr_td_avatar = document.getElementsByClassName("table-tr-td-avatar");
            let table_tr_td_img = document.getElementsByClassName("table-tr-td-img");
            if(toggle_.checked){
                console.log('onAvatar');
                table_tr_th_avatar.style.display = '';
                for (var i = 0; i < table_tr_td_avatar.length; ++i) {
                    var item = table_tr_td_avatar[i];
                    var item_ = table_tr_td_img[i];
                    item.style.display = '';
                    item_.style.display = '';
                }

            }
            else{
                console.log('offAvatar');
                table_tr_th_avatar.style.display = 'none';
                for (var i = 0; i < table_tr_td_avatar.length; ++i) {
                    var item = table_tr_td_avatar[i];
                    var item_ = table_tr_td_img[i];
                    item.style.display = 'none';
                    item_.style.display = 'none';
                }
            }
        }


    </script>
@endsection


