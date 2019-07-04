<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    //

    protected $guarded = [];


    public function laboratory()
    {
        return $this->hasMany(laboratory::class);
    }

    public function sub_tests()
    {
        return $this->hasMany(Tests::class, 'parent_id');
    }
}
