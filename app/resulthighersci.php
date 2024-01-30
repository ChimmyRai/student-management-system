<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resulthighersci extends Model
{
  protected $fillable=[
    'student_code',
    'index_number',
    'email',
    'dzongkha',
    'english',
    'math',
    'physics',
    'chemistry',
    'biology',
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

  public static function search($query)
      {
          return empty($query) ? static::query()
              : static::where('student_code', 'like', '%'.$query.'%')
                  ->orWhere('index_number', 'like', '%'.$query.'%')
                  ->orWhere('email', 'like', '%'.$query.'%')
                  ->orWhere('dzongkha', '=', $query)
                  ->orWhere('english', '=', $query)
                  ->orWhere('math', '=', $query)
                  ->orWhere('physics', '=', $query)
                  ->orWhere('chemistry', '=', $query)
                  ->orWhere('biology', '=', $query)
                  ->orWhere('average', '=', $query)
                  ->orWhere('remarks', 'like', '%'.$query.'%')
                  ->orWhere('rank', 'like', '=', $query)
                  ->orWhere('dues', 'like', '%'.$query.'%')
                  ->orWhere('class',  '=', $query)
                  ->orWhere('section', 'like', '%'.$query.'%')
                  ->orWhere('exam_type', 'like', '%'.$query.'%');
      }


  public static function search_resultHigherScitoleftjoinstaffdetails($query)
                {
                    return empty($query) ? static::query()
                        : static::where('studentbios.Name', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.student_code', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.index_number', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.email', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.dzongkha', '=', $query)
                            ->orWhere('resulthigherscis.english','=', $query)
                            ->orWhere('resulthigherscis.math', '=', $query)
                            ->orWhere('resulthigherscis.physics','=', $query)
                            ->orWhere('resulthigherscis.chemistry', '=', $query)
                            ->orWhere('resulthigherscis.biology','=', $query)
                            ->orWhere('resulthigherscis.average', '=', $query)
                            ->orWhere('resulthigherscis.remarks', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.rank', '=', $query)
                            ->orWhere('resulthigherscis.dues', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.class',  '=', $query)
                            ->orWhere('resulthigherscis.section', 'like', '%'.$query.'%')
                            ->orWhere('resulthigherscis.exam_type', 'like', '%'.$query.'%');
                }
}
