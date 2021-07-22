<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    protected $fillable = ['text', 'type'];

    public function internship()
    {
        return $this->belongsTo('App\Internship');
    }

}
