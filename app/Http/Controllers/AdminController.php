<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function Index(){
        return view('admin.admin_login');

    }//end of method

    public function Dashboard(){
        return view('admin.index');

    }//end of method

    public function Login(REquest $request){
        //return view('admin.index');
        //dd($request->all());

        $check=$request->all();
        if(Auth::guard('admin')->attempt(['email'=>$check['email'],'password'=>$check['password'] ]))
       {

        return redirect()->route('admin.dashboard');

       }else
       {
           return back()->with('error','Invalid Login Credentials');
       }



    }//end of method

    public function AdminLogout(){
      Auth::guard('admin')->logout();
      return redirect()->route('admin_login');

    }//end of method

   
}
