<?php

namespace App\Imports;

use App\studentbio;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\User ;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Importable; //this contains the Importable trait so you must have this if you use importable trait
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;  //this is required to use SkipsErrors trait which contains all the errors that happened will importing
use Maatwebsite\Excel\Concerns\SkipsOnFailure; // this is used to skip only rows that caused error but import rows that has no error. This is used inorder to remove the transaction maodality of import
use Maatwebsite\Excel\Validators\Failure;// this class is used to handle what happens to those failed rows
use Maatwebsite\Excel\Concerns\SkipsFailures;// this trait is used to hold all validation erros of rows that had validtion erros that were skipped during import
use Maatwebsite\Excel\Concerns\WithBatchInserts;// this species amount of queries done by the server to prevent bottleneck if amount of record is huge
use Maatwebsite\Excel\Concerns\WithChunkReading; //this is read the file to be imported in chucnks so that memory usage is lowered
//this are for parsing date correctly when changing form excel date to php date and vice versa
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class StudentDetailsImport implements ToModel, WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
  use Importable,SkipsErrors,SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      if (Auth::check())
      {

      //  $authenticatedUser=User::where("id",$this->Subject)->where("Class",$this->Class)->value('Number_of_periods')
      $user_id=Auth::user()->id;
      $user_name=Auth::user()->name;

      }
      else
      {

        $user_id=Auth::guard('admin')->user()->id;
        $user_name=Auth::guard('admin')->user()->name;
      }
//dd($row);
        return new studentbio([
          'student_code'=>$row['student_code'],
          'index_number'=>$row['index_number'],
          'adm_no'=>$row['adm_no'],
          'cid_no'=>$row['cid_no'],
          'Name'=>$row['name'],
          'dob'=>Carbon::instance(Date::excelToDateTimeObject(intval($row['dob']))),
          'gender'=>$row['gender'],
          'blood_group'=>$row['blood_group'],
          'current_class'=>$row['current_class'],
          'current_section'=>$row['current_section'],
          'village'=>$row['village'],
          'gewog'=>$row['gewog'],
          'dzongkhag'=>$row['dzongkhag'],
          'mother_name'=>$row['mother_name'],
          'father_name'=>$row['father_name'],
          'guardian_contact'=>$row['guardian_contact'],
          'self_contact'=>$row['self_contact'],
          'email'=>$row['email'],
          'date_of_joining_school'=>Carbon::instance(Date::excelToDateTimeObject(intval($row['date_of_joining_school']))),
          'class_when_joining_school'=>$row['class_when_joining_school'],
          'previous_schools'=>$row['previous_schools'],
          'hostel_status'=>$row['hostel_status'],
          'house'=>$row['house'],
          'kidu_receipent'=>$row['kidu_receipent'],
          'differently_abled'=>$row['differently_abled'],
          'img_location'=>$row['img_location'],
          'user_id'=>$user_id,
          'user_name'=>$user_name,
        ]);

    }


    public function rules(): array
     {

         return [


             '*.student_code'=>['required','string','unique:studentbios,student_code','regex:/^[0-9]+(\.[0-9]+)+$/'],
             '*.adm_no'=>['required','string','unique:studentbios,adm_no'],
             '*.cid_no'=>['nullable','numeric'],
             '*.name'=>['required','string','regex:/^[a-zA-Z\s]+$/'],
             '*.gender'=>['required'],
             '*.dob'=>['required'],
             '*.blood_group'=>['required'],
             '*.current_class'=>['required'],
             '*.current_section'=>['required'],
             '*.village'=>['required','string','regex:/^[a-zA-Z\s]+$/'],
             '*.gewog'=>['required','string','regex:/^[a-zA-Z\s]+$/'],
             '*.dzongkhag'=>['required','string','regex:/^[a-zA-Z\s]+$/'],
             '*.guardian_contact'=>['required','regex:^\d+(,\d+)*$^'],
            '*.self_contact'=>['required','regex:^\d+(,\d+)*$^'],
             '*.email'=>['required','email'],
             '*.date_of_joining_school'=>['required'],
             '*.class_when_joining_school'=>['required','numeric'],
             '*.hostel_status'=>['required','string'],
             '*.house'=>['required','string'],
            '*.kidu_receipent'=>['required','string'],
            '*.differently_abled'=>['required','string'],


         ];
     }
     public function batchSize(): int
         {
             return 1000;
         }

         public function chunkSize(): int
        {
            return 500;
        }
}
