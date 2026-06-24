<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Session\SessionManager;



class authController extends Controller
{

    public function login(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }

    public function register(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }

    public function loginPost(Request $request){
// Validate input (accept either email or username)
        $credentials = $request->validate([
            'email_or_username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::findByEmailOrUsername($credentials['email_or_username']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'email_or_username' => 'Invalid credentials',
            ])->onlyInput('email_or_username');
        }

        Auth::login($user, $request->boolean('remember'));


        return redirect()->intended('/dashboard');
    }

    public function registerPost(Request $request){
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8',
            'username' => ['required', 'string', 'max:255', 'min:4', Rule::unique('users', 'username')],
        ]); 

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['username'] = $request->username;
        $user = User::create($data);

        if(!$user){
            return redirect(route('register'))->with("error", "Register failed, try again");
        }
        return redirect(route('login'))->with("success","Registration success, Login to access the app");

    }

    public function logout(SessionManager $sessionManager){
        $sessionManager->flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
