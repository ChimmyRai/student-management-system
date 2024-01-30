<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

/*routes for calender*/

Route::get('fullcalender', [\App\Http\Controllers\FullCalenderController::class, 'index'])->name('calenderoperation')->middleware('auth:admin');
Route::post('fullcalenderAjax', [\App\Http\Controllers\FullCalenderController::class, 'ajax']);






//resource routes for the subject allocation model-contains route for update,delete,view or store and create of new model values
Route::get('/downloadresult',\App\Http\Livewire\DownloadResult::class)->name('resultDownload')->middleware('auth:admin,web');
Route::get('/addresultLower',\App\Http\Livewire\AddResultLower::class)->name('resultAdditionLower')->middleware('auth:admin,web','CheckIfClassTeacher');
Route::get('/addresultmiddle',\App\Http\Livewire\AddResultMiddle::class)->name('resultAdditionMiddle')->middleware('auth:admin,web','CheckIfClassTeacher');
Route::get('/addresulthighersci',\App\Http\Livewire\AddResultHigherSci::class)->name('resultAdditionHigherSci')->middleware('auth:admin,web','CheckIfClassTeacher');
Route::get('/addresulthighercom',\App\Http\Livewire\AddResultHigherCom::class)->name('resultAdditionHigherCom')->middleware('auth:admin,web','CheckIfClassTeacher');
Route::get('/addresulthigherarts',\App\Http\Livewire\AddResultHigherArts::class)->name('resultAdditionHigherArts')->middleware('auth:admin,web','CheckIfClassTeacher');
Route::get('/allocatesubject',\App\Http\Livewire\SubjectAllocationForm::class)->name('subjectAllocation')->middleware('auth:admin');
Route::get('/allocateclassteacher',\App\Http\Livewire\AddClassteacher::class)->name('classteacherAllocation')->middleware('auth:admin');
//Rotue for datatable used for student search by visitors
Route::get('/addstaffdetails',\App\Http\Livewire\AddStaffDetails::class)->name('staffDetailAddition')->middleware('auth:admin,web');
Route::get('/addstudentdetails',\App\Http\Livewire\AddStudentDetails::class)->name('studentDetailAddition')->middleware('auth:admin,web');
Route::get('/addstaffemploymentdetails',\App\Http\Livewire\AddStaffEmploymentDetails::class)->name('staffEmploymentDetailsAddition')->middleware('auth:admin,web');
Route::get('/addstaffpromotiondetails',\App\Http\Livewire\Addstaffpromotiondetails::class)->name('staffPromotionDetailsAddition')->middleware('auth:admin,web');
Route::get('/addstaffCurrentemploymentdetails',\App\Http\Livewire\AddStaffsCurrentEmploymentDetails::class)->name('staffCurrentEmploymentDetailsAddition')->middleware('auth:admin,web');
Route::get('/addstafftrainingdetails',\App\Http\Livewire\AddstaffTrainingdetails::class)->name('staffTrainingDetailsAddition')->middleware('auth:admin,web');
Route::get('/addstaffawarddetails',\App\Http\Livewire\AddstaffAwarddetails::class)->name('staffAwardDetailsAddition')->middleware('auth:admin,web');
Route::get('/addstaffeducationaldetails',\App\Http\Livewire\AddstaffEducationaldetails::class)->name('staffEducationalDetailsAddition')->middleware('auth:admin,web');

Route::get('/infoGeneration',\App\Http\Livewire\detailsGeneration::class)->name('detailGeneration')->middleware('auth:admin,web');



