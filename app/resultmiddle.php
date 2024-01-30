<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class resultmiddle extends Model
{

  protected $fillable=[
    'student_code',
    'index_number',
    'email',
    'dzongkha',
    'english',
    'math',
    'science',
    'hcg',
    'evs',
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
                ->orWhere('science', '=', $query)
                ->orWhere('hcg', '=', $query)
                ->orWhere('evs', '=', $query)
                ->orWhere('average', '=', $query)
                ->orWhere('remarks', 'like', '%'.$query.'%')
                ->orWhere('rank', '=', $query)
                ->orWhere('dues', 'like', '%'.$query.'%')
                ->orWhere('class', '=', $query)
                ->orWhere('section', 'like', '%'.$query.'%')
                ->orWhere('exam_type', 'like', '%'.$query.'%');
    }


public static function search_resulttoleftjoinstaffdetails($query)
              {
                  return empty($query) ? static::query()
                      : static::where('studentbio.Name', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.student_code', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.index_number', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.email', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.dzongkha','=', $query)
                          ->orWhere('resultmiddles.english', '=', $query)
                          ->orWhere('resultmiddles.science','=', $query)
                          ->orWhere('resultmiddles.hcg', '=', $query)
                          ->orWhere('resultmiddles.evs','=', $query)
                          ->orWhere('resultmiddles.average','=', $query)
                          ->orWhere('resultmiddles.remarks', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.rank', '=', $query)
                          ->orWhere('resultmiddles.dues', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.class',  '=', $query)
                          ->orWhere('resultmiddles.section', 'like', '%'.$query.'%')
                          ->orWhere('resultmiddles.exam_type', 'like', '%'.$query.'%');
              }
}
