<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\VerifyEmail;

class VerifyEmailNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $url = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('فعال سازی حساب کاربری در ' . __('app.name'))
            ->greeting('سلام')
            ->line('این ایمیل جهت فعال سازی حساب کاربری شما ارسال شده است. برای انجام این کار کافیست روی دکمه زیر کلیک کنید.')
            ->action('تایید ایمیل', $url)
            ->salutation('تیم ' . __('app.name'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
