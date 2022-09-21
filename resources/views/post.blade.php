@extends('layout')
@section('content')   
 <a class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#add">Add post</a>
      
        <div class="text-center mt-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">body</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $num=1;
                    @endphp
                    @foreach($posts as $post)
                    <tr>
                        <th scope="row">{{$num++}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}} </td>
                        <td>
                            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit{{$post->id}}">edit</a>
                            <a class="btn btn-danger"data-bs-toggle="modal" data-bs-target="#delete{{$post->id}}">Delete</a>
                        </td>
                    </tr>



                    <!-- edit Modal -->
                    <div class="modal fade" id="edit{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content modal-content-demo">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{$post->id}}</h5>
                                </div>

                                <div class="modal-body">
                                    <form action="{{route('post.update',$post->id)}}" method="POST" autocomplete="off">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}


                                        <input class="form-control  mt-3" value="{{$post->title}}" name="title" type="text" placeholder="name">

                                        <input class="form-control  mt-3" value="{{$post->body}}" name="body" type="text" placeholder="body">

                                        <button type="submit" class="btn btn-primary mt-3 mb-3">Edit</button>
                                    </form>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- main-content closed -->


                    <!-- delete Modal -->
                    <div class="modal fade" id="delete{{$post->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title  mt-3" id="exampleModalLabel">delete {{$post->title}}</h5>
                                </div>
                                <form action="{{route('post.destroy',$post->id)}}" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- add quiz -->
        <div class="modal" id="add">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Add New Post</h6>
                    </div>


                    <form method="post" action="{{route('post.store')}}">
                        @csrf
                        <div class="form-group mt-3">
                            <div class="form-group mt-3">
                                <input type="text" placeholder="post Title" name="title" required class="form-control">
                            </div>
                            <div class="form-group mt-3">
                                <input class="form-control" placeholder="post body" name="body" type="text" required>
                            </div>
                            <div class="text-center mt-3 mb-3">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                    </form>
                </div>
            </div>
       
@endsection