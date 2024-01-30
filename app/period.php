<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class period extends Model
{
  protected $fillable=[
    'Subject',
    'Class',
    'Number_of_periods'
  ];

  
}
