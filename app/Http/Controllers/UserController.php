<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Rating;
use App\Message;
use Carbon\Carbon;
use App\Rules\containStreet;

class UserController extends Controller
{
    public function create()
    {
    	return view('register');
    }

    public function store(Request $request){
        $year = date('Y-m-d', strtotime('-12 years'));

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' =>'required|same:password',
            'phone' => 'required|numeric',
            'address' => ['required',new containStreet],
            'gender' => 'required',
            'photo' => 'required|mimes:jpeg,png,jpg',
            'birthday' => 'required|date|before:-13 years' ,
            'agree' => 'required|accepted'
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
        $user->role_id = 1;
        $user->gender = $request->get('gender');
        $user->save();

        return redirect(url('/'));

    }

    public function logout()
    {
        session()->flush();

        return redirect(url('/'));
    }

    public function viewProfile(Request $request)
    {
        $user = User::where('id','=',$request->id)->first();
        $ratingNegative = Rating::where([['user_id','=',$request->id],['score','=','0']])->get()->count();
        $ratingPositive = Rating::where([['user_id','=',$request->id],['score','=','1']])->get()->count();

        $role = session('role','guess');

        if($role == 'member')
        {
            return view('member.profile',compact('user','ratingNegative','ratingPositive'));
        }
        else if($role == 'admin')
        {
            return view('admin.profile',compact('user','ratingNegative','ratingPositive'));
        }
    }

    public function viewSelfEdit()
    {
        $user = User::where('id','=',session('user_id'))->first();

        $role = session('role','guess');

        if($role == 'member')
        {
            return view('member.profile-edit',compact('user'));
        }
        else if($role == 'admin')
        {
            return view('admin.profile-edit',compact('user'));
        }

    }

    public function postSelfEdit(Request $request)
    {
        $year = date('Y-m-d', strtotime('-12 years'));

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.session('user_id').",id",
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

        $user = User::find(session('user_id'));
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->phone = $request->get('phone');
        $user->address = $request->get('address');
        $user->profile_picture = 'images/'.$fileName;
        $temp = Carbon::parse($request->get('birthday'));
        $temp = $temp->format('Y-m-d');
        $user->birth_date = $temp;
        $user->gender = $request->get('gender');
        $user->save();

        session(['profile_picture' => 'images/'.$fileName]); //update profile picture

        $role = session('role','guess');

        if($role == 'member')
        {
            return redirect(url('member/profile/'.session('user_id')));
        }
        else if($role == 'admin')
        {
            return redirect(url('admin/profile/'.session('user_id')));
        }
    }

    public function showInbox()
    {
        $messages = Message::where('user_id',session('user_id'))->paginate(10);

        $role = session('role','guess');

        if($role == 'member')
        {
            return view('member.inbox',compact('messages'));
        }
        else if($role == 'admin')
        {
            return view('admin.inbox',compact('messages'));
        }

    }

    public function deleteMessage(Request $request)
    {
        $message = Message::find($request->message_id);
        $message->delete();
        $message->user()->detach();
        return redirect()->back();
    }

    public function sendMessage(Request $request)
    {
        $message = new Message();
        $message->user_id = $request->destination_user_id;
        $message->message = $request->message;
        $message->save();
        $message->user()->sync([session('user_id')]);

        return redirect()->back();
    }

    public function giveReputation(Request $request)
    {
        $rating = new Rating();

        $rating->score = $request->score;
        $rating->user_id = $request->id;
        $rating->save();
        $rating->user()->sync([session('user_id')]);
        return redirect()->back();
    }
}
