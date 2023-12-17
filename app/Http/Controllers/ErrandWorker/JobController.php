<?php

namespace App\Http\Controllers\ErrandWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\TypeRental;
use App\Models\ErrandWorker;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request){
        $jobs = Job::orderBy('id')->where('status', 1)->search()->paginate(12);
        $jobs->appends($request->all());
        return view('errand_worker.job-management.index', ['jobs' => $jobs]);
    }

    public function detail(Request $request, $job_id){
        $job = Job::find($job_id);
        $typeRentals = TypeRental::all()->where('status', 1);
        if($job->status == 0){
            return redirect()->route('errand_worker.job.index');
        }
        return view('errand_worker.job-management.detail', ['job' => $job, 'typeRentals' => $typeRentals]);
    }

    public function create_typeRentals(Request $request){
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'name.required' => 'Tên hình thức buộc phải nhập',
        ];
        $request->validate($rules,$messages);
        $typeRental = new TypeRental();
        $typeRental->name = $request->name;
        $typeRental->save();
        return redirect()->back()->with('msg','Đã thêm hình thức mới');
    }

    public function accept_job(Request $request){
        $errand_worker_id = Auth::guard('errand_worker')->user()->id;
        dd($errand_worker_id);
    }
}
