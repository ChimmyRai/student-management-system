<?php

namespace App\Exports;

use App\studentbio;
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

class StudentDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
  use Exportable;


  public function __construct($query,$sortField,$order)
      {
          $this->query = $query;
          $this->sortField = $sortField;
          $this->order = $order;
      }
      public function map($studentdetails): array
   {
       return [
           $studentdetails->student_code,
           $studentdetails->index_number,
           $studentdetails->adm_no,
           $studentdetails->cid_no,
           $studentdetails->Name,
          Date::dateTimeToExcel($studentdetails->dob),
           $studentdetails->gender,
           $studentdetails->blood_group,
           $studentdetails->current_class,
           $studentdetails->current_section,
          $studentdetails->village,
          $studentdetails->gewog,
          $studentdetails->dzongkhag,
          $studentdetails->mother_name,
          $studentdetails->father_name,
          $studentdetails->guardian_contact,
          $studentdetails->self_contact,
          $studentdetails->email,
          Date::dateTimeToExcel($studentdetails->date_of_joining_school),
          $studentdetails->class_when_joining_school,
          $studentdetails->previous_schools,
          $studentdetails->hostel_status,
          $studentdetails->house,
          $studentdetails->kidu_receipent,
          $studentdetails->differently_abled,
          $studentdetails->img_location,

       ];
   }

   public function columnFormats(): array
   {
       return [
           'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
          'S' => NumberFormat::FORMAT_DATE_DDMMYYYY,

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
        }

    public function query()
    {
        return studentbio::query()->where('student_code', 'like', '%'.$this->query.'%')
        ->orWhere('index_number', 'like', '%'.$this->query.'%')
        ->orWhere('adm_no', 'like', '%'.$this->query.'%')
        ->orWhere('cid_no', 'like', '%'.$this->query.'%')
        ->orWhere('Name', 'like', '%'.$this->query.'%')
        ->orWhere('dob', 'like', '%'.$this->query.'%')
        ->orWhere('gender', 'like', '%'.$this->query.'%')
        ->orWhere('blood_group', 'like', '%'.$this->query.'%')
        ->orWhere('current_class', '=', $this->query)
        ->orWhere('current_section', 'like', '%'.$this->query.'%')
        ->orWhere('village', 'like', '%'.$this->query.'%')
        ->orWhere('gewog', 'like', '%'.$this->query.'%')
        ->orWhere('dzongkhag', 'like', '%'.$this->query.'%')
        ->orWhere('mother_name', 'like', '%'.$this->query.'%')
        ->orWhere('father_name', 'like', '%'.$this->query.'%')
        ->orWhere('guardian_contact', 'like', '%'.$this->query.'%')
        ->orWhere('self_contact', 'like', '%'.$this->query.'%')
        ->orWhere('email', 'like', '%'.$this->query.'%')
        ->orWhere('date_of_joining_school', 'like', '%'.$this->query.'%')
        ->orWhere('class_when_joining_school',  '=', $this->query)
        ->orWhere('previous_schools', 'like', '%'.$this->query.'%')
        ->orWhere('hostel_status', 'like', '%'.$this->query.'%')
        ->orWhere('house', 'like', '%'.$this->query.'%')
        ->orWhere('kidu_receipent', 'like', '%'.$this->query.'%')
        ->orWhere('differently_abled', 'like', '%'.$this->query.'%')
         ->orderBy($this->sortField,    $this->order);

    }
}
