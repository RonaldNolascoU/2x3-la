<?php

namespace App\Listeners;

use App\Models\ActivityLog;
use App\Jobs\SaveValueFromApiJob;
use App\Notifications\PaymentConfirmation;

class SaveValueAfterPayment
{
    /**
     * @param object $event
     */
    public function handle($event)
    {
        SaveValueFromApiJob::dispatch($event->payment);

        $client = $event->payment->client;

        $client->notify(new PaymentConfirmation());
    }
}
