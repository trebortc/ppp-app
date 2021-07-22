<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Student extends JsonResource
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
            'student_id' => $this->id,
            'student' => $this->user,
            'career_id' => $this->career->id,
            'career' => $this->career->name,
            'faculty' => $this->career->faculty->name,
            'faculty_id' => $this->career->faculty->id,
            'hours_registered' => $this->internships->where('status', 'registered')->sum('hours_worked'),
            'hours_approved' => $this->internships->where('status', 'approved')->sum('hours_worked'),
            'hours_pending' => $this->internships->whereIn('status', ['representative_pending', 'tutor_pending', 'commission_pending'])->sum('hours_worked')
        ];
    }
}
