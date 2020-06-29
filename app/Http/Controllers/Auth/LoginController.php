<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{

    //redirect users after login.
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    //handle request(get and post)
    public function handleLogin(Request $request)
    {
        if ($request->isMethod('get')) {
            return $this->showLoginForm();
        } else {
            return $this->login($request);
        }
    }

    //show login form
    public function showLoginForm()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectTo);
        }

        return view('auth.login');
    }

    //login user to the system
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only('email', 'password');
        if ($this->guard()->attempt($credentials, $request->filled('remember'))) {
            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    //logout user from system
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect($this->redirectTo);
    }

    //handle successful user login
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        //if resume tempalte and details are present in session redirect to resume preview page
        if ($request->session()->get('template') && $request->session()->get('resume_details')) {
            return redirect()->route('resume.resume_preview');
        }
        return redirect()->intended($this->redirectTo);
    }

    //handle failed user login
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => 'Invalid email or password',
        ]);
    }

    //validate login credentials
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    }

    //get guard to be used for login
    protected function guard()
    {
        return Auth::guard();;
    }
}
