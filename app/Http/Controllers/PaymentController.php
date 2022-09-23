<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Events\PaymentCreated;
use App\Http\Resources\PaymentResource;
use App\Http\Requests\StorePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePaymentRequest $request)
    {
        $payload = $request->validated();
        $payment = Payment::create($payload);
        event(new PaymentCreated($payment));
        return new PaymentResource($payment);
    }

    /**
     * "Get all the payments for a given client."
     *
     * The function is a public function, so it can be called from outside the class. It takes a single
     * argument, a Client object. It returns a collection of PaymentResource objects
     *
     * @param Client client The client object that we're getting the payments for.
     *
     * @return A collection of payments for the client.
     */
    public function getPaymentsByClient(Request $request)
    {
        if (!$request->has('client')) {
            return 'Client is required.';
        }

        $client = Client::findOrFail($request->client);

        if (!$client) {
            return 'Client not found.';
        }

        return PaymentResource::collection($client->payments);
    }
}
