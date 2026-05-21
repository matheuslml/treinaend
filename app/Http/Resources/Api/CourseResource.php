<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'slug' => $this->slug,
            'acronym' => $this->acronym,
            'description' => $this->description,
            'order' => $this->order,
            'grade' => $this->grade,
            'payment_value' => $this->payment_value,
            'certificate_file' => $this->certificate_file,
            'image_card' => $this->image_card,
            'image_banner' => $this->image_banner,
            'image_conclusion' => $this->image_conclusion,
            'type' => $this->type,
            'excerpt' => $this->excerpt,
            'body' => $this->body,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'status' => $this->status
        ];
    }
}