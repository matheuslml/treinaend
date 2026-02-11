<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegistrationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'person_id' => $this->person_id,
            'payment_form' => $this->payment_form,
            'payment_status' => $this->payment_status,
            'payment_value' => $this->payment_value,
            'code' => $this->code,
            'information' => $this->information,
            'qualification' => $this->qualification,
            'front_certificate' => $this->front_certificate,
            'back_certificate' => $this->back_certificate
        ];
    }
}
