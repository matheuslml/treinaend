<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportMaterialResource extends JsonResource
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
            'discipline_id' => $this->discipline_id,
            'title' => $this->title,
            'link' => $this->link,
            'icon' => $this->icon,
            'order' => $this->order
        ];
    }
}
