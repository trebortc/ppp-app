<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Company extends JsonResource
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
            'authorized_by' => $this->authorized_by,
            'ruc' => $this->ruc,
            'name' => $this->name,
            'type' => $this->type,
            'address' => $this->address,
            'phone' => $this->phone,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'city' => $this->city,
            'representatives' => $this->getRepresentativesData()
        ];
    }

    public function getRepresentativesData()
    {
        $representatives = [];
        foreach ($this->representatives as $representative) {
            $user = $representative->user;
            $representatives[] = [
                'id' => $representative->id,
                'name' => $user->name,
                'lastname' => $user->lastname
            ];
        }

        return $representatives;
    }
}
