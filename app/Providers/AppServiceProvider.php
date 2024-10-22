<?php

namespace App\Providers;

use App\Repositories\SettingsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('فعال سازی حساب کاری در ' . __('app.name'))
                ->greeting('سلام')
                ->line('این ایمیل جهت فعال سازی حساب کاربری شما ارسال شده است. برای انجام این کار کافیست روی دکمه زیر کلیک کنید.')
                ->action('تایید ایمیل', $url)
                ->salutation('تیم ' . __('app.name'));
        });

        // Share the settings with all views
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $settings = SettingsRepository::first();
                $view->with('settings', $settings);
            }
        });
    }
}
