<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;


class ProfileController extends Controller
{
    //constructor
    public function __construct(){
        $this->middleware('auth');
    }
    //
    public function edit(Request $req){
        //get current user
        $user = $req->user(); //Auth::user()
        return view('auth.profile',compact('user'));
    }

    public function update(Request $req){
        //get current user
       $currentUser = $req->user();
       //validation for user input
       
       $req->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'. $currentUser->id],
        'password' => ['required_with:password_confirmation', 'confirmed'],
        'current_password'=>['required_with:password', function($attribute, $value,$fail) use($req){
            $currentUser = $req->user();
            if( !empty($req->password) &&!Hash::check($value,$currentUser->password)){
                return $fail("Current Password Does Not Match");
            }
        }],
       ]);
       //dd('update-profile');
       $currentUser->name = $req->name;
       $currentUser->email = $req->email;
       //if password is not empty
       if(!empty($req->password)){
           $currentUser->password = Hash::make($req->password);
       }
       $currentUser->save();
       return redirect()->back()->with('success','Profile updated successfully');
    }
}
