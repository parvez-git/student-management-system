<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = ['receipt_id'];

    static public function receiptNumber()
    {
      $receiptid = Receipt::max('id');

      if($receiptid){

        return $receiptid +1;

      }else{

        return 1;
      }
    }
}
