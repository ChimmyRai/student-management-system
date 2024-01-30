<?php

namespace App\Imports;

use App\resultHigherArts;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\User ;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\Importable; //this contains the Importable trait so you must have this if you use importable trait
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;  //this is required to use SkipsErrors trait which contains all the errors that happened will importing
use Maatwebsite\Excel\Concerns\SkipsOnFailure; // this is used to skip only rows that caused error but import rows that has no error. This is used inorder to remove the transaction maodality of import
use Maatwebsite\Excel\Validators\Failure;// this class is used to handle what happens to those failed rows
use Maatwebsite\Excel\Concerns\SkipsFailures;// this trait is used to hold all validation erros of rows that had validtion erros that were skipped during import
use Maatwebsite\Excel\Concerns\WithBatchInserts;// this species amount of queries done by the server to prevent bottleneck if amount of record is huge
use Maatwebsite\Excel\Concerns\WithChunkReading; //this is read the file to be imported in chucnks so that memory usage is lowered
//use Maatwebsite\Excel\Concerns\WithMultipleSheets;// this concern is needed if you have many sheets in the excel file and you need to handle them seperately
//this are for parsing date correctly when changing form excel date to php date and vice versa
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
class resultHigherArtsImport implements ToModel,  WithHeadingRow, SkipsOnError, WithValidation, SkipsOnFailure, WithBatchInserts, WithChunkReading
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
      $user_id_of_updater=Auth::user()->id;
      $user_name_of_updater=Auth::user()->name;

      }
      else
      {

        $user_id_of_updater=Auth::guard('admin')->user()->id;
        $user_name_of_updater=Auth::guard('admin')->user()->name;
      }
        return new resultHigherArts([
          'student_code'=>$row['student_code'],
          'index_number'=>$row['index_number'],
          'email'=>$row['email'],
          'dzongkha'=>$row['dzongkha'],
          'english'=>$row['english'],
          'b_math'=>$row['b_math'],
          'geography'=>$row['geography'],
          'history'=>$row['history'],
          'economics'=>$row['economics'],
          'media_studies'=>$row['media_studies'],
          'rigzhung'=>$row['rigzhung'],
          'average'=>$row['average'],
          'remarks'=>$row['remarks'],
          'rank'=>$row['rank'],
          'dues'=>$row['dues'],
          'class'=>$row['class'],
          'section'=>$row['section'],
          'exam_type'=>$row['exam_type'],
          'user_id_of_updater'=>$user_id_of_updater,
          'user_name_of_updater'=>$user_name_of_updater,
        ]);
    }

    public function rules(): array
             {
                 return [
                    '*.student_code'=>['required','unique:result_higher_arts,student_code','regex:/^[0-9]+(\.[0-9]+)+$/'],
                    '*.index_number'=>['numeric','nullable'],
                    '*.email'=>['email','nullable','unique:resultmiddles,index_number'],
                    '*.dzongkha' =>['required','min:0','max:100'],
                    '*.english' =>['required','min:0','max:100'],
                    '*.b_math' =>['nullable','min:0','max:100'],
                    '*.geography' =>['required','min:0','max:100'],
                    '*.history' =>['required','min:0','max:100'],
                    '*.economics' =>['required','min:0','max:100'],
                    '*.media_studies' =>['nullable','min:0','max:100'],
                    '*.rigzhung' =>['nullable','min:0','max:100'],
                    '*.average' =>['required','min:0','max:100'],
                    '*.remarks' =>['required'],
                    '*.rank' =>['required'],
                    '*.dues'=>['string','nullable'],
                    '*.class'=>['required','numeric',Rule::exists('classteachers')->where(function ($query) {
                            return $query->where('user_id_of_teacher','=', Auth::user()->id);
                          })],
                    '*.section'=>['required','string',Rule::exists('classteachers','Section')->where(function ($query) {
                            return $query->where('user_id_of_teacher','=', Auth::user()->id);
                          })],
                    '*.exam_type'=>['required','string'],



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
