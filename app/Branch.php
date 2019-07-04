<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address'
    ];


    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }


}
