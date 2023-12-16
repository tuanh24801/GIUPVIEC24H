<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // customer list
    public function index(Request $request){
        $customers = Customer::orderBy('id')->search()->paginate(10);
        $customers->appends($request->all());
        return view('admin.customer-management.index', ['customers' => $customers]);
    }

    public function create(Request $request){
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
            'cpassword' => 'required|same:password',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'address.required' => 'Địa chỉ khách hàng bắt buộc phải nhập',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.digits' => 'Sai độ dài vui lòng nhập đúng số điện thoại',
            'avatar.image' => 'Vui lòng chọn đúng định dạng ảnh',
            'avatar.max' => 'Kích thước file ảnh tối đa là :max mb',
            'email.required' => 'Email buộc phải nhập',
            'email.email' => 'Sai định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
            'password.min' => 'Vui lòng nhập lớn hơn :min ký tự',
            'cpassword.required' => 'Vui lòng xác nhận mật khẩu',
            'cpassword.same' => 'Xác nhận mật khẩu không khớp',
        ];
        $fileName = '';
        if(!empty($request->avatar)){
            $fileName = time() . '.' . $request->avatar->extension();
            $request->file('avatar')->storeAs('public/images/customer-images', $fileName);
        }
        $request->validate($rules,$messages);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->avatar = $fileName;
        $customer->email = $request->email;
        $customer->password = Hash::make($request->password);
        $customer->save();
        return redirect()->route('admin.customer.index');
    }

    public function edit($customer_id){
        $customer = Customer::find($customer_id);
        return view('admin.customer-management.update', ['customer' => $customer]);
    }

    public function update($customer_id, Request $request){
        // dd($request->all());
        $customer = Customer::find($customer_id);
        // dd($customer);
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|numeric|digits:10',
        ];
        $messages = [
            'name.required' => 'Tên khách hàng bắt buộc phải nhập',
            'address.required' => 'Địa chỉ khách hàng bắt buộc phải nhập',
            'phone.required' => 'Số điện thoại bắt buộc phải nhập',
            'phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.digits' => 'Sai độ dài vui lòng nhập đúng số điện thoại',
        ];

        $request->validate($rules,$messages);

        $customer->name = $request->name;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

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

            $customer->password = Hash::make($request->password);
            // $customer->password = $request->password;
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
                $request->file('avatar')->storeAs('public/images/customer-images', $fileName);
                $customer->avatar = $fileName;
            }


        }

        if($request->has('email')){
            return redirect()->back()->withErrors(['email' => 'Không được thay đổi Email đăng nhập']);
        }

        $request->validate($rules,$messages);
        $customer->save();
        return redirect()->back()->with('msg','Cập nhật thông tin khách hàng thành công !');


    }
}
