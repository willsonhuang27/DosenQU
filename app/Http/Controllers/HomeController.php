<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $threads = Thread::with('category')->paginate(5);
        $role = session('role','guess');
        if($role == 'guess')
        {
            return view('home',compact('threads'));
        }
        else if($role == 'member')
        {
            return view('member.home',compact('threads'));
        }
        else if($role == 'admin')
        {
            return view('admin.home',compact('threads'));
        }
    }
    public function indexFilter(Request $request)
    {
        $threads = Thread::where('description','like','%'.$request->keyword.'%')->orWhereHas('category',function( $query ) use ($request) {
                $query->where('description','like','%'.$request->keyword.'%');
            })->paginate(5);

        $role = session('role','guess');
        $keyword = $request->keyword;
        if($role == 'guess')
        {
            return view('home',compact('threads','keyword'));
        }
        else if($role == 'member')
        {
            return view('member.home',compact('threads','keyword'));
        }
        else if($role == 'admin')
        {
            return view('admin.home',compact('threads','keyword'));
        }
    }
    public function returnHome(Request $request)
    {
        $role = session('role','guess');

        if($role == 'guess')
        {
            return redirect(url('find/'.$request->keyword));
        }
        else if($role == 'member')
        {
            return redirect(url('member-/'.$request->keyword));
        }
        else if($role == 'admin')
        {
            return redirect(url('admin-/'.$request->keyword));
        }
    }
}
