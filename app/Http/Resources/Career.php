<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Career extends JsonResource
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
            'pensum' => $this->pensum,
            'levels' => $this->levels,
            'faculty_id' => $this->faculty_id,
            'faculty' => $this->faculty,
            'status' => $this->status,
            'teachers' => $this->getCareerTeachers(),
            'subjects' => Subject::collection($this->subjects),
        ];
    }

    public function getCareerTeachers()
    {
        $teachers = [];
        foreach ($this->teachers as $teacher) {
            $user = $teacher->user;
            $teachers[] = [
                'id' => $teacher->id,
                'name' => $user->name,
                'lastname' => $user->lastname
            ];
        }

        return $teachers;
    }
}
