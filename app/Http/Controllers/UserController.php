<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login(Request $request)
    {
        $data = User::where('email', $request->email)->first();
        if($data!=null)
        {
            if($data->password == $request->password)
            {
                Session::put("name", $data->name);
                Session::put("role_id", $data->role_id);
                Session::put("isLogin", TRUE);
                //Cookie::queue("age", 20, 2000);
                //Cookie::get("age");
                //Cookie::has("age");
                //Cookie::forget("age");
                return redirect('/dashboard');
            }else{
                return redirect("login")->with("alert", "Invalid Password");
            }
        } else{
            return redirect("login")->with("alert", "Invalid Email");
        }
    }
    public function showDashboard()
    {
        if(Session::get("role_id") == "1")
        {
            return view("admin");
        }
        else if(Session::get("role_id") == "2")
        {
            return view("member");
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect("");
    }
}
