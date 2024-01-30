<?php

namespace App\Exports;

use App\staffPromotionDetails;
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
class StaffPromotionDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
use Exportable;
public function __construct($query,$sortField,$order)
    {
        $this->query = $query;
        $this->sortField = $sortField;
        $this->order = $order;
      //  dd(  $this->query,$this->sortField,  $this->order);
    }

public function map($promotiondetails): array
          {
             return [
                $promotiondetails->cid,
                $promotiondetails->position_title,
                $promotiondetails->position_level,
                $promotiondetails->grade,
                $promotiondetails->promotion_type,
                Date::dateTimeToExcel($promotiondetails->promotion_date),
                $promotiondetails->user_id_of_updater,
                $promotiondetails->user_name_of_updater,

             ];
          }
public function columnFormats(): array
              {
                  return [
                      'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
              'position_title',
              'position_level',
              'grade',
              'promotion_date',
              'promotion_type',
              'user_id_of_updater',
              'user_name_of_updater'
                            ];
                }
public function query()
      {
          return staffPromotionDetails::query()->where('cid', 'like', '%'.$this->query.'%')
                                ->orWhere('position_title', 'like', '%'.$this->query.'%')
                                ->orWhere('position_level', 'like', '%'.$this->query.'%')
                                ->orWhere('grade', 'like', '%'.$this->query.'%')
                                ->orWhere('promotion_date', 'like', '%'.$this->query.'%')
                                ->orWhere('promotion_type', 'like', '%'.$this->query.'%')
                                 ->orderBy($this->sortField,    $this->order);
              }
}
