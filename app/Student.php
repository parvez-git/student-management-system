<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
      'first_name', 'last_name', 'sex', 'dob', 'email', 'status', 'nationality',
      'national_id','passport','phone','village','commune','district','city',
      'current_address','dateregistered','photo','user_id'
    ];

    public function courses()
    {
      return $this->belongsToMany('App\MyClass', 'class_student', 'student_id', 'class_id')->withTimestamps();
    }
}
