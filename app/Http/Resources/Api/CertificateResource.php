<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CertificateResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'registration' => $this->registration,
            'cpf' => $this->cpf,
            'position' => $this->position,
            'url_certificate' => $this->url_certificate,
            'url_logo' => $this->url_logo,
            'url_signature' => $this->url_signature,
            'status' => $this->status
        ];
    }
}
