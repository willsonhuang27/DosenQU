<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Thread;
use App\Category;


class MasterThreadController extends Controller
{
    //THREAD
    public function index()
    {
        $threads = Thread::paginate(5);
        return view('admin.master-thread',compact('threads'));
    }
    //CATEGORY
    public function categoryindex()
    {
        $categories = Category::get();
        return view('admin.master-category',compact('categories'));
    }

    public function categorystore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $category = new Category();
        $category->description = $request->get('name');
        $category->save();

        return redirect(url('/mscategory'));

    }

    public function categoryedit($id){
        $category = Category::find($id);
        return view('admin.master-category-edit',compact('category'));
    }

    public function categoryupdate(Request $request , $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

        $category = Category::find($id);
        $category->description = $request->get('name');
        $category->save();

        return redirect(url('/mscategory'));
    }

    public function categorydelete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect('/mscategory');
    }

}
