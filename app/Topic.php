<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = ['subject_id', 'name', 'status'];

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function internships()
    {
        return $this->belongsToMany('App\Internship');
    }


}
