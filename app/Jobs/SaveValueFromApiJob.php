<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\PaymentConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SaveValueFromApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $payment;

    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->payment->payment_date) {
            return;
        }

        $paymentSameDay = Payment::whereDate('payment_date', $this->payment->payment_date)->where('clp_usd', '>', 0)
                        ->get();

        if (count($paymentSameDay) > 0) {
            $usdValue = $paymentSameDay[0]->clp_usd;
        } else {
            $data = file_get_contents('https://mindicador.cl/api/dolar');
            $data = json_decode($data);
            $usdValue = collect($data->serie)->where('fecha', '>', Carbon::parse($this->payment->payment_date))->first();
            $usdValue = $usdValue->valor;
        }

        $this->payment->clp_usd = $usdValue;
        $this->payment->save();
    }
}
