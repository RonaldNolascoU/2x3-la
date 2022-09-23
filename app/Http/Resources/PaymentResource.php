<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'uuid' => $this->uuid,
            'payment_date' => $this->payment_date,
            'expires_at' => $this->expires_at,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'clp_usd' => $this->clp_usd,
        ];
    }
}
