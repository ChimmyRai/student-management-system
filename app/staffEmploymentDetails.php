<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffEmploymentDetails extends Model
{
  protected $dates = ['start_date','end_date','created_at','updated_at'];//this is used to make sure this fields are instance of carbon and not string dates
  protected $fillable=[
    'cid',
    'school',
    'dzongkhag_served',
    'start_date',
    'end_date',
    'user_id_of_updater',
    'user_name_of_updater'

  ];


  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('cid', 'like', '%'.$query.'%')
                ->orWhere('school', 'like', '%'.$query.'%')
                ->orWhere('dzongkhag_served', 'like', '%'.$query.'%')
                ->orWhere('start_date', 'like', '%'.$query.'%')
                ->orWhere('end_date', 'like', '%'.$query.'%');

    }

    public static function search_employemntdetailstoleftjoinstaffdetails($query)
      {
          return empty($query) ? static::query()
              : static::where('staffdetails.Name', 'like', '%'.$query.'%')
                  ->orWhere('staff_employment_details.cid', 'like', '%'.$query.'%')
                  ->orWhere('staff_employment_details.school', 'like', '%'.$query.'%')
                  ->orWhere('staff_employment_details.dzongkhag_served', 'like', '%'.$query.'%')
                  ->orWhere('staff_employment_details.start_date', 'like', '%'.$query.'%')
                  ->orWhere('staff_employment_details.end_date', 'like', '%'.$query.'%');
      }
}
