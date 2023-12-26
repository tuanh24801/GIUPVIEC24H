<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\ErrandWorker;
use App\Models\JobRental;

class HomeController extends Controller
{

    public function index(){
        return view('home');
    }






}
