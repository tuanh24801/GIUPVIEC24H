@extends('layouts.admin.main')
@section('content')
    <style>

    </style>
    <h1 class="text-dark">Danh sách công việc</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <div>
            <a href="{{ route('admin.job.add') }}" class="btn btn-success"><b>Thêm công việc mới</b></a>
            <a href="{{ route('admin.job.index_type_rentals') }}" class="btn btn-primary"><b>Quản lý hình thức thuê</b></a>
        </div>
        <form action="" class="d-flex">
            <input type="text" class="form-control" name="s" value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Tìm kiếm khách hàng">
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
                    <th scope="col">Tên công việc</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col" style="width:15%; text-align: center;">Trạng thái</th>
                    <th scope="col" style="width:10%; text-align: center;">Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <th scope="row">{{ $job->id }}</th>
                        <td style="width:10%;display:none;" class="table-tr-td-avatar">
                            <img class="table-tr-td-img" src="{{ !empty($job->avatar) ? asset('storage/images/job-images/'.$job->avatar) :  asset('storage/images/customer-images/user_1.png')}} "  alt="" style="width: 100%; display:none;"/>
                        </td>
                        <td>{{ $job->name }}</td>
                        <td>{{ $job->note }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.job.update_status', $job->id) }}" class="btn btn-md btn-outline-success">{{ $job->status == '1' ? 'Đang hoạt động' : 'Đang chờ duyệt'  }}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.job.edit', ['job_id' => $job->id]) }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $jobs->links() }}

        <h2 class="text-dark">Công việc chờ duyệt</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên công việc</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col" style="width:15%; text-align: center;">Trạng thái</th>
                    <th scope="col" style="width:15%; text-align: center;">Xóa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recommend_jobs as $recommend_job)
                    <tr>
                        <th scope="row">{{ $recommend_job->id }}</th>
                        <td>{{ $recommend_job->name }}</td>
                        <td>{{ $recommend_job->note }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.job.update_status', $recommend_job->id) }}" class="btn btn-md btn-outline-secondary">{{ $recommend_job->status == '1' ? 'Đang hoạt động' : 'Xét duyệt'  }}</a>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.job.delete', ['job_id' => $recommend_job->id]) }}" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $recommend_jobs->links() }} --}}
        <div style="margin-bottom: 100px;"></div>
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


