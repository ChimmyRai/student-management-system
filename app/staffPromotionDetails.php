<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffPromotionDetails extends Model
{
    protected $dates = ['promotion_date'];//this is used to make sure this fields are instance of carbon and not string dates
  protected $fillable=[
    'cid',
    'position_title',
    'position_level',
    'grade',
    'promotion_date',
    'promotion_type',
    'user_id_of_updater',
    'user_name_of_updater'

  ];

  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('cid', 'like', '%'.$query.'%')
                ->orWhere('position_title', 'like', '%'.$query.'%')
                ->orWhere('position_level', 'like', '%'.$query.'%')
                ->orWhere('grade', 'like', '%'.$query.'%')
                ->orWhere('promotion_date', 'like', '%'.$query.'%')
                ->orWhere('promotion_type', 'like', '%'.$query.'%');
    }

public static function search_staffpromotiondetailstoleftjoinstaffdetails($query)
      {
          return empty($query) ? static::query()
              : static::where('staffdetails.Name', 'like', '%'.$query.'%')
                  ->orWhere('staff_promotion_details.cid', 'like', '%'.$query.'%')
                  ->orWhere('staff_promotion_details.position_title', 'like', '%'.$query.'%')
                  ->orWhere('staff_promotion_details.position_level', 'like', '%'.$query.'%')
                  ->orWhere('staff_promotion_details.grade', 'like', '%'.$query.'%')
                  ->orWhere('staff_promotion_details.promotion_date', 'like', '%'.$query.'%')
                  ->orWhere('staff_promotion_details.promotion_type', 'like', '%'.$query.'%');
      }
}
