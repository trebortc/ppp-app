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
            'teacher_name' => $this->user->name,
            'teacher_lastname' => $this->user->lastname,
            'teacher_email' => $this->user->email,
            'teacher_phone' => $this->user->phone,
            'teacher_mobile' => $this->user->mobile,
            'teacher_sex' => $this->user->sex,
            'teacher_status' => $this->user->status,
            'degree' => $this->degree,
            'career' => $this->career->name,
            'career_id' => $this->career->id,
        ];
    }
}
