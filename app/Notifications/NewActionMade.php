<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewActionMade extends Notification
{
    use Queueable;


	protected $action;
	protected $user;
	protected $link;
	protected $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($action,$user,$link,$type)
    {
       $this->action=$action;
	   $this->user=$user;
	   $this->link=$link;
	   $this->type=$type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'data' => $this->user->name .' ' .$this->action,
            'link' => $this->link,
            'type' => $this->type
        ];
    }
}
