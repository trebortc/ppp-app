<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Faculty extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'status' => $this->status,
            'careers' => $this->getFacultyCareers(),
        ];
    }

    public function getFacultyCareers(){
        $careers = [];
        foreach ($this->careers as $career){
            $careers[] = [
                'id' => $career->id,
                'name' => $career->name,
                'pensum' => $career->pensum,
                'levels' => $career->levels,
                'status' => $career->status,
            ];
        }
        return $careers;
    }
}
