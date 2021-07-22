<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendedTopic extends Model
{
    protected $fillable = ['name'];

    public function internship()
    {
        return $this->belongsTo('App\Internship');
    }
}
