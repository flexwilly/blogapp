@extends("layouts.app")

@section('title','Blog App | All Users')

@section('content')
<section class="mb-4 mt-4">
<div class="container">
        <div class="row">
                @if(session()->has('message'))
                <div class="alert alert-success">
                  {{ session()->get('message')}}
                </div>        
                @endif
                <div class="col-md-9 m-auto">
                <tr>
                        <a href="{{route('users.create')}}" class="btn btn-warning mb-4 float-end text-white">Add User</a>
                </tr>               
                <table class="table table-striped border border-dark text-center">
                        <thead>
                                <tr >
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Role</th>
                                        <th colspan="2">Actions</th>
                                </tr>
                        </thead>
                        <tbody>
                                @foreach ($users as $u)        
                                <tr>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->email}}</td>
                                        <td>{{$u->role}}</td>
                                        <td><a href="{{route('users.edit',$u->id)}}" class="btn btn-success">Update</a></td>
                                        <td><form action ="{{ route("users.destroy",$u->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                </tr>        
                                @endforeach
                        </tbody>
        
                </table>
                </div>
        </div>
</div>


</section> 


@endsection
