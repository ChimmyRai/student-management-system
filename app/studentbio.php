<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;
class studentbio extends Model
{
  protected $dates = ['dob', 'date_of_joining_school'];//this is used to make sure this fields are instance of carbon and not string dates
  protected $fillable=[
    'student_code',
    'index_number',
    'adm_no',
    'cid_no',
    'Name',
    'dob',
    'gender',
    'blood_group',
    'current_class',
    'current_section',
    'village',
    'gewog',
    'dzongkhag',
    'mother_name',
    'father_name',
    'guardian_contact',
    'self_contact',
    'email',
    'date_of_joining_school',
    'class_when_joining_school',
    'previous_schools',
    'hostel_status',
    'house',
    'kidu_receipent',
    'differently_abled',
    'img_location',
    'user_id',
    'user_name',
  ];
  public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('student_code', 'like', '%'.$query.'%')
                ->orWhere('index_number', 'like', '%'.$query.'%')
                ->orWhere('adm_no', 'like', '%'.$query.'%')
                ->orWhere('cid_no', 'like', '%'.$query.'%')
                ->orWhere('Name', 'like', '%'.$query.'%')
                ->orWhere('dob', 'like', '%'.$query.'%')
                ->orWhere('gender', 'like', '%'.$query.'%')
                ->orWhere('blood_group', 'like', '%'.$query.'%')
                ->orWhere('current_class', '=', $query)
                ->orWhere('current_section', 'like', '%'.$query.'%')
                ->orWhere('village', 'like', '%'.$query.'%')
                ->orWhere('gewog', 'like', '%'.$query.'%')
                ->orWhere('dzongkhag', 'like', '%'.$query.'%')
                ->orWhere('mother_name', 'like', '%'.$query.'%')
                ->orWhere('father_name', 'like', '%'.$query.'%')
                ->orWhere('guardian_contact', 'like', '%'.$query.'%')
                ->orWhere('self_contact', 'like', '%'.$query.'%')
                ->orWhere('email', 'like', '%'.$query.'%')
                ->orWhere('date_of_joining_school', 'like', '%'.$query.'%')
                ->orWhere('class_when_joining_school',  '=', $query)
                ->orWhere('previous_schools', 'like', '%'.$query.'%')
                ->orWhere('hostel_status', 'like', '%'.$query.'%')
                ->orWhere('house', 'like', '%'.$query.'%')
                ->orWhere('kidu_receipent', 'like', '%'.$query.'%')
                ->orWhere('differently_abled', 'like', '%'.$query.'%');

    }

  public function user()
  {
    return $this->has('App\User');
  }
}
