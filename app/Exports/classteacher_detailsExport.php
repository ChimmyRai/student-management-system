<?php

namespace App\Exports;

use App\classteacher;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;//this is needed to export as excel file with headings
use Maatwebsite\Excel\Concerns\WithMapping; //this is needed to specify which columns from database table to be inlcuded in the excel
//this are for parsing date correctly when changing form excel date to php date and vice versa
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
//use Maatwebsite\Excel\Concerns\WithColumnFormatting;

use Maatwebsite\Excel\Concerns\WithStyles;//this is to export to excel with some formattings to the excel file
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class classteacher_detailsExport implements FromQuery, WithHeadings,WithMapping,WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;


    public function __construct($query)
        {
            $this->query = $query;
        }

        public function map($classteacher): array
      {
         return [
             $classteacher->user_id_of_teacher,
             $classteacher->Name_of_teacher,
             $classteacher->Class,
             $classteacher->Section,


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
                     'teacher_id',
                     'teacher_name',
                     'class',
                     'section',
                   ];
               }
  public function query()
               {
                   return classteacher::query()->where('user_id_of_teacher', 'like', '%'.$this->query.'%')
                       ->orWhere('Name_of_teacher', 'like', '%'.$this->query.'%')
                       ->orWhere('Class', 'like', '%'.$this->query.'%')
                       ->orWhere('Section', 'like', '%'.$this->query.'%');
               }
}
