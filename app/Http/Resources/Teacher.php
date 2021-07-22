<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Teacher  extends JsonResource
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
            'teacher_id' => $this->id,
            'teacher' => $this->user,
            'degree' => $this->degree,
            'career' => $this->career->name,
            'career_id' => $this->career->id,
        ];
    }
}
