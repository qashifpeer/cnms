<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class StudentController extends Controller
{
    public function Index(){
        return view('student.student_login');

    }//end of method
    public function Dashboard(){
        return view('student.index');

    }//end of method

    public function Login(Request $request){
        //return view('');
        //dd($request->all());

        $check=$request->all();
        if(Auth::guard('student')->attempt(['email'=>$check['email'],'password'=>$check['password'] ]))
       {

        return redirect()->route('student.dashboard');

       }else
       {
           return back()->with('error','Invalid Login Credentials');
       }



    }//end of method
    public function StudentLogout(){
        Auth::guard('student')->logout();
        return redirect()->route('student_login');

      }//end of method

      public function StudentRegister(){

        return view('student.register_page');

      }//end of method

      public function StdRegisterCreate(Request $req)
      {
       //dd($req->all());

       Student::insert([

        'name'=> $req->name,
        'email'=> $req->email,
        'password'=> Hash::make($req->password),
        

       ]);
       return redirect()->route('student_login')->with('error','User Created Successfully');

      }//end of method


}
