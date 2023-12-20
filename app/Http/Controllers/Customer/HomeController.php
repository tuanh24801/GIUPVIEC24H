<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\ErrandWorker;

class HomeController extends Controller
{

    public function index(){
        return view('home');
    }

    public function job_list(){
        $jobs = Job::where('status', 1)->get();
        return view('job_list', ['jobs' => $jobs]);
    }

    public function job_detail($job_id, Request $request){
        // $job_id

        $job = Job::find($job_id);
        // $errand_workers = $job->error_workers();

        if($job->status != 1){
            return redirect()->back();
        }
        return view('job_detail', ['job' => $job]);

    }
}
