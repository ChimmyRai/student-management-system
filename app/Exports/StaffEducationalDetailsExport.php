<?php

namespace App\Exports;

use App\educationaldetailofstaff;
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
class StaffEducationalDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
  use Exportable;
  public function __construct($query,$sortField,$order)
      {
          $this->query = $query;
          $this->sortField = $sortField;
          $this->order = $order;
      }

  public function map($educationaldetails): array
            {
               return [
                  $educationaldetails->cid,
                  $educationaldetails->academic_qualification,
                  $educationaldetails->subject_specialization,
                  $educationaldetails->trc_subject,
                  $educationaldetails->user_id_of_updater,
                  $educationaldetails->user_name_of_updater,

               ];
            }
  public function columnFormats(): array
                {
                    return [
                        'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
                'cid',
                'academic_qualification',
                'subject_specialization',
                'trc_subject',
                'user_id_of_updater',
                'user_name_of_updater'
                              ];
                  }
  public function query()
        {
            return educationaldetailofstaff::query()->where('cid', 'like', '%'.$this->query.'%')
                                  ->orWhere('academic_qualification', 'like', '%'.$this->query.'%')
                                  ->orWhere('subject_specialization', 'like', '%'.$this->query.'%')
                                  ->orWhere('trc_subject', 'like', '%'.$this->query.'%')
                                  ->orderBy($this->sortField,    $this->order);
                }
}
