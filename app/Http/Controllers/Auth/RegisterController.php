<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    //redirect users after registration.
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    //handle register request(get and post)
    public function handleRegister(Request $request)
    {
        if ($request->isMethod('get')) {
            return $this->showRegistrationForm();
        } else {
            return $this->register($request);
        }
    }

    //Show the application registration form.
    public function showRegistrationForm()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectTo);
        }

        return view('auth.register');
    }

    //register user
    public function register(Request $request)
    {

        $this->validator($request->all())->validate();

        $user = $this->create($request->all());
        $this->guard()->login($user);

        //if resume tempalte and details are present in session redirect to resume preview page
        if ($request->session()->get('template') && $request->session()->get('resume_details')) {
            return redirect()->route('resume.resume_preview');
        }

        return redirect($this->redirectTo);
    }

    //Get the guard 
    protected function guard()
    {
        return Auth::guard();
    }

    //validator for an incoming request.
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    //Create a new user instance
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
