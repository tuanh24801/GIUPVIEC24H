<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalHistory;

class RentalHistoryController extends Controller
{
    public function index(){
        $rental_histories = RentalHistory::orderBy('id')->paginate(12);
        return view('admin.rental-management.rental_history', ['rental_histories' => $rental_histories]);
    }
}
