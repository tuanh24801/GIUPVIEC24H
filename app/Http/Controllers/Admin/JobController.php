<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\TypeRental;
use App\Models\JobRental;

class JobController extends Controller
{
    public function index(Request $request){
        $jobs = Job::orderBy('id')->where('status', 1)->search()->paginate(6);
        $jobs->appends($request->all());
        $recommend_jobs = Job::orderBy('id')->where('status', 0)->get();
        return view('admin.job-management.index', ['jobs' => $jobs, 'recommend_jobs' => $recommend_jobs]);
    }

    public function create(Request $request){
        $rules = [
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'avatar.image' => 'Vui lòng chọn đúng định dạng ảnh',
            'avatar.mimes' => 'Vui lòng chọn ảnh có định dạng :mimes',
            'avatar.max' => 'Kích thước file ảnh tối đa là :max mb',
            'status' => 'Trạng thái buộc phải chọn',
        ];
        $fileName = '';
        if(!empty($request->avatar)){
            $fileName = time() . '.' . $request->avatar->extension();
            $request->file('avatar')->storeAs('public/images/job-images', $fileName);
        }
        $request->validate($rules,$messages);
        $job = new Job();
        $job->name = $request->name;
        $job->avatar = $fileName;
        $job->note = '';
        if(!empty($request->note)){
            $job->note = $request->note;
        }
        $job->status = $request->status;
        $job->save();
        return redirect()->route('admin.job.index');
        // return 'ok';
    }

    public function edit(Request $request, $job_id){
        $job = Job::find($job_id);

        return view('admin.job-management.update',  ['job' => $job]);
    }

    public function update(Request $request,  $job_id){
        $job = Job::find($job_id);
        $rules = [
            'name' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
            'note' => 'required',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'avatar.image' => 'Vui lòng chọn đúng định dạng ảnh',
            'avatar.mimes' => 'Vui lòng chọn ảnh có định dạng :mimes',
            'avatar.max' => 'Kích thước file ảnh tối đa là :max mb',
            'status' => 'Trạng thái buộc phải chọn',
            'note.required' => 'Ghi chú buộc phải nhập'
        ];
        $request->validate($rules,$messages);
        $job->name = $request->name;
        $job->note = $request->note;
        $fileName = '';
        if(!empty($request->avatar)){
            $fileName = time() . '.' . $request->avatar->extension();
            $request->file('avatar')->storeAs('public/images/job-images', $fileName);
            $job->avatar = $fileName;
        }
        $job->save();

        return redirect()->back()->with('msg','Cập nhật công việc thành công');


    }

    public function update_status($job_id){
        $job = Job::find($job_id);
        $job->status = $job->status == '1' ? '0' : '1' ;
        $job->save();
        return redirect()->back();
    }


    public function delete(){
        return 'delete';
    }

    public function index_typeRentals(){
        $type_rentals = TypeRental::all();
        return view('admin.job-management.type_rentals', ['type_rentals' => $type_rentals]);
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
}
