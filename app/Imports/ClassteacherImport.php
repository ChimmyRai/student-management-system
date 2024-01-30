<?php

namespace App\Imports;

use App\classteacher;
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
class ClassteacherImport implements ToModel,WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
  use Importable,SkipsErrors,SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */





    public function model(array $row)
    {
      $user_id_of_updater=Auth::guard('admin')->user()->id;//get the id of the admin to attach with excel file for user_id_of_updater field
        return new classteacher([
          'user_id_of_teacher'=>$row['teacher_id'],
          'Name_of_teacher'=>$row['teacher_name'],
          'Class'=>$row['class'],
          'Section'=>$row['section'],
          'user_id_of_updater'=>$user_id_of_updater,

        ]);
    }

    public function rules(): array
     {
         return [
             '*.teacher_id' =>['required','numeric','unique:classteachers,user_id_of_teacher'],
             '*.teacher_name' =>['required'],
             '*.class'=>['required','numeric'],
             '*.section'=>['required'],

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
