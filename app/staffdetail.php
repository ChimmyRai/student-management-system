<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffdetail extends Model
{
  protected $dates = ['dob','created_at','updated_at'];//this is used to make sure this fields are instance of carbon and not string dates
  protected $fillable=[
    'cid',
    'Name',
    'dob',
    'gender',
    'religion',
    'nationality',
    'village',
    'gewog',
    'dzongkhag',
    'house_no',
    'tharm_no',
    'phone',
    'email',
    'img_location',
    'user_id_of_updater',
    'user_name_of_updater'

  ];

  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('cid', 'like', '%'.$query.'%')
                ->orWhere('Name', 'like', '%'.$query.'%')
                ->orWhere('dob', 'like', '%'.$query.'%')
                ->orWhere('gender', 'like', '%'.$query.'%')
                  ->orWhere('religion', 'like', '%'.$query.'%')
                ->orWhere('nationality', 'like', '%'.$query.'%')
                ->orWhere('village', 'like', '%'.$query.'%')
                ->orWhere('gewog', 'like', '%'.$query.'%')
                ->orWhere('dzongkhag', 'like', '%'.$query.'%')
                ->orWhere('house_no', 'like', '%'.$query.'%')
                ->orWhere('tharm_no', 'like', '%'.$query.'%')
                ->orWhere('phone', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%');

    }
  

}
