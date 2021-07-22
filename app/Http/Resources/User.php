<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Student as StudentResource;
use App\Http\Resources\Teacher as TeacherResource;
use App\Http\Resources\Administrative as AdministrativeResource;
use App\Http\Resources\Representative as RepresentativeResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'email' => $this->email,
            "email_verified_at" => $this->email_verified_at,
            $this->mergeWhen($this->userable_type === 'App\Student', new StudentResource($this->userable)),
            $this->mergeWhen($this->userable_type === 'App\Teacher', new TeacherResource($this->userable)),
            $this->mergeWhen($this->userable_type === 'App\Representative', new RepresentativeResource($this->userable)),
            $this->mergeWhen($this->userable_type === 'App\Administrative', new AdministrativeResource($this->userable)),
//            'token' => $this->when($this->token, $this->token),
            "mobile" => $this->mobile,
            "phone" => $this->phone,
            "role" => $this->role,
            "sex" => $this->sex,
            "status" => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
