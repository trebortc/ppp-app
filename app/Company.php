<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['authorized_by', 'ruc', 'name', 'type', 'address', 'phone', 'mobile', 'email', 'city'];

    public function representatives()
    {
        return $this->hasMany('App\Representative');
    }
}
