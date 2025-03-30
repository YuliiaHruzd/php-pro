<?php

namespace App\Listeners;

use App\Email\InvoiceEmail;
use App\Events\OrderProcessed;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendOrderNotification
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
    public function handle(OrderProcessed $event): void
    {
        $fileName = $event->order->id . '.pdf';
        $url = storage_path() . "/app/private/$fileName";
        $users = User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new InvoiceEmail($url));
        }
    }
}
