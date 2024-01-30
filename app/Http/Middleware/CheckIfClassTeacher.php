<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\User ;
use App\Admin;
use App\classteacher;
class CheckIfClassTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
       {

         if(Auth::check()||Auth::guard('admin')->check())
         {

             $user = classteacher::where('user_id_of_teacher', '=',Auth::user()->id )->first();
          //   dd(Auth::user()->id);
             if ($user != null||Auth::guard('admin')->check())
             {
               return $next($request);

             }
         }

        // dd("check ");
         return redirect('/home');

       }

}
