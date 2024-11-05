<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Models\Payment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CreatePaymentAfterRegistration
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
    public function handle(UserRegistered $event): void
    {
        Payment::create([
            'user_id' => $event->user->id,
        ]);
    }
}
