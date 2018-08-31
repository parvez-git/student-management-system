<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
      'transaction_date',
      'fee_id',
      'user_id',
      'student_id',
      'student_fee_id',
      'paid',
      'remark',
      'description'
    ];
}
