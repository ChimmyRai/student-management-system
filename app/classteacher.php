<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classteacher extends Model
{
  protected $fillable=[
    'user_id_of_teacher',
    'Name_of_teacher',
    'Class',
    'Section',
    'user_id_of_updater',
    'user_name_of_updater'
  ];

  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('user_id_of_teacher', 'like', '%'.$query.'%')
                ->orWhere('Name_of_teacher', 'like', '%'.$query.'%')
                ->orWhere('Class', 'like', '%'.$query.'%')
                ->orWhere('Section', 'like', '%'.$query.'%');
    }
}
