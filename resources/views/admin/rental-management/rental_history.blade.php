@extends('layouts.admin.main')
@section('content')
    <style>

    </style>
    <h1 class="text-dark">Lịch sử thuê việc</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        {{-- <form action="" class="d-flex">
            <input type="text" class="form-control" name="s" value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Tìm kiếm khách hàng">
            <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="{{ request()->fullUrlWithQuery(['s'=>'']) }}" class="btn btn-danger "><i class="fa-solid fa-trash"></i></a>
        </form> --}}
    </div>
    <div class="container pt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">hình thức thuê</th>
                    <th scope="col">Người nhận việc</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Trạng thái người nhận việc</th>
                    <th scope="col">Trạng thái khách hàng</th>
                    <th scope="col">Ghi chú khách hàng</th>
                    <th scope="col">Thời gian</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($rental_histories as $rental_history)
                    <tr>
                        <th scope="row">{{ $rental_history->id }}</th>
                        <td>{{ $rental_history->customer->name }}</td>
                        <td>{{ $rental_history->job_rental->type_rental->name }}</td>
                        <td>{{ $rental_history->job_rental->errand_workers->name }}</td>
                        <td>{{ $rental_history->location }}</td>
                        <td>{{  Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($rental_history->total) }}</td>
                        <td>{{ $rental_history->errand_worker_status }}</td>
                        <td>{{ $rental_history->customer_status }}</td>
                        <td>{{ $rental_history->note }}</td>
                        <td>{{ $rental_history->created_at }}</td>
                        {{-- <td>{{ $payment->card_type }}</td>
                        <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($payment->amount) }}</td>
                        <td><a href="#" class="btn {{ $payment->status == 1 ? 'btn-success' : 'btn-secondary'}}">{{ $payment->status == 1 ? 'Thành công' : 'Thất bại'}}</a></td>
                        <td>{{ $payment->created_at }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rental_histories->links() }}


        {{-- {{ $recommend_jobs->links() }} --}}
        <div style="margin-bottom: 100px;"></div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">


    </script>
@endsection


