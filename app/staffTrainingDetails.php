<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffTrainingDetails extends Model
{
    protected $dates = ['training_start_date','training_end_date','created_at','updated_at'];//this is used to make sure this fields are instance of carbon and not string dates
  protected $fillable=[
    'cid',
    'training_name',
    'training_start_date',
    'training_end_date',
    'attendence_type',
    'user_id_of_updater',
    'user_name_of_updater',
  ];


  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('cid', 'like', '%'.$query.'%')
                ->orWhere('training_name', 'like', '%'.$query.'%')
                ->orWhere('training_start_date', 'like', '%'.$query.'%')
                ->orWhere('training_end_date', 'like', '%'.$query.'%')
                ->orWhere('attendence_type', 'like', '%'.$query.'%');

    }

    public static function search_trainingdetailstoleftjoinstaffdetails($query)
      {
          return empty($query) ? static::query()
              : static::where('staffdetails.Name', 'like', '%'.$query.'%')
                  ->orWhere('staff_training_details.cid', 'like', '%'.$query.'%')
                  ->orWhere('staff_training_details.training_name', 'like', '%'.$query.'%')
                  ->orWhere('staff_training_details.training_start_date', 'like', '%'.$query.'%')
                  ->orWhere('staff_training_details.training_end_date', 'like', '%'.$query.'%')
                  ->orWhere('staff_training_details.attendence_type', 'like', '%'.$query.'%');
      }
}
