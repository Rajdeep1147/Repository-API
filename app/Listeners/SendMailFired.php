<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\Student;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendMail $event): void
    {
        $user = Student::find($event->userId)->toArray();
        Mail::send('email.eventMail',$user,function($message) use($user)
        {
            $message->to($user['email']);
            $message->subject("Event Testing");

        });
    }
}
