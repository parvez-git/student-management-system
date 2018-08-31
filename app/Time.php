<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $fillable = ['time'];
    protected $primaryKey = 'time_id';
}
