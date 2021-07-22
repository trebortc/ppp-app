<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'code', 'level', 'unit', 'field', 'status'];


    public function careers()
    {
        return $this->belongsToMany('App\Career', 'career_subject');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }
}
