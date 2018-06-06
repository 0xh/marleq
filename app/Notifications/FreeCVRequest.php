<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class FreeCVRequest extends Notification
{
    use Queueable;

    protected $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    /**
     * Get the slack representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\SlackMessage
     */
    public function toSlack($notifiable)
    {
        return (new SlackMessage())
            ->success()
            ->content('New Request for Free CV Check!')
            ->attachment(function($attachment) {
               $attachment->title($this->user->name . ' ' . $this->user->surname . ' from ' . $this->user->country)
                   ->fields([
                       'Countries' => $this->user->countries->implode('name', ', '),
                       'Languages' => $this->user->languages->implode('name', ', ')
                   ]);
            });
    }
}
