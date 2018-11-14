<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewInboxMessage extends Notification
{
    use Queueable;

    protected $user;
    protected $coach;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, User $coach)
    {
        $this->user = $user;
        $this->coach = $coach;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->user->name . ' sent you a message')
            ->greeting('Hey ' . $this->coach->name . ', ' . $this->user->name . ' from ' . $this->user->country . ' sent you a message.')
            ->action('﻿You received a new message', url('/messages'))
            ->line('Feel free to reach out to our team with any questions at info@marleq.com.');
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
