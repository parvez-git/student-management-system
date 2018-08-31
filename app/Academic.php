<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic extends Model
{
    protected $fillable = ['academic'];
    protected $primaryKey = 'academic_id';
    public $incrementing  = true;
}
