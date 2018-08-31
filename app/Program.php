<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = ['program_id','program','description'];
    protected $primaryKey = 'program_id';
    public $incrementing = true;

}
