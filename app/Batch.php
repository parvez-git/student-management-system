<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    protected $fillable = ['batch'];
    protected $primaryKey = 'batch_id';
}
