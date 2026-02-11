<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExerciseResource extends JsonResource
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
            'file' => $this->file,
            'answers' => $this->answers,
            'correct_answer' => $this->correct_answer,
            'type' => $this->type
        ];
    }
}
