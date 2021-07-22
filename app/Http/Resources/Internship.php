<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Internship extends JsonResource
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
            'student_id' => $this->student_id,
            'authorized_by' => $this->authorized_by,
            'teacher_id' => $this->teacher_id,
            'representative_id' => $this->representative_id,
            'start_date' => $this->start_date,
            'finish_date' => $this->finish_date,
            'wide_field' => $this->wide_field,
            'specific_field' => $this->specific_field,
            'area' => $this->area,
            'student_activities' => $this->student_activities,
            'type' => $this->type,
            'status' => $this->status,
            'hours_worked' => $this->hours_worked,
            'student_observations' => $this->student_observations,
            'institutional_agreement_code' => $this->institutional_agreement_code,
            'institutional_agreement_name' => $this->institutional_agreement_name,
            'research_project_code' => $this->research_project_code,
            'research_project_name' => $this->research_project_name,
            'social_project_code' => $this->social_project_code,
            'social_project_name' => $this->social_project_name,
            'evaluation_punctuality' => $this->evaluation_punctuality,
            'evaluation_performance' => $this->evaluation_performance,
            'evaluation_motivation' => $this->evaluation_motivation,
            'evaluation_knowledge' => $this->evaluation_knowledge,
            'evaluation_observations' => $this->evaluation_observations,
            'tutor_followup_actions' => $this->tutor_followup_actions,
            'tutor_improvement_actions' => $this->tutor_improvement_actions,
            'tutor_observations' => $this->tutor_observations,
            'tutor_recommends' => $this->tutor_recommends,
            'tutor_recommends_observations' => $this->tutor_recommends_observations,
            'tutor_knowledge_contribution' => $this->tutor_knowledge_contribution,
            'tutor_knowledge_contribution_observations' => $this->tutor_knowledge_contribution_observations,
            'tutor_recommends_approval' => $this->tutor_recommends_approval,
            'tutor_recommends_approval_observations' => $this->tutor_recommends_approval_observations,
            'commission_approves' => $this->commission_approves,
            'commission_observations' => $this->commission_observations,
            'activities' => $this->activities,
            'useful_topics' => Topic::collection($this->usefulTopics)->groupBy('subject_id'),
            'recommended_topics' => $this->recommendedTopics,
            'student' => new UserResource($this->student->user),
            'representative' => new UserResource($this->representative->user),
            'company' => $this->representative->company,
            $this->mergeWhen($this->teacher_id != null, [
                'teacher' => $this->teacher != null ? new UserResource($this->teacher->user) : null,
            ]),
            $this->mergeWhen($this->authorizedBy != null, [
                'administrative' => $this->authorizedBy != null ? new UserResource($this->authorizedBy->user) : null,
            ]),
            'followups' =>  new FollowupCollection($this->followups()->orderBy('created_at')->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
