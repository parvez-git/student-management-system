<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentFee extends Model
{
    protected $fillable = [
      'fee_id',
      'student_id',
      'level_id',
      'amount',
      'discount'
    ];
}
