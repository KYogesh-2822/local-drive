<?php

namespace App\Listeners;

use App\Events\CareerNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;
use App\Mail\applyJob;

class FormSubmitConfirmation
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
    public function handle(CareerNotification $event): void
    {
        $noti = $event->notifi;
        $mailData = [
            'title' => 'Application submitted',
            'body' => 'This is for testing email using smtp.'
        ];
        $userEmail = $noti['userEmail'];
        $adminEmail = $noti['adminEmail'];

        Mail::to($userEmail)->send(new applyJob($mailData));  
        Mail::to($adminEmail)->send(new applyJob($mailData));  
    }
}
