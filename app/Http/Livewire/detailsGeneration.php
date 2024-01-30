<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\staffCurrentEmploymentDetails;
use App\staffdetail ;
use App\staffEmploymentDetails;
use App\staffTrainingDetails;
use App\staffPromotionDetails;
use App\User ;
use App\Admin;
use  Livewire\WithPagination;
use DB;
use DPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\staffCurrrentEmploymentDetailsImport;
use App\Exports\StaffCurrentEmploymentDetailsExport;
class detailsGeneration extends Component
{
  use WithFileUploads;
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='staff_current_employment_details.created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $selectedItem;
  public $Staff_in_list;

  public $excelfile;
  public $errorsImport;
  public $modelId;
  Public $action;

  public $user_id_of_updater;
  public $user_name_of_updater;
  public $cid;
  public $employment_type;
  public $eid;

protected $listeners=['getModelId'];
public function render()
    {
      $currentEmploymentDetailsList=staffCurrentEmploymentDetails::search_currentemploymentdetailstoleftjoinstaffdetails($this->search)
      ->leftJoin('staffdetails', 'staff_current_employment_details.cid', '=', 'staffdetails.cid')
      ->select('staff_current_employment_details.*','staffdetails.img_location','staffdetails.Name')
      ->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Staff_in_list=staffdetail::all();
      return view('livewire.searchViewforInfoGeneration',['currentEmploymentDetailsList'=>$currentEmploymentDetailsList])->layout('layouts.sbadmin');
    }


public function sortBy($field)
                            {
                                if ($this->sortfield===$field)
                                        {
                                            $this->sortDesc=!$this->sortDesc;
                                            }
                                  else
                                        {

                                          $this->sortDesc=true;
                                          }
                                            $this->sortfield=$field;

                                }

public function generatePDF($cid)
{
  //dd($cid);
$staffBio=  staffdetail::where('cid',$cid)->first();
$staffCurrentEmploymentDetails=staffCurrentEmploymentDetails::where('cid',$cid)->first();
$staffEmploymentDetails=staffEmploymentDetails::where('cid',$cid)->get();  //can have mulitple records
$staffTrainingDetails=staffTrainingDetails::where('cid',$cid)->get(); //can have mulitple records
$staffPromotionDetails=staffPromotionDetails::where('cid',$cid)->get(); //can have mulitple records
dd($staffPromotionDetails);
$pdfContent = DPDF::loadView('staffviews.detailsPDFview')->output();
return response()->streamDownload(
     fn () => print($pdfContent),
     "filename.pdf"
);

}
}
