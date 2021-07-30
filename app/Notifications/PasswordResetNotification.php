<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword;

class PasswordResetNotification extends ResetPassword
{
    use Queueable;

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        return (new MailMessage)
            ->from(config('mail.from.address'))
            ->subject('パスワードリセットのお知らせ')
            ->view('auth.passwords.password_reset', [
                'reset_url' => url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false))
            ]);

        // return (new MailMessage)
        //     ->from(config('mail.from.address'))
        //     ->subject('パスワードリセットのお知らせ')
        //     ->line('このメールは、お客様のパスワードリセットの申請があったため、お送りしています。')
        //     ->action('パスワードをリセットする', url(config('app.url').route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false)))
        //     ->line('このパスワードリセット用のリンクは、:count 分で失効します。', ['count'=>config('auth.passwords.'.config('auth.defaults.passwords').'.expire')])
        //     ->line('もしお客様がパスワードリセットを申請されなかった場合は、何もアクションの必要はございません。');
        
    }

}
