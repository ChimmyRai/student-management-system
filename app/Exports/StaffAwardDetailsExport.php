<?php

namespace App\Exports;

use App\awarddetailofstaff;
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
class StaffAwardDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
  use Exportable;
  public function __construct($query,$sortField,$order)
      {
          $this->query = $query;
          $this->sortField = $sortField;
          $this->order = $order;
      }

  public function map($awarddetails): array
            {
               return [
                  $awarddetails->cid,
                  $awarddetails->award_title,
                  Date::dateTimeToExcel($awarddetails->award_recieve_date),

                  $awarddetails->user_id_of_updater,
                  $awarddetails->user_name_of_updater,

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
                'award_title',
                'award_recieve_date',
                'user_id_of_updater',
                'user_name_of_updater'
                              ];
                  }
  public function query()
        {
            return awarddetailofstaff::query()->where('cid', 'like', '%'.$this->query.'%')
                                  ->orWhere('award_title', 'like', '%'.$this->query.'%')
                                  ->orWhere('award_recieve_date', 'like', '%'.$this->query.'%')
                                     ->orderBy($this->sortField,    $this->order);
                }
}
