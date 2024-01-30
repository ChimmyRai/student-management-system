<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class awarddetailofstaff extends Model
{
protected $dates = ['award_recieve_date','created_at','updated_at'];//this is used to make sure this fields are instance of carbon and not string dates
protected $fillable=[
  'cid',
  'award_title',
  'award_recieve_date',
  'user_id_of_updater',
  'user_name_of_updater',
];
public static function search($query)
  {
      return empty($query) ? static::query()
          : static::where('cid', 'like', '%'.$query.'%')
              ->orWhere('award_title', 'like', '%'.$query.'%')
              ->orWhere('award_recieve_date', 'like', '%'.$query.'%');

  }

  public static function search_awardsdetailstoleftjoinstaffdetails($query)
    {
        return empty($query) ? static::query()
            : static::where('staffdetails.Name', 'like', '%'.$query.'%')
                ->orWhere('awarddetailofstaffs.cid', 'like', '%'.$query.'%')
                ->orWhere('awarddetailofstaffs.award_title', 'like', '%'.$query.'%')
                ->orWhere('awarddetailofstaffs.award_recieve_date', 'like', '%'.$query.'%');
    }

}
