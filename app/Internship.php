<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Internship extends Model
{
    protected $fillable = [
        'teacher_id',
        'representative_id',
        'start_date',
        'finish_date',
        'type',
        'wide_field',
        'specific_field',
        'area',
        'student_activities',
        'institutional_agreement_code',
        'institutional_agreement_name',
        'research_project_code',
        'research_project_name',
        'social_project_code',
        'social_project_name',
        'hours_worked',
        'student_observations',
        'evaluation_punctuality',
        'evaluation_performance',
        'evaluation_motivation',
        'evaluation_knowledge',
        'evaluation_observations',
        'tutor_observations',
        'tutor_recommends',
        'tutor_recommends_observations',
        'tutor_knowledge_contribution',
        'tutor_knowledge_contribution_observations',
        'tutor_recommends_approval',
        'tutor_recommends_approval_observations',
        'commission_approves',
        'commission_observations'
    ];

//    public static function boot() {
//        parent::boot();
//        static::creating(function ($internship) {
//            $internship->status = 'pending';
//            $internship->student_id = Auth::user()->userable->id;
//        });
////        static::updating(function($internship){
////            if ($internship->getOriginal('teacher_id') == null && $internship->teacher_id != null ) {
////                $internship->authorized_by = Auth::id();
////                $internship->status = 'in_progress';
////            }
////        });
//    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }

    public function representative()
    {
        return $this->belongsTo('App\Representative');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function authorizedBy()
    {
        return $this->belongsTo('App\Administrative', 'authorized_by');
    }

    public function activities()
    {
        return $this->hasMany('App\InternshipActivity');
    }

    public function recommendedTopics()
    {
        return $this->hasMany('App\RecommendedTopic');
    }

    public function usefulTopics()
    {
        return $this->belongsToMany('App\Topic');
    }

    public function followups()
    {
        return $this->hasMany('App\Followup');
    }
}
