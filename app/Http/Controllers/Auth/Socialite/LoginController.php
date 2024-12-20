<?php

namespace App\Http\Controllers\Auth\Socialite;

use App\Models\User;
use App\Models\UserDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $authUser = $this->findOrCreateUser($user, 'google');
        Auth::login($authUser, true);

        return redirect()->intended('dashboard');
    }

    protected function findOrCreateUser($socialUser, $provider)
    {
        $authUser = User::where('provider_id', $socialUser->getId())
            ->where('provider', $provider)
            ->first();

        if ($authUser) {
            return $authUser;
        }

        $user = User::create([
            'name' => $socialUser->getName(),
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'role_id' => User::ROLE_USER,
            'email_verified_at' => now(),
        ]);

        UserDetail::create([
            'user_id' => $user->id
        ]);

        return $user;
    }
}
