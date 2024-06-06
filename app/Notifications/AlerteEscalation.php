<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\User;
use DB;

use Auth;

class AlerteEscalation extends Notification
{
    use Queueable;  
    public $user; 

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $user = session('userj');
        $actions = session('actionsj');
        $params = ["user" => $user, "actions" => $actions];
        return (new MailMessage)->view('mail.escalationAutomatique2', ['params' => $params]);
        /* return (new MailMessage)
                    ->subject('Bienvenue dans FNDGROUP')
                    ->line('Salut Mr {{$notifiable->nom}}, On est content que tu sois inscrit dans notre site.')
                    ->action('FNDGROUP', config('app.url'))
                    ->line('A Bientôt!'); */
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

