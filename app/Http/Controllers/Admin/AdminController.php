<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request){
        if(Auth::guard('admin')->attempt($request->only('email', 'password'))){
            return redirect()->route('admin.dashboard');
        }else{
            return back()->with('error', 'Something went wrong');
        }
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
