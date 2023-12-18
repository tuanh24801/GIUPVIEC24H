<?php

namespace App\Http\Controllers\ErrandWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\TypeRental;
use App\Models\ErrandWorker;
use App\Models\Customer;
use App\Models\JobRental;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request){
        $errand_worker = ErrandWorker::find(Auth::guard('errand_worker')->user()->id);
        $array_id_jobs = [];
        foreach ($errand_worker->jobs as $job) {
            $array_id_jobs[] = $job->id;
        }
        $jobs = Job::orderBy('id')->where('status', 1)->search()->paginate(12);
        $jobs->appends($request->all());
        return view('errand_worker.job-management.index', ['jobs' => $jobs, 'errand_worker' => $errand_worker, 'array_id_jobs' => $array_id_jobs]);
    }

    public function detail(Request $request, $job_id){
        $job = Job::find($job_id);
        if($this->check_accepted_job($job_id)){
            return redirect()->route('errand_worker.job.index')->with('msg','Bạn đã nhận việc này rồi');
        }
        if(!$job) {
            return redirect()->route('errand_worker.job.index');
        }
        if($job->status == 0){
            return redirect()->route('errand_worker.job.index');
        }
        $typeRentals = TypeRental::all()->where('status', 1);
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

    public function accept_job($job_id,Request $request){
        $errand_worker_id = Auth::guard('errand_worker')->user()->id;
        if($this->check_accepted_job($job_id)){
            return redirect()->route('errand_worker.job.index')->with('msg','Bạn đã nhận việc này rồi');
        }
        $job = Job::find($job_id);
        if(!$job) {
            return redirect()->route('errand_worker.job.index');
        }
        if($job->status == 0){
            return redirect()->route('errand_worker.job.index');
        }
        $rules = [
            'type_rental_id' => 'required|exists:type_rentals,id',
            'cost' => 'required|integer',
            'note' => 'required',
        ];

        $messages = [
            'type_rental_id.required' => 'Vui lòng hình thức thuê',
            'type_rental_id.exists' => 'Vui lòng chỉ hình thức thuê đã tồn tại',
            'cost.required' => 'Vui lòng nhập giá thuê',
            'cost.integer' => 'Vui lòng nhập đúng định dạng số tiền',
            'note.required' => 'Vui lòng nhập ghi chú cho khách hàng',
        ];

        $request->validate($rules,$messages);

        $job_rental = new JobRental();
        $job_rental->job_id = $job_id;
        $job_rental->errand_worker_id = $errand_worker_id;
        $job_rental->type_rental_id = $request->type_rental_id;
        $job_rental->cost = $request->cost;
        $job_rental->note = $request->note;
        $job_rental->status = '1'; //kich hoat nhan viec
        $job_rental->save();

        return redirect()->route('errand_worker.job.index')->with('msg','Bạn đã nhận việc '.$job->name);
    }

    public function check_accepted_job($job_id){
        $errand_worker = ErrandWorker::find(Auth::guard('errand_worker')->user()->id);
        $array_id_jobs = [];
        foreach ($errand_worker->jobs as $job) {
            $array_id_jobs[] = $job->id;
        }
        if(in_array($job_id,$array_id_jobs)){
            return true;
        }
        return false;
    }
}
