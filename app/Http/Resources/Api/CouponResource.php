<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
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
            'course_id' => $this->course_id,
            'title' => $this->title,
            'slug' => $this->slug,
            'observation' => $this->observation,
            'code' => $this->code,
            'amount' => $this->amount,
            'discount_percentage' => $this->discount_percentage,
            'started_at' => $this->started_at,
            'finished_at' => $this->finished_at,
            'status' => $this->status
        ];
    }
}
