<?php

namespace App\Exports;

use App\staffdetail;
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

class StaffDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
  use Exportable;


  public function __construct($query,$sortField,$order)
      {
          $this->query = $query;
          $this->sortField = $sortField;
          $this->order = $order;
      }

      public function map($staffdetails): array
   {
       return [
           $staffdetails->cid,
           $staffdetails->Name,
          Date::dateTimeToExcel($staffdetails->dob),
           $staffdetails->gender,
          $staffdetails->religion,
           $staffdetails->nationality,
           $staffdetails->village,
           $staffdetails->gewog,
           $staffdetails->dzongkhag,
           $staffdetails->house_no,
           $staffdetails->tharm_no,
           $staffdetails->phone,
          $staffdetails->email,
          $staffdetails->img_location,
          $staffdetails->user_id_of_updater,
          $staffdetails->user_name_of_updater,

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
              'Name',
              'dob',
              'gender',
              'religion',
              'nationality',
              'village',
              'gewog',
              'dzongkhag',
              'house_no',
              'tharm_no',
              'phone',
              'email',
              'img_location',
              'user_id_of_updater',
              'user_name_of_updater'
            ];
        }

    public function query()
    {
        return staffdetail::query()->where('cid', 'like', '%'.$this->query.'%')
        ->orWhere('Name', 'like', '%'.$this->query.'%')
        ->orWhere('dob', 'like', '%'.$this->query.'%')
        ->orWhere('gender', 'like', '%'.$this->query.'%')
          ->orWhere('religion', 'like', '%'.$this->query.'%')
        ->orWhere('nationality', 'like', '%'.$this->query.'%')
        ->orWhere('village', 'like', '%'.$this->query.'%')
        ->orWhere('gewog', 'like', '%'.$this->query.'%')
        ->orWhere('dzongkhag', 'like', '%'.$this->query.'%')
        ->orWhere('house_no', 'like', '%'.$this->query.'%')
        ->orWhere('tharm_no', 'like', '%'.$this->query.'%')
        ->orWhere('phone', 'like', '%'.$this->query.'%')
        ->orWhere('email', 'like', '%'.$this->query.'%')
        ->orderBy($this->sortField,    $this->order);
    }
}
