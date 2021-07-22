<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Administrative extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'administrative_id' => $this->id,
            'administrative' => $this->user,
            'faculty_id' => $this->faculty_id,
            'faculty' => $this->faculty->name,
        ];
    }
}
