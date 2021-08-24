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
            'administrative_name' => $this->user->name,
            'administrative_lastname' => $this->user->lastname,
            'administrative_email' => $this->user->email,
            'administrative_phone' => $this->user->phone,
            'administrative_mobile' => $this->user->mobile,
            'administrative_sex' => $this->user->sex,
            'administrative_status' => $this->user->status,
            'faculty_id' => $this->faculty_id,
            'faculty' => $this->faculty->name,
        ];
    }
}
