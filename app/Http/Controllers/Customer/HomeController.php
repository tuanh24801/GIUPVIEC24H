<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\ErrandWorker;
use App\Models\JobRental;

class HomeController extends Controller
{

    public function index(Request $request){
        $jobs = Job::where('status', 1)->offset(0)->limit(6)->get();
        $errand_workers = ErrandWorker::search()->paginate(4);
        $errand_workers->appends($request->all());
        return view('home', ['jobs' => $jobs, 'errand_workers' => $errand_workers]);
    }






}
