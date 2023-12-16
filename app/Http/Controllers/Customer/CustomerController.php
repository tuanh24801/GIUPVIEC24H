<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function create(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|min:6|max:15',
            'cpassword' => 'required|same:password',
        ],[
            'cpassword.same' => 'The confirm password and password must match'
        ]);

        $user = new Customer();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $data = $user->save();
        if($data){
            return back()->with('success', 'User created successfully');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function doLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::guard('customer')->attempt($request->only('email', 'password'))){
            return redirect()->route('customer.home');
            // return 'ddawng nhap ok';
        }else{
            return back()->with('error', 'Something went wrong');
        }
        // return 'asdasf';
    }

    public function logout(Request $request){
        // dd($request->guard());
        Auth::guard('customer')->logout();
        return redirect()->route('customer.home');

        // $request->session()->invalidate();
        // $this->guard('')->logout();
    }
}
