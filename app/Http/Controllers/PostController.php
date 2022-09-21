<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
   
    public function index()
    {
        $posts =Post::all();
        return view('post',compact('posts'));
    }

    public function store(Request $request)
    {
       $request->validate([
        'title'=>'required|max:255',
        'body'=>'required',

       ]);
       Post::create([
        'title'=>$request->title,
        'body'=>$request->body

       ]);
       return redirect()->back();

    }

 
   
    public function update(Request $request,$id)
    {
       $post = Post::findOrFail($id);
       $post->update($request->all());
       return redirect()->back();

    }

    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back();

    }
}
