<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\BruteForceProtection;
use App\Services\CaptchaService;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Session\SessionManager;

class authController extends Controller
{
    protected $bruteForce;
    protected $captcha;

    public function __construct(BruteForceProtection $bruteForce, CaptchaService $captcha)
    {
        $this->bruteForce = $bruteForce;
        $this->captcha = $captcha;
    }

    public function login(){
        if(Auth::check()){
            return redirect(route('home'));
        }

        $ip = request()->ip();
        $shouldShowCaptcha = $this->bruteForce->shouldShowCaptcha($ip);
        
        if ($shouldShowCaptcha && !session()->has('captcha_question')) {
            $this->captcha->generateCaptcha();
        }

        return view('login', [
            'shouldShowCaptcha' => $shouldShowCaptcha,
        ]);
    }

    public function register(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }

    public function loginPost(Request $request){
        $ip = $request->ip();
        
        // Check if user is locked out
        if ($this->bruteForce->isLockedOut($ip)) {
            return back()->withErrors([
                'email_or_username' => 'Too many login attempts. Please try again in 15 minutes.',
            ])->onlyInput('email_or_username');
        }

        // Check if CAPTCHA is required
        if ($this->bruteForce->shouldShowCaptcha($ip)) {
            $request->validate([
                'email_or_username' => 'required|string',
                'password' => 'required|string',
                'captcha_answer' => 'required|string',
            ]);

            if (!$this->captcha->verifyCaptcha($request->input('captcha_answer'))) {
                $this->bruteForce->incrementAttempts($ip);
                return back()->withErrors([
                    'captcha_answer' => 'Incorrect CAPTCHA answer.',
                ])->onlyInput('email_or_username');
            }
        } else {
            $request->validate([
                'email_or_username' => 'required|string',
                'password' => 'required|string',
            ]);
        }

        $credentials = $request->only('email_or_username', 'password');
        $user = User::findByEmailOrUsername($credentials['email_or_username']);

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            $this->bruteForce->incrementAttempts($ip);
            return back()->withErrors([
                'email_or_username' => 'Invalid credentials',
            ])->onlyInput('email_or_username');
        }

        if (!$user->is_active) {
            return back()->withErrors([
                'email_or_username' => 'Your account is inactive. Contact an administrator.',
            ])->onlyInput('email_or_username');
        }

        // Reset attempts on successful login
        $this->bruteForce->resetAttempts($ip);
        Auth::login($user, $request->boolean('remember'));

        return redirect()->intended(route('dashboard'));
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
        return redirect(route('login'))->with("success","You have been logged out.");
    }
}
