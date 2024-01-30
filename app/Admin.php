<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;       #removed as per the instruction on the website https://lavalite.org/blog/multiple-authentication-in-laravel
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminResetPasswordNotification;
use App\Notifications\VerifyAdminEmail;
class Admin extends Authenticatable implements MustVerifyEmail
{
  use Notifiable;
 protected $guard = 'admin';
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'name', 'email', 'password',
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

  /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function SendEmailVerificationNotification()
    {
        //dd('dfasdfasdf');
        $this->notify(new VerifyAdminEmail);
    }

    public function sendPasswordResetNotification($token)
   {
       $this->notify(new AdminResetPasswordNotification($token));
   }

}
