<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
      'class_id',
      'academic_id',
      'level_id',
      'fee_type_id',
      'fee_heading',
      'amount'
    ];
}
