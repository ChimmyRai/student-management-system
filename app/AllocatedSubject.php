<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AllocatedSubject extends Model
{
  protected $fillable=[
    'Admin_ID',
    'User_ID',
    'Name_of_teacher',
    'Section',
    'Subject',
    'Class',
    'Number_of_periods'
  ];

  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('Name_of_teacher', 'like', '%'.$query.'%')
                ->orWhere('Subject', 'like', '%'.$query.'%')
                ->orWhere('Class', 'like', '%'.$query.'%')
                ->orWhere('Section', 'like', '%'.$query.'%')
                ->orWhere('Number_of_periods', 'like', '%'.$query.'%');
    }
}
