<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserWelcome extends Notification
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
        if($this->user->hasRole('user')) {
            return (new MailMessage)
                ->subject('Welcome to MARLEQ!')
                ->line($this->user->name . ' we\'re delighted to have you on board!')
                ->line('You have joined hundreds of job seekers worldwide who use and love MARLEQ.')
                ->action('Find your Coach', url('/find-a-coach'))
                ->line('If you have any questions regarding your account, please contact us at 
                    support@marleq.com. Our technical support team will assist you with anything you need.')
                ->line('Best of luck with your job search and career progress, and welcome!');
        }

        if($this->user->hasRole('coach')) {
            return (new MailMessage)
                ->subject('Welcome to MARLEQ!')
                ->line($this->user->name . ' we\'re delighted to have you on board!')
                ->line('﻿Being a career coach on MARLEQ allows you to have more international impact and clients.')
                ->line('Start by updating your profile information and after you have completed your profile one of our country managers will contact you.')
                ->action('Update your profile', url('/user/profile/' . $this->user->alias . '/edit'))
                ->line('If you have any questions regarding your account, please contact us at 
                    support@marleq.com. Our technical support team will assist you with anything you need.')
                ->line('Best of luck with your client acquisition and welcome!');
        }

        if($this->user->hasRole('country-manager')) {
            return (new MailMessage)
                ->subject('Welcome to MARLEQ!')
                ->line($this->user->name . ' we\'re delighted to have you on board!')
                ->line('You have joined a worldwide group of career leaders and enthusiasts.')
                ->line('Start by updating your profile information and after you have completed your profile one of our country managers will contact you.')
                ->action('Update your profile', url('/user/profile/' . $this->user->alias . '/edit'))
                ->line('If you have any questions regarding your account, please contact us at 
                    support@marleq.com. Our technical support team will assist you with anything you need.')
                ->line('Best of luck with your activities and welcome!');
        }
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
