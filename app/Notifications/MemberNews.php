<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberNews extends Notification
{
    use Queueable;

    protected $user;
    protected $news;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($users, $news)
    {
        //
        $this->users = $users;
        $this->news = $news;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
                    // ->from(config('mail.from.address'))
                    // ->subject($this->user->name.'様へのご案内')
                    // ->markdown('emails.email_news', ['user' => $this->user, 'news' => $this->news]);
                    ->from(config('mail.from.address'))
                    ->subject($this->news['subject'])
                    ->markdown('emails.email_news', ['news' => $this->news]);
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
