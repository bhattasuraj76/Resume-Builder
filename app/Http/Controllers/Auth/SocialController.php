<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Socialite;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();

        //create user if not present in records
        if (!$user) {
            $user = User::create([
                'email'  => $userSocial->getEmail(),
            ]);
        }

        Auth::login($user);

        //if resume tempalte and details are present in session redirect to resume preview page
        if (session()->get('template') && session()->get('resume_details')) {
            return redirect()->route('resume.resume_preview');
        }

        return redirect('/');
    }
}
