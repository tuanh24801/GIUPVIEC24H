<?php

namespace App\Http\Controllers\ErrandWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrandWorker;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ErrandWorkerController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'address' => 'required',
            'phone' => 'required|min:10|max:11',
            'identification' => 'required|digits:12',
            'password' => 'required|min:6|max:15',
            'cpassword' => 'required|same:password',
        ],[
            'cpassword.same' => 'The confirm password and password must match'
        ]);

        $errand_woker = new ErrandWorker();
        $errand_woker->name = $request->name;
        $errand_woker->email = $request->email;
        $errand_woker->address = $request->address;
        $errand_woker->phone = $request->phone;
        $errand_woker->identification_card = $request->identification;
        $errand_woker->password = Hash::make($request->password);
        $data = $errand_woker->save();
        if($data){
            return back()->with('success', 'Errand Worker created successfully');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function login(Request $request){
        if(Auth::guard('errand_worker')->attempt($request->only('email', 'password'))){
            return redirect()->route('errand_worker.dashboard');
            // return 'ddawng nhap ok';
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function logout(Request $request){
        Auth::guard('errand_worker')->logout();
        return redirect()->route('errand_worker.login');
    }

    public function update(Request $request){
        $errand_worker = ErrandWorker::find(Auth::guard('errand_worker')->user()->id);
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
