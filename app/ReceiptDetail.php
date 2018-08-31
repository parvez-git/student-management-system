<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptDetail extends Model
{
    protected $fillable = ['receipt_id','student_id','transaction_id'];
}
