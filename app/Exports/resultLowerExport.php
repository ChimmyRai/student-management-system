<?php

namespace App\Exports;

use App\resultlower;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;//this is needed to export as excel file with headings
use Maatwebsite\Excel\Concerns\WithMapping; //this is needed to specify which columns from database table to be inlcuded in the excel
//this are for parsing date correctly when changing form excel date to php date and vice versa
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use Maatwebsite\Excel\Concerns\WithStyles;//this is to export to excel with some formattings to the excel file
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
class resultLowerExport implements FromQuery, WithHeadings,WithMapping,WithStyles
{
  use Exportable;

  public function __construct($class,$section)
      {
          $this->class = $class;
          $this->section = $section;
      }
public function map($result): array
   {
       return [
           $result->student_code,
           $result->index_number,
           $result->email,
           $result->dzongkha,
           $result->english,
           $result->math,
           $result->science,
           $result->history,
           $result->geography,
           $result->average,
           $result->remarks,
           $result->rank,
           $result->dues,
           $result->class,
           $result->section,
           $result->exam_type,
           $result->user_id_of_updater,
           $result->user_name_of_updater,

       ];
   }

public function styles(Worksheet $sheet)
     {
         return [
             // Style the first row as bold text.
             1    => ['font' => ['bold' => true]],
         ];
     }

public function headings(): array
       {
           return [
             'student_code',
             'index_number',
             'email',
             'dzongkha',
             'english',
             'math',
             'science',
             'history',
             'geography',
             'average',
             'remarks',
             'rank',
             'dues',
             'class',
             'section',
             'exam_type',
             'user_id_of_updater',
             'user_name_of_updater'
           ];
       }
public function query()
       {
           return resultlower::query()->where('class','=',$this->class)
           ->Where('section', '=', $this->section);

       }
}
