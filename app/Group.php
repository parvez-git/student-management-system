<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['group'];
    protected $primaryKey = 'group_id';
}
