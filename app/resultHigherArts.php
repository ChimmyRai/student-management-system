<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resultHigherArts extends Model
{
  protected $fillable=[
    'student_code',
    'index_number',
    'email',
    'dzongkha',
    'english',
    'b_math',
    'geography',
    'history',
    'economics',
    'media_studies',
    'rigzhung',
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
                  ->orWhere('b_math', '=', $query)
                  ->orWhere('geography', '=', $query)
                  ->orWhere('history', '=', $query)
                  ->orWhere('economics', '=', $query)
                  ->orWhere('media_studies', '=', $query)
                  ->orWhere('rigzhung', '=', $query)
                  ->orWhere('average', '=', $query)
                  ->orWhere('remarks', 'like', '%'.$query.'%')
                  ->orWhere('rank', 'like', '=', $query)
                  ->orWhere('dues', 'like', '%'.$query.'%')
                  ->orWhere('class',  '=', $query)
                  ->orWhere('section', 'like', '%'.$query.'%')
                  ->orWhere('exam_type', 'like', '%'.$query.'%');
      }


  public static function search_resultHigherArtstoleftjoinstaffdetails($query)
                {
                    return empty($query) ? static::query()
                        : static::where('studentbios.Name', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.student_code', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.index_number', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.email', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.dzongkha', '=', $query)
                            ->orWhere('result_higher_arts.english','=', $query)
                            ->orWhere('result_higher_arts.b_math', '=', $query)
                            ->orWhere('result_higher_arts.geography','=', $query)
                            ->orWhere('result_higher_arts.history', '=', $query)
                            ->orWhere('result_higher_arts.economics','=', $query)
                            ->orWhere('result_higher_arts.media_studies','=', $query)
                            ->orWhere('result_higher_arts.rigzhung','=', $query)
                            ->orWhere('result_higher_arts.average', '=', $query)
                            ->orWhere('result_higher_arts.remarks', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.rank', '=', $query)
                            ->orWhere('result_higher_arts.dues', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.class',  '=', $query)
                            ->orWhere('result_higher_arts.section', 'like', '%'.$query.'%')
                            ->orWhere('result_higher_arts.exam_type', 'like', '%'.$query.'%');
                }

}
