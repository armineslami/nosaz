<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends ResetPassword
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        $url = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject('بازیابی کلمه عبور حساب ' . __('app.name'))
            ->greeting('سلام')
            ->line('لطفا برای بازیابی کلمه عبور خود بر روی دکمه زیر کلیک کنید. اگر شما این درخواست را نداده‌اید، می‌توانید این ایمیل را نادیده بگیرید.')
            ->action('بازیابی کلمه عبور', $url)
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
