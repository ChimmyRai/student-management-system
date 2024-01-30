<?php

namespace App\Exports;

use App\staffCurrentEmploymentDetails;
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

class StaffCurrentEmploymentDetailsExport implements FromQuery, WithHeadings,WithMapping,WithColumnFormatting,WithStyles
{
  use Exportable;
  public function __construct($query,$sortField,$order)
      {
          $this->query = $query;
          $this->sortField = $sortField;
          $this->order = $order;
      }


public function map($currentemploymentdetails): array
    {

       return [
          $currentemploymentdetails->cid,
          $currentemploymentdetails->employment_type,
          $currentemploymentdetails->eid,
          $currentemploymentdetails->agency,
          $currentemploymentdetails->occupational_group,
          $currentemploymentdetails->occupational_subgroup,
          $currentemploymentdetails->job_code,
          Date::dateTimeToExcel($currentemploymentdetails->service_join_date),
          Date::dateTimeToExcel($currentemploymentdetails->current_school_join_date),
          $currentemploymentdetails->tpn,
          $currentemploymentdetails->gis_no,
          $currentemploymentdetails->nppf_no,
          $currentemploymentdetails->bobacc_no,
          $currentemploymentdetails->contract_renewal_last_date,
          $currentemploymentdetails->contract_expiry_date,
          $currentemploymentdetails->user_id_of_updater,
          $currentemploymentdetails->user_name_of_updater,

       ];
    }
public function columnFormats(): array
        {
            return [
                'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
                'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
                'N' => NumberFormat::FORMAT_DATE_DDMMYYYY,
                'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
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
          'employment_type',
          'eid',
          'agency',
          'occupational_group',
          'occupational_subgroup',
          'job_code',
          'service_join_date',
          'current_school_join_date',
          'tpn',
          'gis_no',
          'nppf_no',
          'bobacc_no',
          'contract_renewal_last_date',
          'contract_expiry_date',
          'user_id_of_updater',
          'user_name_of_updater'
                ];
            }
public function query()
      {
        return staffCurrentEmploymentDetails::query()->where('cid', 'like', '%'.$this->query.'%')
        ->orWhere('employment_type', 'like', '%'.$this->query.'%')
        ->orWhere('eid', 'like', '%'.$this->query.'%')
        ->orWhere('agency', 'like', '%'.$this->query.'%')
        ->orWhere('occupational_group', 'like', '%'.$this->query.'%')
        ->orWhere('occupational_subgroup', 'like', '%'.$this->query.'%')
        ->orWhere('job_code', 'like', '%'.$this->query.'%')
        ->orWhere('service_join_date', 'like', '%'.$this->query.'%')
        ->orWhere('current_school_join_date', 'like', '%'.$this->query.'%')
        ->orWhere('tpn', 'like', '%'.$this->query.'%')
        ->orWhere('gis_no', 'like', '%'.$this->query.'%')
        ->orWhere('nppf_no', 'like', '%'.$this->query.'%')
        ->orWhere('bobacc_no', 'like', '%'.$this->query.'%')
        ->orWhere('contract_renewal_last_date', 'like', '%'.$this->query.'%')
        ->orWhere('contract_expiry_date', 'like', '%'.$this->query.'%')
        ->orderBy($this->sortField,    $this->order);
      }
}
