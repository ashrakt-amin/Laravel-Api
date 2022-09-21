<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;

use Illuminate\Http\Request;
use App\Traits\responseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\postresource;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    use responseTrait;

    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('jwt.verify', ['except' => ['login', 'register']]);

    }
    
    public function index()
    {
        $posts = postresource::collection(Post::all()) ;
       
        if($posts){
            return $this->response($posts,200,'success');

        }else{
            return $this->response(null,404,'error');

        }
     
        
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $validator =Validator::make($request->all(),[
            'title'=>'required|max:255',
            'body'=>'required'
        ]);

        if($validator->fails()){

            return $this->response(null,404,$validator->errors());
        }else{
            $post =Post::create($request->all());
            return $this->response(new postresource($post),201,'post was saved');


        }

    }

   
    public function show($id)
    {
        
        $post =Post::find($id);
        
        if($post){
            return $this->response(new postresource($post),200,'success');

        }else{
            return $this->response(null,404,'this post not found ! sorry');

        }

    }

  
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        $post =Post::find($id);
        if($post){

            $validator =Validator::make($request->all(),[
                'title'=>'max:255',
            ]);
    
            if($validator->fails()){
    
                return $this->response(null,404,$validator->errors());

            }else{

                $post->update($request->all());
                return $this->response(new postresource($post),201,'post was updated');
    
            }
        }else{
            return $this->response(null,404,'this post not found ! sorry');

        }

        
      
        
    }

  
    public function destroy($id)
    {
        $post =Post::find($id);

        if($post){
            $post->delete();
            return $this->response(null,201,'post was deleted');
        }else{

            return $this->response(null,201,'post not found ');

        }


    }
}
