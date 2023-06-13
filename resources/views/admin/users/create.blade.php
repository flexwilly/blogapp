@extends('layouts.app')

@section('title','Blog App | Create User')
@section("content")
<section class="mb-4 mt-4 p-0">
        <div class="container">
                <div class="row">
                        <div class="col-md-9 m-auto">
                               
                                   <div class="card">
                                        <div class="card-header">
                                                <h1 class="text-center text-dark">Create User
                                                <a href="{{route('users.index')}}" class="btn btn-danger float-end">Back</a>
                                        </h1>
                                        </div>
                                        <div class="card-body">
                                                <form enctype="multipart/form-data" action="{{route('users.store')}}" method="POST">
                                                  @csrf
                                                  <!--Title-->      
                                                  <label for="title" class="form-label" >Name</label>
                                                  <input type="text" name="name" value="{{ old('name')}}" id="name" class="mb-3 form-control @error('name') is-invalid @enderror" placeholder="Enter Name"/>
                                                  <div>
                                                        @error('name')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Email-->      
                                                  <label for="email" class="form-label" >Email</label>
                                                  <input type="email" name="email" value="{{ old('email')}}" id="email" class="mb-3 form-control @error('email') is-invalid @enderror" placeholder="Enter Email"/>
                                                  <div>
                                                        @error('email')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                  <!--Password-->      
                                                  <label for="password" class="form-label" >Password</label>
                                                  <input type="password" name="password" value="{{ old('password')}}" id="password" class="mb-3 form-control @error('password') is-invalid @enderror" placeholder="Enter Email"/>
                                                  <div>
                                                        @error('password')
                                                        <small class="text-danger">{{$message}}</small>
                                                        @enderror
                                                  </div>
                                                
                                                  <!--Roles--->
                                                  <label for="title" class="form-label" >Roles</label>
                                                  <select class="form-select form-select-sm mb-3" name="role" aria-label=".form-select-sm example"> 
                                                       <option value="1">Admin</option>
                                                       <option value="2">Author</option>
                                                  </select>
                                                <!--Submit button-->
                                                  <button type="submit" class="form-control btn btn-primary text-white"name="create">Create User</button>
                                                </form>
                                        </div>
                                   </div>
                                
                        </div>
                </div>
        </div>
</section>

@endsection