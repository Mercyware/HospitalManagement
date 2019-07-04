<?php

namespace App;

use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class InPatient extends Model
{
    //
    use HasRoles;
    use FormAccessible;


    protected $guarded = [];
}
