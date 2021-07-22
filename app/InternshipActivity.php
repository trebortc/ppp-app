<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternshipActivity extends Model
{
    protected $fillable = ['description'];

    public function internship()
    {
        return $this->belongsTo('App\Internship');
    }
}
