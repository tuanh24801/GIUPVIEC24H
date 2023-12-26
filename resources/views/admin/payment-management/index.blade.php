@extends('layouts.admin.main')
@section('content')
    <style>

    </style>
    <h1 class="text-dark">Danh sách khách hàng nạp tiền</h1>
    <div class="admin-customer-option-list-customer d-flex justify-content-between">
        <form action="" class="d-flex">
            <input type="text" class="form-control" name="s" value="@isset(request()->s) {{ request()->s }} @endisset" placeholder="Tìm kiếm khách hàng">
            <button type="submit" class="btn btn-primary mx-1"><i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="{{ request()->fullUrlWithQuery(['s'=>'']) }}" class="btn btn-danger "><i class="fa-solid fa-trash"></i></a>
        </form>
    </div>
    <div class="container pt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tên người nạp</th>
                    <th scope="col">Ngân hàng</th>
                    <th scope="col">Hình thức nạp</th>
                    <th scope="col">Số tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thời gian</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <th scope="row">{{ $payment->id }}</th>
                        <td>{{ $payment->customer->name }}</td>
                        <td>{{ $payment->bank_code }}</td>
                        <td>{{ $payment->card_type }}</td>
                        <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($payment->amount) }}</td>
                        <td><a href="#" class="btn {{ $payment->status == 1 ? 'btn-success' : 'btn-secondary'}}">{{ $payment->status == 1 ? 'Thành công' : 'Thất bại'}}</a></td>
                        <td>{{ $payment->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $payments->links() }}


        {{-- {{ $recommend_jobs->links() }} --}}
        <div style="margin-bottom: 100px;"></div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">


    </script>
@endsection


