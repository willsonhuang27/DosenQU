<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Redirect;
use App\Role;
use App\User;
use App\Rules\containStreet;
use Carbon\Carbon;

class MasterController extends Controller
{


    public function index()
    {
        $users = User::paginate(5);
        return view('admin.master-user',compact('users'));
    }
    //
    public function create()
    {
    	$roles = Role::get();
        return view('admin.master-add-user',compact('roles'));
    }

    public function store(Request $request)
    {
        $year = date('Y-m-d', strtotime('-12 years'));

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'role' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' =>'required|same:password',
            'phone' => 'required|numeric',
            'address' => ['required',new containStreet],
            'gender' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg',
            'birthday' => 'required|date|before:-13 years'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        //image
        $image = $request->file('photo');
        $fileName = uniqid('img_'); // for unique
        $path = public_path('images');
        $fileName = $fileName . '.' . \File::extension($image->getClientOriginalName());
        $image->move($path,$fileName);
        //----

        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->profile_picture = 'images/'.$fileName;
        $temp = Carbon::parse($request->get('birthday'));
        $temp = $temp->format('Y-m-d');
        $user->birth_date = $temp;
        $user->role_id =  $request->get('role');
        $user->gender = $request->get('gender');
        $user->save();

        return redirect(url('/msuser'));
    }

    public function edit($id)
    {
        //
        $old = User::find($id);
        return view('admin.master-update-user',compact('old'));
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
        $users = User::find($id);
        $users->delete();
        return redirect('/msuser');
    }

}
