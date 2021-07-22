<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['faculty_id', 'name', 'pensum', 'levels', 'status'];

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function teachers()
    {
        return $this->hasMany('App\Teacher');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject', 'career_subject');
    }

    public function topics()
    {
        return $this->hasManyThrough('App\Topic', 'App\Subject');
    }
}
