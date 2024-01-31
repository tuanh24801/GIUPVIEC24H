@extends('layouts.errand_worker.main')
<style>
    label{
        font-weight: 700;
        color: black;
        font-size: 15px;
    }
</style>
@section('content')
    <div class="container pt-4 text-dark" style="margin-bottom: 100px;">
        <h1>Thu nhập</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Tiền vào</th>
                    <th scope="col">Tiền ra</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">thời gian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($errand_worker->ew_incomes as $ew_income)
                <tr>
                    <td>{{$ew_income->id}}</td>
                    <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($ew_income->amount_in)}}</td>
                    <td>{{ Magarrent\LaravelCurrencyFormatter\Facades\Currency::currency("VND")->format($ew_income->amount_out)}}</td>
                    <td>{{ $ew_income->note }} </td>
                    <td>{{ $ew_income->created_at }} </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection


@section('scripts')
@endsection
