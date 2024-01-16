<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Session\SessionManager;



class authController extends Controller
{
    function login(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    function register(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Invalid Credentials");
    }

    function registerPost(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]); 

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user =User::create($data);

        if(!$user){
            return redirect(route('register'))->with("error", "Register failed, try again");
        }
        return redirect(route('login'))->with("success","Registration success, Login to access the app");

    }

    function logout(SessionManager $sessionManager){
        $sessionManager->flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
