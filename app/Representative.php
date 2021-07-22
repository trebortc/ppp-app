<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    protected $fillable = ['job_title', 'company_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function internships()
    {
        return $this->hasMany('App\Internship');
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
