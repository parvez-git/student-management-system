<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lavel extends Model
{
    protected $fillable = ['program_id','lavel','description'];
    protected $primaryKey = 'lavel_id';
}
