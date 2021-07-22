<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Representative extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'representative_id' => $this->id,
            'company_id' => $this->company_id,
            'company' => $this->company,
            'job_title' => $this->job_title
        ];
    }
}
