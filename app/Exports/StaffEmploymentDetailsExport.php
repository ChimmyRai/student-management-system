<?php

namespace App\Exports;

use App\staffEmploymentDetails;
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
class StaffEmploymentDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
  use Exportable;
  public function __construct($query,$sortField,$order)
      {
          $this->query = $query;
          $this->sortField = $sortField;
          $this->order = $order;
      }


public function map($employmentdetails): array
    {
       return [
          $employmentdetails->cid,
          $employmentdetails->school,
          $employmentdetails->dzongkhag_served,
          Date::dateTimeToExcel($employmentdetails->start_date),
          $employmentdetails->end_date,
          $employmentdetails->user_id_of_updater,
          $employmentdetails->user_name_of_updater,

       ];
    }
public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
            'school',
            'dzongkhag_served',
            'start_date',
            'end_date',
            'user_id_of_updater',
            'user_name_of_updater'
            ];
        }

public function query()
        {
            return staffEmploymentDetails::query()->where('cid', 'like', '%'.$this->query.'%')
                ->orWhere('school', 'like', '%'.$this->query.'%')
                ->orWhere('dzongkhag_served', 'like', '%'.$this->query.'%')
                ->orWhere('start_date', 'like', '%'.$this->query.'%')
                ->orWhere('end_date', 'like', '%'.$this->query.'%')
                ->orderBy($this->sortField,    $this->order);
        }
}