Route::group(['namespace'=>'App\Http\Controllers'],function(){

  Route::get('/showresult', ['uses'=>'ResultDisplayController@index', 'as'=>'students.showresult'])->middleware('auth:student');
  Route::get('/searchstudents', ['uses'=>'StudentBioSearchController@index', 'as'=>'students.index']);
  Route::get('/searchstudents/{id}', ['uses'=>'StudentBioSearchController@showStudentDetails', 'as'=>'students.show']);
  //routes to the pdf download of student details by visitors
  Route::get('/downloadStudentDetailsInPDF/{id}', ['uses'=>'StudentBioSearchController@generatePDF', 'as'=>'students.show']);

  //Rotue for datatable used for staff search by visitors
  Route::get('/searchstaffdetails', ['uses'=>'staffDetailsContorllerVisitors@index', 'as'=>'staffs.index']);
  Route::get('/searchstaffdetails/{id}', ['uses'=>'staffDetailsContorllerVisitors@showStaffDetails', 'as'=>'stafffs.show'])->middleware('auth:admin,web');
  //routes to the pdf download of student details
  Route::get('/downloadStaffDetailsInPDF/{id}', ['uses'=>'staffDetailsContorllerVisitors@generatePDF','as'=>'staffPDF.show']);

  Route::get('/downloadResultInPDFArts', ['uses'=>'ResultDisplayController@generateResultInPDF','as'=>'pdfgeneration.result']);
Route::get('/screenshotDisplay', ['uses'=>'ResultDisplayController@generateViewForPdfDownload']);
  //resource routes for the studentbio model-contains route for update,delete,view or store of new model values
  Route::get('/searchstudentsbyauthenticateduser', ['uses'=>'StudentBioController@index', 'as'=>'studentsauthenticateduser.index']);
  Route::get('studentbio/{id}/destroy', ['uses'=>'StudentBioController@destroy', 'as'=>'studentbio.destroy']);
  Route::resource('studentbio','StudentbioController');




  //resource routes for the staffdetail model-contains route for update,delete,view or store of new model values

  Route::get('/searchStaffDetailsByauthenticateduser', ['uses'=>'StaffDetailsController@index', 'as'=>'staffsdetailsforauthenticateduser.index']);
  Route::resource('staffdetail','StaffDetailsController');


  //authentication routes (default)
//  Auth::routes();
Auth::routes(['verify' => true]);
  //routes for multiauth implemented with new studentuser model
/*  Route::get('/login/student', 'Auth\LoginController@showStudentLoginForm');
  Route::get('/register/student', 'Auth\RegisterController@showStudentRegisterForm');

  Route::post('/login/student', 'Auth\LoginController@studentLogin');
  Route::post('/register/student', 'Auth\RegisterController@createStudent');


  Route::view('/home', 'home')->middleware('auth');
  Route::view('/student', 'layouts.studentdashboard');
*/
Route::group(['namespace' => 'Student'] , function(){

  /****Admin Login Route*****/
  Route::get('login/student', 'Auth\LoginController@showLoginForm')->name('student.login');
  Route::post('login/student', 'Auth\LoginController@login');
  Route::post('logout/student', 'Auth\LoginController@logout')->name('logout');

Route::get('/register/student', 'Auth\RegisterController@showRegistrationForm');
Route::post('/register/student', 'Auth\RegisterController@create');
});
Route::view('/student', 'studentdashboard')->middleware('auth:student');





  Route::group(['namespace' => 'Admin'] , function()  {

    /****Admin Login Route*****/
    Route::get('login/admin', 'Auth\LoginController@showLoginForm');
    Route::post('login/admin', 'Auth\LoginController@login');
    Route::post('logout/admin', 'Auth\LoginController@logout')->name('logout');


    /***admin register route****/
       Route::get('/register/admin', 'Auth\RegisterController@showRegistrationForm');
      Route::post('/register/admin', 'Auth\RegisterController@create');

  /***admin password reset route****/
  Route::post('admin/password/email', [
    'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail',
    'as' => 'admin.password.email'
]);

Route::get('admin/password/reset', [
    'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm',
    'as' => 'admin.password.request'
]);

Route::post('admin/password/reset', [
    'uses' => 'Auth\ResetPasswordController@reset',
    'as' => 'admin.password.update'
]);

Route::get('admin/password/reset/{token}', [
    'uses' => 'Auth\ResetPasswordController@showResetForm',
    'as' => 'admin.password.reset'
]);


  /***admin email verification route****/
 Route::post('admin/email/resend', [
        'uses' => 'Auth\VerificationController@resend',
        'as' => 'admin.verification.resend'
    ]);

    Route::get('admin/email/verify', [
        'uses' => 'Auth\VerificationController@show',
        'as' => 'admin.verification.notice'
    ]);

    Route::get('admin/email/verify/{id}/{hash}', [
        'uses' => 'Auth\VerificationController@verify',
        'as' => 'admin.verification.verify'
    ]);

  });
Route::view('/admin', 'admindashboard')->middleware('auth:admin')->middleware('admin.verified');;

  //routes for multiauth implemented with new admin model

/*
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
  Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

  Route::post('/login/admin', 'Auth\LoginController@adminLogin');
  Route::post('/register/admin', 'Auth\RegisterController@createAdmin');


  Route::view('/home', 'home')->middleware('auth','verified');
*/

  //the below route was defined before implementing multiple authentication
  Route::get('/home', 'HomeController@index')->name('home')->middleware('auth','verified','admin.verified');

});
