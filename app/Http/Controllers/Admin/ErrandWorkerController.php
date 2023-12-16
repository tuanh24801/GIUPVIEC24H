<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrandWorker;
use Illuminate\Support\Facades\Hash;


class ErrandWorkerController extends Controller
{
    public function index(Request $request){
        $errand_workers = ErrandWorker::orderBy('id')->search()->paginate(10);
        $errand_workers->appends($request->all());
        return view('admin.errand-worker-management.index', ['errand_workers' => $errand_workers]);
    }

    public function create(Request $request){
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
            'identification_card' => 'required|numeric|digits:12',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:errand_workers',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'address.required' => 'Địa chỉ khách hàng bắt buộc phải nhập',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.digits' => 'Sai độ dài vui lòng nhập đúng số điện thoại',
            'identification_card.required' => 'Số căn cước bắt buộc nhập',
            'identification_card.numeric' => 'Vui nhập đúng định dạng căn cước',
            'identification_card.digits' => 'Vui lòng nhập đúng độ dài',
            'avatar.image' => 'Vui lòng chọn đúng định dạng ảnh',
            'avatar.max' => 'Kích thước file ảnh tối đa là :max mb',
            'email.required' => 'Email buộc phải nhập',
            'email.email' => 'Sai định dạng email',
            'email.unique' => 'Email đã tồn tại, vui lòng nhập email khác',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.min' => 'Vui lòng nhập lớn hơn :min ký tự',
            'cpassword.required' => 'Vui lòng xác nhận mật khẩu',
            'cpassword.same' => 'Xác nhận mật khẩu không khớp',
        ];
        $fileName = '';
        if(!empty($request->avatar)){
            $fileName = time() . '.' . $request->avatar->extension();
            $request->file('avatar')->storeAs('public/images/errand_worker-images', $fileName);
        }
        $request->validate($rules,$messages);
        $errand_worker = new ErrandWorker();
        $errand_worker->name = $request->name;
        $errand_worker->address = $request->address;
        $errand_worker->phone = $request->phone;
        $errand_worker->avatar = $fileName;
        $errand_worker->identification_card = $request->identification_card;
        $errand_worker->email = $request->email;
        $errand_worker->password = Hash::make($request->password);
        $errand_worker->save();
        return redirect()->route('admin.errand_worker.index');
    }

    public function edit($errand_worker_id){
        $errand_worker = ErrandWorker::find($errand_worker_id);
        return view('admin.errand-worker-management.update', ['errand_worker' => $errand_worker]);
    }

    public function update(Request $request, $errand_worker_id){
        $errand_worker = ErrandWorker::find($errand_worker_id);
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
            'identification_card' => 'required|numeric|digits:12',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'address.required' => 'Địa chỉ khách hàng bắt buộc phải nhập',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.digits' => 'Sai độ dài vui lòng nhập đúng số điện thoại',
            'identification_card.required' => 'Số căn cước bắt buộc phải nhập',
            'identification_card.numeric' => 'Vui lòng nhập đúng định dạng',
            'identification_card.digits' => 'Sai độ dài vui lòng nhập đúng số căn cước',
        ];

        $request->validate($rules,$messages);
        $errand_worker->name = $request->name;
        $errand_worker->address = $request->address;
        $errand_worker->phone = $request->phone;
        $errand_worker->identification_card = $request->identification_card;

        if($request->has('password')){
            $rules = array_merge($rules, [
                'password' => 'required|min:6',
                'cpassword' => 'required|same:password',
            ]);
            $messages = array_merge($messages, [
                'password.required' => 'Mật khẩu bắt buộc phải nhập',
                'password.min' => 'Vui lòng nhập lớn hơn :min ký tự',
                'cpassword.required' => 'Vui lòng xác nhận mật khẩu',
                'cpassword.same' => 'Xác nhận mật khẩu không khớp',
            ]);

            // $errand_worker->password = Hash::make($request->password);
            $errand_worker->password = $request->password;
        }

        $request->validate($rules,$messages);

        if($request->has('avatar')){
            $rules = array_merge($rules, [
                'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $messages = array_merge($messages,[
                'avatar.image' => 'Vui lòng chọn đúng định dạng ảnh',
                'avatar.max' => 'Kích thước file ảnh tối đa là :max mb',
            ]);
            if(!empty($request->avatar)){
                $fileName = time() . '.' . $request->avatar->extension();
                $request->file('avatar')->storeAs('public/images/errand_worker-images', $fileName);
                $errand_worker->avatar = $fileName;
            }
        }

        if($request->has('email')){
            return redirect()->back()->withErrors(['email' => 'Không được thay đổi Email đăng nhập']);
        }

        $request->validate($rules,$messages);
        $errand_worker->save();
        return redirect()->back()->with('msg','Cập nhật thông tin người làm việc thành công !');
    }
}
