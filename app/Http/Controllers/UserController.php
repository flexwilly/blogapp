<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */

     public function __construct(){
        //protect all routes from unwanted access
        $this->middleware(['auth','admin']);
        
    }  
    public function index()
    {
        //Get all users
        $users = User::all();
        return view("admin.users.index",compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Go to the create users page
        return view("admin.users.create");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role'=>'required',
        ]);

        User::create([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
        return redirect()->route("users.index")->with('message','User created successfully');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
        return view("admin.users.show",compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
        return view("admin.users.edit",compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role'=>'required',
        ]);

        $user->update([
            'name' =>  $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'id'=>$user->id,
        ]);
        return redirect()->route("users.index")->with('message','User updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        return redirect()->route("users.index")->with('message','User deleted successfully');
    }
}
