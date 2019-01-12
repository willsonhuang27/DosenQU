<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Cookie;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = User::with('role')->where('email',$email)->first();
        if(!empty ($data))
        {
            if(Hash::check($password,$data->password))
            {
                session(['name' => $data->name]);
                session(['role' => $data->role->description]);
                session(['user_id' => $data->id]);
                session(['profile_picture' => $data->profile_picture]);

                if($request->remember == 'on')
                {
                	Cookie::queue(Cookie::make('name', $data->name, 360));
                	Cookie::queue(Cookie::make('role', $data->role->description, 360));
                	Cookie::queue(Cookie::make('user_id', $data->id, 360));
                	Cookie::queue(Cookie::make('profile_picture', $data->profile_picture, 360));
                }

                if($data->role->description == 'admin')
                {
                	return redirect('admin/');
                }
                else
                {
                	return redirect('member/');
                }
               
            }
            else
            {
                return redirect()->back()->with('alert','Invalid Password!');
            }
        }
        else
        {
            return redirect()->back()->with('alert','Invalid Password!');
        }
    }
    public function index()
    {
    	return view('login');
    }
}
