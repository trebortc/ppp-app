<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administrative extends Model
{
    protected $fillable = ['faculty_id'];
    public $timestamps = false;

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

    public function faculty()
    {
        return $this->belongsTo('App\Faculty');
    }

    public function authorizedInternships()
    {
        return $this->hasMany('App\Internship', 'authorized_by');
    }

}
