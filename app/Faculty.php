<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = ['id', 'name', 'status'];

    public function careers() {
        return $this->hasMany('App\Career');
    }

    public function administratives()
    {
        return $this->hasMany('App\Administrative');
    }

    public function teachers()
    {
        return $this->hasManyThrough('App\Teacher', 'App\Career');
    }
}
