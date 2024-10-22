<?php

namespace App\Http\Controllers\Auth\OAuth;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use League\OAuth1\Client\Server\Twitter;

class OAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle(): RedirectResponse
    {
        try {
            $oAuthUser = Socialite::driver('google')->user();
            if (!empty($oAuthUser)) {
                $user = UserRepository::updateOrCreate([
                    'google_id' => $oAuthUser->id,
                ], [
                    'name' => $oAuthUser->name,
                    'email' => $oAuthUser->email,
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(8)),
                ]);

                Setting::updateOrCreate([
                    'user_id' => $user->id
                ]);

                Auth::login($user, true);

                return redirect()->route('/dashboard');
            }

            return redirect()->route("/login");
        } catch (\Exception) {
            return redirect()->intended();
        }
    }

    public function redirectToTwitter(): RedirectResponse
    {
        return self::xApi()->redirect();
    }

    public function callbackFromTwitter(): RedirectResponse
    {
        try {
            $oAuthUser = self::xApi()->user();

            if (!empty($oAuthUser)) {
                $user = UserRepository::updateOrCreate([
                    'twitter_id' => $oAuthUser->getId(),
                ], [
                    'name' => $oAuthUser->getName(),
                    'email' => $oAuthUser->getEmail(),
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(50)),
                    //                    'avatar_url' => $oAuthUser->getAvatar(),
                    'twitter_token' => $oAuthUser->token,
                    'twitter_refresh_token' => $oAuthUser->refreshToken,
                ]);

                Setting::updateOrCreate([
                    'user_id' => $user->id
                ]);

                Auth::login($user, true);

                return redirect()->route('dashboard');
            }

            return redirect()->route("/login");
        } catch (\Exception) {
            return redirect()->route('oauth.error');
        }
    }

    private function xApi(): \Laravel\Socialite\Contracts\Provider
    {
        /**
         * Check urlAuthorization method in {@link Twitter}.
         * Because x does not return email for oAuth v2, the above method is modified to use v1.
         */
        //        return Socialite::driver('twitter-oauth-2');
        return Socialite::driver('twitter');
    }

}
