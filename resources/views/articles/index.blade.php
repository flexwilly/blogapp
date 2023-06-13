@extends('layouts.app')

@section('title','Blog App | Index')
@section("content")

<section class="mb-4 mt-4">
        <div class="container">
                <div class="row">
                        @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show col-md-12 m-auto mb-4">
                          {{ session()->get('message')}}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>        
                        @endif
                       <div class="col-md-12 m-auto mb-4">
                           <h2>All Articles
                                <a href="{{route('articles.create')}}" class="btn btn-primary float-end">Create Article</a>
                           </h2>
                       </div>
                </div>
                <div class="row">
                        <div class="col-md-6">
                        @foreach ($articles as $article)
                        <div class="card mb-3">
                                <img src="{{ asset('upload/'.$article->image)}}" class="card-img-top" alt="An example" height="400px" width="100%">
                                <div class="card-header">
                                     <h2>{{$article->title}}</h2>
                                </div>
                                <div class="card-body" id="main-article">
                                        <p>{{$article->description}}</p>
                                </div>
                                <div class="card-footer">
                                        <a href="{{route('articles.show',$article->id)}}">View Article</a>
                                </div>
                        </div>
                       
                        @endforeach
                </div>
                </div>
                <div class="row">
                        <div class="col-md-8 m-auto text-center">

                                {{$articles->withQueryString()->links('pagination::bootstrap-5')}}
                        </div>
                </div>
        </div>
</section>

@endsection