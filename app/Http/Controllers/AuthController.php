<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Display Registration Page
    public function showRegister(){
        return view('register');
    }

    public function register(Request $request){

        //Select * from users where email = '$email'
        // This checks if email already exists and execute this if this true
        if(User::where('email', $request->email)->exists()){
            return back()->with('error', 'Email already exists!');
        }

        // This checks if the password is not equal to the confirm password
        if($request->password !== $request->confirmpassword){
            return back()->with('error', 'Passwords do not match!');
        }

        // Insert into users table
        User::create([
            'name' => $request->fullname,
            'email' => $request->email,
            'password'=> Hash::make($request->password)
        ]);

        return back()->with('success', 'Account successfully created!');
    }

    public function showLogin(){
        return view('login');
    }

    public function login(Request $request){

        // Select * from users where email = '$email'
        $user = User::where('email', $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password) ){
            return back()->with('error', 'Invalid credentials!');
        }

        session(['user' => $user]);

        return redirect('/dashboard')->with('success', 'Login successfull'); 

    }

    public function logout(){
        session()->forget('user');
        return redirect('/login')->with('success', 'Logged-out successfully!');
    }

    
}
