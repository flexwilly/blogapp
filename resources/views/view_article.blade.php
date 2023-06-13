@extends('layouts.app')

@section('title','Blog App | View Article')

@section('content')
<section class="mt-4 mb-4">
        <div class="container">
         <div class="row mb-3">
                @if(session()->has('message'))
                <div class="alert alert-success alert-dismissible fade show col-md-6 m-auto">
                  {{ session()->get('message')}}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>        
                @endif
         </div>       
        <div class="row">
               <a href="{{url('/')}}" class="text-center">Back</a>
             

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
                                                <form action="{{ route('viewArticle', $article->id)}}" method="post">
                                                 @csrf
                                                 <label for="Comments">Comment :</label>
                                                 <input type="text" class="mb-3 form-control " name="comment" id="" placeholder="Write a comment"/>
                                                 <button type="submit" class="btn btn-secondary">Comment</button>       
                                                </form>
                                        </div>
                                </div>
                        </div>
                
        </div>
        </div>

</section>

@endsection
