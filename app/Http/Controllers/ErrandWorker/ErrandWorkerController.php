<?php

namespace App\Http\Controllers\ErrandWorker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ErrandWoker;
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

        $errand_woker = new ErrandWoker();
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
}
