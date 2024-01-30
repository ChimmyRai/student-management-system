<?php

namespace App\Exports;

use App\staffTrainingDetails;
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
class StaffTrainingDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{

    use Exportable;
    public function __construct($query,$sortField,$order)
        {
            $this->query = $query;
            $this->sortField = $sortField;
            $this->order = $order;
        }

    public function map($trainingdetails): array
              {
                 return [
                    $trainingdetails->cid,
                    $trainingdetails->training_name,
                    Date::dateTimeToExcel($trainingdetails->training_start_date),
                    Date::dateTimeToExcel($trainingdetails->training_end_date),
                    $trainingdetails->attendence_type,

                    $trainingdetails->user_id_of_updater,
                    $trainingdetails->user_name_of_updater,

                 ];
              }
    public function columnFormats(): array
                  {
                      return [
                          'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
                          'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
                  'training_name',
                  'training_start_date',
                  'training_end_date',
                  'attendence_type',
                  'user_id_of_updater',
                  'user_name_of_updater'
                                ];
                    }
    public function query()
          {
              return staffTrainingDetails::query()->where('cid', 'like', '%'.$this->query.'%')
                                    ->orWhere('training_name', 'like', '%'.$this->query.'%')
                                    ->orWhere('training_start_date', 'like', '%'.$this->query.'%')
                                    ->orWhere('training_end_date', 'like', '%'.$this->query.'%')
                                    ->orWhere('attendence_type', 'like', '%'.$this->query.'%')
                                    ->orderBy($this->sortField,    $this->order);
                  }
}
