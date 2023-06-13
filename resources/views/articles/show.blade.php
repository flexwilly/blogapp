@extends('layouts.app')

@section('title','Blog App | Show')
@section("content")
<section class="mt-4 mb-4">
        <div class="container">
        <div class="row">
               
                        <div class="col-md-6 m-auto">
                                <div class="card">
                                        <img src="{{ asset('upload/'.$article->image)}}" class="card-img-top" alt="An example" height="400px" width="100%">
                                        <div class="card-header">
                                                <h2>{{$article->title}}</h2>
                                        </div>
                                        <div class="card-body">
                                                <div class="row mb-3">
                                                        <p>{{$article->description}}</p>  
                                                </div>
                                                <div class="row mb-3">
                                                        <h3 class="text-ecnter">Comments: </h3>
                                                        <ul class="list-group list-group-flush">
                                                                @foreach ($comments as $comment)
                                                                <small>{{$comment->name}}</small>        
                                                                <li class="list-group-item">{{$comment->comment_desc}}, {{date('d-M-Y', strtotime($comment->created_at))}}
                                                                </li>
                                                                @endforeach
                                                              </ul>
                                                </div>
                                        </div> 

                                        <div class="card-footer">
                                        <a class="btn btn-success float-left m-1"href="{{route('articles.edit',$article->id)}}">Update Article</a>
                                        <form action="{{route('articles.destroy',$article->id)}}" method="post" >
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" name="delete" class="btn btn-danger  m-1" onclick="return confirm('Are You Sure');">Delete Article</button>
                                        </form>       
                                        </div> 
                                </div>
                        </div>
                
        </div>
        </div>

</section>
@endsection