<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = ['career_id', 'degree'];
    public $timestamps = false;

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function career()
    {
        return $this->belongsTo('App\Career');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

}
