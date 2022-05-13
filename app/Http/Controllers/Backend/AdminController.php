<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;

class AdminController extends Controller
{
    public function adminLoginForm()
    {
        return view('backend.admin.admin_login');
    }


    public function adminLogin(Request $request){
     
        $validatedData = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);
        if (Auth::guard('admin')->attempt(['email'=>$request->email, 'password'=>$request->password])) {
            return redirect('admin/dashboard');
        }else{
            Session::flash('error','Email or Password Invalid');

            return redirect()->back();
        }

    }

    public function adminLogout(){

        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
