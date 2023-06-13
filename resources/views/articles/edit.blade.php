@extends('layouts.app')

@section('title','Blog App | Edit')
@section("content")
<section class="mb-4 mt-4">
        <div class="container">
                <div class="row">
                        <div class="col-md-8 m-auto">
                                <div class="card">
                                        <div class="card-header">
                                                <h2>Update Article
                                                        <a href="{{route('articles.index')}}" class="btn btn-danger float-end">Back</a>
                                                </h2>
                                        </div>
                                        <div class="card-body">
                                                <form action="{{route('articles.update',$article->id)}}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <!--Title-->      
                                                  <label for="title" class="form-label" >Title</label>
                                                  <input type="text" name="title" value="{{ old('title',$article->title)}}" id="title" class="mb-3 form-control @error('title') is-invalid @enderror" placeholder="Enter Title"/>
                                                  <div>
                                                        @error('title')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Description-->
                                                  <label for="Description" class="form-label">Description</label>
                                                  <textarea class="form-control mb-3 @error('description') is-invalid @enderror" name="description" rows="8"id="description">{{old('description',$article->description)}}</textarea>
                                                  <div>
                                                        @error('description')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Submit button-->
                                                  <button type="submit" class="form-control btn btn-success text-white"name="update">Update Article</button>
                                                </form>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</section>


@endsection