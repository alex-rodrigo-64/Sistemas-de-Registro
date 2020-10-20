<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PostNotificacion;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use App\User;

use Carbon\Carbon;

class PostListerner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //

          /*
        //User::all()
        //->except($post->user_id)
        //->each(function(User $user) use ($post){
         //   $user->notify(new  PostNotification($post));
       // });
        */
        //Aumentado codigo
        $valor=0;
        $dia = Carbon::now(); 
       // if($dia->isoFormat('dddd')=='Monday') {

            //Condigo para enviar notificaciones dentro la interfaz
            User::all()
           // ->except($event->post->user_id)
            ->each(function(User $user) use ($event){
                Notification::send($user, new PostNotificacion($event->post));
               // Notification::send($users, new InvoicePaid($invoice));
    
            });
             //codigo para enviar correos
             /*
            //Mail::send('emails.primeiro',[], function($message){ 
             
                $enderecos = ['almanzaisrael75@gmail.com','chevycheluis@gmail.com'];
                 
                $message->to($enderecos);
                $message->subject('Notificacion');
           // });
              */ 
              
              $users = User::all();

              foreach($users as $user){
                Mail::send('emails.primeiro',['user' => $user ], function($message) use ($user){ 
             
                    //$enderecos = ['almanzaisrael75@gmail.com','chevycheluis@gmail.com'];
                     
                    $message->to($user->email);
                    $message->subject('Notificacion');
                }); 
                  
              } 

          
        

       // }
      
    }
}
