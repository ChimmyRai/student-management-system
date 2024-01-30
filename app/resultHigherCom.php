<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resultHigherCom extends Model
{
  protected $fillable=[
    'student_code',
    'index_number',
    'email',
    'dzongkha',
    'english',
    'b_math',
    'commerce',
    'accountancy',
    'economics',
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
                  ->orWhere('commerce', '=', $query)
                  ->orWhere('accountancy', '=', $query)
                  ->orWhere('economics', '=', $query)
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
                            ->orWhere('resulthighercoms.student_code', 'like', '%'.$query.'%')
                            ->orWhere('resulthighercoms.index_number', 'like', '%'.$query.'%')
                            ->orWhere('resulthighercoms.email', 'like', '%'.$query.'%')
                            ->orWhere('resulthighercoms.dzongkha', '=', $query)
                            ->orWhere('resulthighercoms.english','=', $query)
                            ->orWhere('resulthighercoms.b_math', '=', $query)
                            ->orWhere('resulthighercoms.commerce','=', $query)
                            ->orWhere('resulthighercoms.accountancy', '=', $query)
                            ->orWhere('resulthighercoms.economics','=', $query)
                            ->orWhere('resulthighercoms.average', '=', $query)
                            ->orWhere('resulthighercoms.remarks', 'like', '%'.$query.'%')
                            ->orWhere('resulthighercoms.rank', '=', $query)
                            ->orWhere('resulthighercoms.dues', 'like', '%'.$query.'%')
                            ->orWhere('resulthighercoms.class',  '=', $query)
                            ->orWhere('resulthighercoms.section', 'like', '%'.$query.'%')
                            ->orWhere('resulthighercoms.exam_type', 'like', '%'.$query.'%');
                }

}
