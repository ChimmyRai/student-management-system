<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resultlower extends Model
{
  protected $fillable=[
    'student_code',
    'index_number',
    'email',
    'dzongkha',
    'english',
    'math',
    'science',
    'history',
    'geography',
    'average',
    'remarks',
    'rank',
    'dues',
    'class',
    'section',
    'exam_type',
    'user_id_of_updater',
    'user_name_of_updater'
  ];
}
