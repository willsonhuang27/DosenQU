<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Redirect;
use App\Thread;
use App\Category;
use App\Post;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
class ThreadController extends Controller
{
    public function create()
    {
    	$categories = Category::get();

        if(session('role') == 'member')
        {
            return view('member.thread-add',compact('categories'));
        }
        else if(session('role') == 'admin')
        {
            return view('admin.thread-add',compact('categories'));
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $thread = new Thread;
        $thread->name = $request->name;
        $thread->description = $request->description;
        $thread->category_id = $request->category;
        $thread->status = 1;
        $thread->save();
        $user_id = Session('user_id');
        $thread->user()->sync([$user_id]);

        if(session('role') == 'member')
        {
            return redirect('member/');
        }
        else if(session('role') == 'admin')
        {
            return redirect('admin/');
        }
    }

    public function show(){

        return view('thread-view');
    }

    public function threadShow(Request $request){
        $thread = Thread::where('id','=',$request->id)->first();
        $posts = Post::where('thread_id','=',$request->id)->paginate(5);
        $role = session('role','guess');

        if($role == 'guess')
        {
            return view('thread-view',compact('thread','posts'));
        }
        else if($role == 'member')
        {
            return view('member.thread-view',compact('thread','posts'));
        }
        else if($role == 'admin')
        {
            return view('admin.thread-view',compact('thread','posts'));
        }
    }

    public function redirectToFilter(Request $request){

        $role = session('role','guess');

        if($role == 'guess')
        {
            return redirect(url('thread/'.$request->id.'/'.$request->keyword));
        }
        else if($role == 'member')
        {
            return redirect(url('member/thread/'.$request->id.'/'.$request->keyword));
        }
        else if($role == 'admin')
        {
            return redirect(url('admin/thread/'.$request->id.'/'.$request->keyword));
        }
    }

    public function threadShowWithFilter(Request $request){
        $thread = Thread::where('id','=',$request->id)->first();
        $posts = Post::where('thread_id','=',$request->id)->where('description','like','%'.$request->keyword.'%')->orWhereHas('user',function( $query ) use ($request) {
                $query->where('name','like','%'.$request->keyword.'%');
            })->paginate(5);
        $keyword = $request->keyword;
        $role = session('role','guess');
        
        if($role == 'guess')
        {
            return view('thread-view',compact('thread','posts','keyword'));
        }
        else if($role == 'member')
        {
            return view('member.thread-view',compact('thread','posts','keyword'));
        }
        else if($role == 'admin')
        {
            return view('admin.thread-view',compact('thread','posts','keyword'));
        }
    }

    public function addPost(Request $request)
    {
        $post = new Post;
        $post->description = $request->post;
        $post->thread_id = $request->thread_id;
        $post->save();
        $post->user()->sync([session('user_id')]);

        return redirect()->back();
    }

    public function deletePost(Request $request)
    {
        $post = Post::find($request->id);
        $post->delete();

        return redirect()->back();
    }

    public function editPostview(Request $request)
    {
        $post = Post::where('id','=',$request->id)->first();

        $role = session('role','guess');
        if($role == 'member')
        {
            return view('member.thread-post-update',compact('post'));
        }
        else if($role == 'admin')
        {
            return view('admin.thread-post-update',compact('post'));
        }
    }

    public function editPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $post = Post::find($request->id);
        $post->description = $request->description;
        $post->save();

        return redirect()->back();
    }

    public function getMyThread(Request $request)
    {
        $threads = Thread::WhereHas('user',function( $query ) use ($request) {
                $query->where('id','=',session('user_id'));
            })->paginate(5);

        $role = session('role','guess');

        if($role == 'member')
        {
            return view('member.thread-myForum',compact('threads'));
        }
        else if($role == 'admin')
        {
            return view('admin.thread-myForum',compact('threads'));
        }

        
    }

    public function closeThread(Request $request)
    {
        $thread = Thread::find($request->id);
        $thread->status = 0;
        $thread->save();

        return redirect()->back();
    }

    public function editThreadView(Request $request)
    {
        $thread = Thread::where('id','=',$request->id)->first();
        $categories = Category::get();

        $role = session('role','guess');

        if($role == 'member')
        {
            return view('member.thread-update',compact('thread','categories'));
        }
        else if($role == 'admin')
        {
            return view('admin.thread-update',compact('thread','categories'));
        }
    }

    public function editThread(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $thread = Thread::find($request->id);
        $thread->name = $request->name;
        $thread->description = $request->description;
        $thread->category_id = $request->category;
        $thread->save();

        $role = session('role','guess');
        
        if($role == 'member')
        {
            return redirect(url('member/myforum'));
        }
        else if($role == 'admin')
        {
            return redirect(url('admin/myforum'));
        } 
    }
}
