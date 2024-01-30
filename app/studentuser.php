<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;       #removed as per the instruction on the website https://lavalite.org/blog/multiple-authentication-in-laravel
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class studentuser extends Authenticatable
{
  use Notifiable;
 protected $guard = 'student';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'password','student_code','class','section',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password', 'remember_token',
  ];

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
      'email_verified_at' => 'datetime',
  ];

}
