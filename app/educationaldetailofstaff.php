<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class educationaldetailofstaff extends Model
{
  protected $fillable=[
    'cid',
    'academic_qualification',
    'subject_specialization',
    'trc_subject',
    'user_id_of_updater',
    'user_name_of_updater',
  ];


  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('cid', 'like', '%'.$query.'%')
                ->orWhere('academic_qualification', 'like', '%'.$query.'%')
                ->orWhere('subject_specialization', 'like', '%'.$query.'%')
                ->orWhere('trc_subject', 'like', '%'.$query.'%');
    }

public static function search_educationaldetailstoleftjoinstaffdetails($query)
      {
          return empty($query) ? static::query()
              : static::where('staffdetails.Name', 'like', '%'.$query.'%')
                  ->orWhere('educationaldetailofstaffs.cid', 'like', '%'.$query.'%')
                  ->orWhere('educationaldetailofstaffs.academic_qualification', 'like', '%'.$query.'%')
                  ->orWhere('educationaldetailofstaffs.subject_specialization', 'like', '%'.$query.'%')
                  ->orWhere('educationaldetailofstaffs.trc_subject', 'like', '%'.$query.'%');
      }

}
