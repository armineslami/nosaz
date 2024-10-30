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
use Illuminate\View\View;

class OAuthController extends Controller
{
    public function redirectToGoogle(): RedirectResponse
    {
        try {
            return Socialite::driver('google')->redirect();
        } catch (\Exception) {
            return redirect()->intended();
        }
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

    public function redirectToTelegram(): View|RedirectResponse
    {
        return view('auth.telegram');
        // return Socialite::driver('telegram')->redirect();
        // return redirect()->to('https://oauth.telegram.org/auth?bot_id=8001536470&origin=http://127.0.0.1&return_to=http://127.0.0.1/oauth/telegram/callback');

    }

    public function callbackFromTelegram(): RedirectResponse
    {
        try {
            $oAuthUser = Socialite::driver('telegram')->user();
            if (!empty($oAuthUser)) {
                $user = UserRepository::updateOrCreate([
                    'telegram_id' => $oAuthUser->id,
                ], [
                    'name' => $oAuthUser->name,
                    'email' => $oAuthUser->nickname . '@telegram.org',
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
        try {
            return self::xApi()->redirect();
        } catch (\Exception) {
            return redirect()->intended();
        }
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

                return redirect()->route('home');
            }

            return redirect()->route("/login");
        } catch (\Exception) {
            return redirect()->intended();
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
