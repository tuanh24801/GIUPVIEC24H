<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\ErrandWorker;
use App\Models\JobRental;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\RentalHistory;
use App\Models\EwIncome;
use Carbon\Carbon;

class JobController extends Controller
{

    public function job_list(){
        $jobs = Job::where('status', 1)->orderBy('id', 'desc')->search()->paginate(10);
        return view('customer.job.job_list', ['jobs' => $jobs]);
    }

    public function job_detail($job_id, Request $request){
        $job = Job::find($job_id);
        if($job->status != 1){
            return redirect()->back();
        }
        return view('customer.job.job_detail', ['job' => $job]);

    }

    public function job_rental($job_id, $errand_worker_id, Request $request){
        // $job_id

        $job = Job::find($job_id);
        if($job->status != 1){
            return redirect()->back();
        }
        $errand_worker_id_array = [];
        foreach ($job->errand_workers as $errand_worker) {
            $errand_worker_id_array[] = $errand_worker->id;
        }
        if (!in_array($errand_worker_id, $errand_worker_id_array)) {
            return redirect()->back();
        }
        $errand_worker = ErrandWorker::find($errand_worker_id);

        $job_rental = JobRental::where('job_id', $job->id)->where('errand_worker_id', $errand_worker->id)->get();
        $rental_type = $job_rental[0]->type_rental->name;
        $job_rental_note = $job_rental[0]->note;
        return view('customer.job.job_rental', ['job' => $job, 'job_rental' => $job_rental, 'errand_worker' => $errand_worker]);
    }

    public function handle_rental($job_rental_id, Request $request){
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $rules = [
            'amount' => 'required|numeric',
            'location' => 'required',
        ];
        $messages = [
            'amount.required' => 'Vui lòng nhập số lần thuê',
            'amount.numeric' => 'Vui lòng nhập đúng định dạng',
            'location.required' => 'Vui lòng nhập địa chỉ',
        ];
        $request->validate($rules, $messages);

        $job_rental = JobRental::find($job_rental_id);

        if($job_rental->cost*$request->amount > $customer->account_balance){
            return redirect()->back()->with('msg','Bạn không đủ số dư vui lòng nạp tiền để tiếp tục');
        }

        $rentalHistory = new RentalHistory();

        $rentalHistory->customer_id = $customer->id;
        $rentalHistory->job_rental_id = $job_rental->id;
        $rentalHistory->total = $job_rental->cost*$request->amount;
        $rentalHistory->location = $request->location;
        $rentalHistory->errand_worker_status = 'Đang chờ';
        $rentalHistory->customer_status = 'Đang chờ';
        if(!empty($request->note)){
            $rentalHistory->note = $request->note;
        }
        $rentalHistory->save();
        $customer->account_balance = $customer->account_balance - $job_rental->cost*$request->amount;
        $customer->save();

        return redirect()->route('customer.rental-history');
    }

    public function rental_history(){
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $rentalHistories_1 =  $customer->rentalHistories->where('errand_worker_status','Đang chờ');
        $date = new Carbon();
        $date ->subMinutes(15);
        foreach ($rentalHistories_1  as $rentalHistory) {
            if($rentalHistory->created_at <= $date){
                $rentalHistory->customer_status = "Hết thời gian chờ";
                $rentalHistory->errand_worker_status = "Hết thời gian chờ";
                $rentalHistory->save();
                $customer->account_balance += $rentalHistory->total;
                $customer->save();
            }
        }

        $rentalHistories_2 =  $customer->rentalHistories->where('errand_worker_status','Hoàn thành');
        $date = new Carbon();
        $date->subDays(2);
        foreach ($rentalHistories_2  as $rentalHistory) {
            if($rentalHistory->created_at <= $date){
                $rentalHistory->customer_status = "Hết thời gian chờ";
                $rentalHistory->errand_worker_status = "Hết thời gian chờ";
                $rentalHistory->save();
                $customer->account_balance += $rentalHistory->total;
                $customer->save();
            }
        }

        return view('customer.job.rental_history', ['customer' => $customer]);
    }

    public function status_job($rental_history_id, $e_status = '', $c_status){
        $customer = Customer::find(Auth::guard('customer')->user()->id);
        $rentalHistory = RentalHistory::find($rental_history_id);
        if($e_status == 'Hủy' || $c_status == 'Hủy'){
            $date = new Carbon();
            $date ->subMinutes(15);
            if($rentalHistory->created_at <= $date){
                return redirect()->back()->with('msg','Đã hết thời gian chờ');
            }
            if($rentalHistory->errand_worker_status == 'Đang chờ' ||  $rentalHistory->customer_status == 'Đang chờ'){
                $rentalHistory->errand_worker_status = 'KH Đã hủy';
                $rentalHistory->customer_status = 'KH Đã hủy';
                $rentalHistory->save();
                $customer->account_balance += $rentalHistory->total;
                $customer->save();
                return redirect()->back();
            }
        }
        if($e_status == 'Hoàn thành' || $c_status == 'Đã xác nhận'){
            $rentalHistory->errand_worker_status = $e_status;
            $rentalHistory->customer_status = $c_status;
            $rentalHistory->save();

            $errand_worker_id = $rentalHistory->job_rental->errand_workers->id;

            $errand_worker = ErrandWorker::find($errand_worker_id);
            $errand_worker->account_balance  += $rentalHistory->total;
            $errand_worker->save();

            $ew_income = new EwIncome();
            $ew_income->amount_in = $rentalHistory->total;
            $ew_income->note = 'hoan thanh '.$rentalHistory->id;
            $ew_income->errand_worker_id = $errand_worker->id;
            $ew_income->save();
            return redirect()->back()->with('msg', 'Đã xác nhận hoàn thành công việc');
        }

        return redirect()->back();
    }
}
