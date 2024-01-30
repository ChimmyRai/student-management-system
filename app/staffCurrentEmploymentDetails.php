<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staffCurrentEmploymentDetails extends Model
{
protected $dates = ['service_join_date','current_school_join_date','contract_renewal_last_date','contract_expiry_date','created_at','updated_at'];//this is used to make sure this fields are instance of carbon and not string dates
  protected $fillable=[
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
public static function search($query)
    {
        return empty($query) ? static::query()
            : static::where('cid', 'like', '%'.$query.'%')
                ->orWhere('employment_type', 'like', '%'.$query.'%')
                ->orWhere('eid', 'like', '%'.$query.'%')
                ->orWhere('agency', 'like', '%'.$query.'%')
                ->orWhere('occupational_group', 'like', '%'.$query.'%')
                ->orWhere('occupational_subgroup', 'like', '%'.$query.'%')
                ->orWhere('job_code', 'like', '%'.$query.'%')
                ->orWhere('service_join_date', 'like', '%'.$query.'%')
                ->orWhere('current_school_join_date', 'like', '%'.$query.'%')
                ->orWhere('tpn', 'like', '%'.$query.'%')
                ->orWhere('gis_no', 'like', '%'.$query.'%')
                ->orWhere('nppf_no', 'like', '%'.$query.'%')
                ->orWhere('bobacc_no', 'like', '%'.$query.'%')
                ->orWhere('contract_renewal_last_date', 'like', '%'.$query.'%')
                ->orWhere('contract_expiry_date', 'like', '%'.$query.'%');
    }

public static function search_currentemploymentdetailstoleftjoinstaffdetails($query)
          {
              return empty($query) ? static::query()
                  : static::where('staffdetails.Name', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.cid', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.employment_type', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.eid', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.agency', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.occupational_group', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.occupational_subgroup', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.job_code', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.service_join_date', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.current_school_join_date', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.tpn', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.gis_no', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.nppf_no', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.bobacc_no', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.contract_renewal_last_date', 'like', '%'.$query.'%')
                      ->orWhere('staff_current_employment_details.contract_expiry_date', 'like', '%'.$query.'%');
          }

}
