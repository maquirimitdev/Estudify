<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ForgotPasswordManager extends Controller
{
    function forgetpassword(){
        return view('forget-password');
    }
    function forgetpasswordpost(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send("emails.forget-password", ['token' => $token], function ($message) use ($request){
                $message->to($request->email);
                $message->subject('Reset Password');
        });

        return redirect()->to(route('forget.password'))->with('success', 'We have sent an email to reset password');
    }

    function resetpassword($token){
        return view("new-password", compact('token'));
    }

    function resetpasswordpost(Request $request){

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatepassword = DB::table('password_resets')
        ->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();

        if(!$updatepassword){
            return redirect()->to(route('reset.password.post'))->with('error', 'Invalid');
        }

        User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return redirect()->to(route('login'))->with('sucess', 'Password reset success');
    }
}
