@extends('layouts.app')

@section('title','Blog App | Create')
@section("content")
<section class="mb-4 mt-4 p-0">
        <div class="container">
                <div class="row">
                        <div class="col-md-9 m-auto">
                               
                                   <div class="card">
                                        <div class="card-header">
                                                <h1 class="text-center text-dark">Write Article
                                                <a href="{{route('articles.index')}}" class="btn btn-danger float-end">Back</a>
                                        </h1>
                                        </div>
                                        <div class="card-body">
                                                <form enctype="multipart/form-data" action="{{route('articles.store')}}" method="POST">
                                                  @csrf
                                                  <!--Title-->      
                                                  <label for="title" class="form-label" >Title</label>
                                                  <input type="text" name="title" value="{{ old('title')}}" id="title" class="mb-3 form-control @error('title') is-invalid @enderror" placeholder="Enter Title"/>
                                                  <div>
                                                        @error('title')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Description-->
                                                  <label for="Description" class="form-label">Description</label>
                                                  <textarea class="form-control mb-3 @error('description') is-invalid @enderror" name="description" rows="8"id="description">{{old('description')}}</textarea>
                                                  <div>
                                                        @error('description')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Image-->
                                                  <label for="Image" class="form-label">Image</label>
                                                  <input class="form-control mb-3 @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/*"/>
                                                  <div>
                                                        @error('image')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Submit button-->
                                                  <button type="submit" class="form-control btn btn-primary text-white"name="create">Create Article</button>
                                                </form>
                                        </div>
                                   </div>
                                
                        </div>
                </div>
        </div>
</section>

@endsection