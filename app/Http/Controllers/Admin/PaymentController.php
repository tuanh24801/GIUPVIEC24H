<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Request $request){
        $payments = Payment::search()->paginate(15);
        $payments->appends($request->all());
        return view('admin.payment-management.index', ['payments' => $payments]);
    }
}
