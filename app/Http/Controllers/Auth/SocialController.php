<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Socialite;

class SocialController extends Controller
{

    public function redirect($provider)
    {
        if ($provider == 'google') return Socialite::driver('google')->scopes(['email'])->redirect();

        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {

        try {
            $user = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser                    = new User;
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->save();

            auth()->login($newUser, true);
        }

        return redirect($this->redirectPath());
    }
}
