<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\staffCurrentEmploymentDetails;
use App\staffdetail ;
use App\User ;
use App\Admin;
use  Livewire\WithPagination;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\staffCurrrentEmploymentDetailsImport;
use App\Exports\StaffCurrentEmploymentDetailsExport;
class AddStaffsCurrentEmploymentDetails extends Component
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
  public $filelocation;
  public $excelfile;
  public $errorsImport;
  public $modelId;
  Public $action;
  public $img_location;
  public $user_id_of_updater;
  public $user_name_of_updater;
  public $cid;
  public $employment_type;
  public $eid;
  public $agency;
  public $occupational_group;
  public $occupational_subgroup;
  public $job_code;
  public $service_join_date;
  public $current_school_join_date;
  public $tpn;
  public $gis_no;
  public $nppf_no;
  public $bobacc_no;
  public $contract_renewal_last_date;
  public $contract_expiry_date;
protected $listeners=['getModelId'];
public function render()
    {
      $currentEmploymentDetailsList=staffCurrentEmploymentDetails::search_currentemploymentdetailstoleftjoinstaffdetails($this->search)
      ->leftJoin('staffdetails', 'staff_current_employment_details.cid', '=', 'staffdetails.cid')
      ->select('staff_current_employment_details.*','staffdetails.img_location','staffdetails.Name')
      ->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Staff_in_list=staffdetail::all();
      return view('livewire.add-staffs-current-employment-details',['currentEmploymentDetailsList'=>$currentEmploymentDetailsList])->layout('layouts.sbadmin');
    }
public function store()
            {

              //dd(Carbon::createFromFormat('Y-m-d','1900-01-01')->format('Y-m-d'));
              if($this->contract_renewal_last_date==null||$this->contract_renewal_last_date==''
              ||$this->contract_renewal_last_date=='1900-01-01')
              {

                $this->contract_renewal_last_date=null;

              }

              if($this->contract_expiry_date==null||$this->contract_expiry_date==''
              ||$this->contract_expiry_date=='1900-01-01')
              {
                $this->contract_expiry_date=null;

              }

              if (Auth::check())
              {

              //  $authenticatedUser=User::where("id",$this->Subject)->where("Class",$this->Class)->value('Number_of_periods')
              $this->user_id_of_updater=Auth::user()->id;
              $this->user_name_of_updater=Auth::user()->name;

              }
              else
              {

                $this->user_id_of_updater=Auth::guard('admin')->user()->id;
                $this->user_name_of_updater=Auth::guard('admin')->user()->name;
              }

               $data=[
                 'cid'=>$this->cid,
                 'employment_type'=>$this->employment_type,
                 'eid'=>$this->eid,
                 'agency'=>$this->agency,
                 'occupational_group'=>$this->occupational_group,
                 'occupational_subgroup'=>$this->occupational_subgroup,
                 'job_code'=>$this->job_code,
                 'service_join_date'=>$this->service_join_date,
                 'current_school_join_date'=>$this->current_school_join_date,
                 'tpn'=>$this->tpn,
                 'gis_no'=>$this->gis_no,
                 'nppf_no'=>$this->nppf_no,
                 'bobacc_no'=>$this->bobacc_no,
                 'contract_renewal_last_date'=>$this->contract_renewal_last_date,
                 'contract_expiry_date'=>$this->contract_expiry_date,

                 'user_id_of_updater'=>$this->user_id_of_updater,
                 'user_name_of_updater'=>$this->user_name_of_updater,
               ];
              // dd($data);

               if($this->modelId)

               {
                 $this->validate([
                   'cid'=>'required|numeric',
                   'employment_type'=>'required|string',
                   'eid'=>'numeric',
                   'agency'=>'string|required',
                   'occupational_group'=>'required|string',
                   'occupational_subgroup'=>'required|string',
                   'job_code'=>'required|string',
                   'service_join_date'=>'required|date',
                   'current_school_join_date'=>'required|date',
                   'tpn'=>'required|alpha_num',
                   'gis_no'=>'string|numeric',
                   'nppf_no'=>'required|numeric',
                   'bobacc_no'=>'required|string|numeric',
                   'contract_renewal_last_date'=>'required_unless:employment_type,Permanent|date|nullable',
                   'contract_expiry_date'=>'required_unless:employment_type,Permanent|date|nullable',
                  ]);

                 staffCurrentEmploymentDetails::find($this->modelId)->update($data);
                // $this->cleanVars();
                 session()->flash('message', 'The promotion details of the staff has been updated successfully');
                 $this->emit('Storefinished');
               }
               else
               {

                 $this->validate([
                   'cid'=>'required|numeric|unique:staff_current_employment_details',
                   'employment_type'=>'required|string',
                   'eid'=>'numeric|unique:staff_current_employment_details',
                   'agency'=>'string|required',
                   'occupational_group'=>'required|string',
                   'occupational_subgroup'=>'required|string',
                   'job_code'=>'required|string',
                   'service_join_date'=>'required|date',
                   'current_school_join_date'=>'required|date',
                   'tpn'=>'required|alpha_num|unique:staff_current_employment_details',
                   'gis_no'=>'string|numeric|unique:staff_current_employment_details',
                   'nppf_no'=>'required|numeric|unique:staff_current_employment_details',
                   'bobacc_no'=>'required|string|numeric|unique:staff_current_employment_details',
                   'contract_renewal_last_date'=>'required_unless:employment_type,Permanent|date|nullable',
                   'contract_expiry_date'=>'required_unless:employment_type,Permanent|date|nullable',
                  ]);

                 staffCurrentEmploymentDetails::create($data);
                 session()->flash('message', 'The promtion details of the staff has been successfully saved');
               }

                  $this->emit('Storefinished');

            }
public function getModelId($modelId)
                {


                  $this->modelId=$modelId;
                  $model=staffCurrentEmploymentDetails::find($this->modelId);
                  $this->cid=$model->cid;
                  $this->employment_type=$model->employment_type;
                  $this->eid=$model->eid;
                  $this->agency=$model->agency;
                  $this->occupational_group=$model->occupational_group;
                  $this->occupational_subgroup=$model->occupational_subgroup;
                  $this->job_code=$model->job_code;
                  $this->service_join_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->service_join_date)->format('Y-m-d');
                  $this->current_school_join_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->current_school_join_date)->format('Y-m-d');
                  $this->tpn=$model->tpn;
                  $this->gis_no=$model->gis_no;
                  $this->nppf_no=$model->nppf_no;
                  $this->bobacc_no=$model->bobacc_no;
                  if($model->contract_renewal_last_date==null)
                  {
                    $this->contract_renewal_last_date=Carbon::createFromFormat('Y-m-d H:i:s','1900-1-1 00:00:00')->format('Y-m-d');

                  }
                  else
                  {
                      $this->contract_renewal_last_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->contract_renewal_last_date)->format('Y-m-d');
                  }
                  if($model->contract_expiry_date==null)
                  {
                    $this->contract_expiry_date=Carbon::createFromFormat('Y-m-d H:i:s','1900-1-1 00:00:00')->format('Y-m-d');
                  }
                  else
                  {
                      $this->contract_expiry_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->contract_expiry_date)->format('Y-m-d');
                  }
                  //$this->contract_renewal_last_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->contract_renewal_last_date)->format('Y-m-d');

                  //$this->contract_expiry_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->contract_expiry_date)->format('m/d/Y');

                }
public function selectItem($itemId,$action)
            {
                $this->errorsImport=null;// this to make the excel import null
              $this->selectedItem=$itemId;
              if($action=='delete')
              {
                //this will show the delete confirmation modal in the front end
                $this->emit('showDeleteConfirmBox');
              }
              else
              {
                  $this->emit('getModelId',$this->selectedItem);
                  $this->emit('showModalAgainForUpdate');

              }
            }
//funtion to delete a particular record
public function delete()
               {
                   staffCurrentEmploymentDetails::find($this->selectedItem)->delete();
                   session()->flash('message', 'Record Deleted Successfully.');
                   //$this->cleanVars();
                   $this->emit('DeleteFinished');
               }
//function to export table to excel
public function exportExcel()
                   {
                     if($this->sortDesc)
                     {
                       $sortOrder='desc';
                     }
                     else {
                       $sortOrder='asc';
                     }
                   //  dd($this->search,$this->sortfield, $sortOrder);
                 return Excel::download(new StaffCurrentEmploymentDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Employment_Details.xlsx');

                   }
  //function to import excel data to the database
 public function importExcel()
                       {


                         $this->validate([
                             'excelfile' => 'required|max:50000|mimes:xlsx,xls',
                         ]);

                         if(!empty($this->excelfile))
                         {

                           $this->excelfile->store('public/excelfiles/staff');
                           $this->filelocation= 'public/excelfiles/staff/'.$this->excelfile->hashName();
                         }




                           //Excel::import(new StaffDetailsImport,$this->filelocation);
                           //(new StaffDetailsImport)->import($this->filelocation);
                           $import=new staffCurrrentEmploymentDetailsImport;
                           $import->import($this->filelocation);
                           //dd($import->errors());
                           //dd($import->failures());
                           if($import->failures()->isNotEmpty())
                           {

                           $this->errorsImport=$import->failures()->toArray();
                           }
                         $this->cleanVars();
                            session()->flash('message', 'The import operation completed');
                            session()->flash('errorsImport',  $this->errorsImport);
                            $this->emit('finishedImporting');

                       }
private function cleanVars()
            {
              // $this->cid=null;
               $this->employment_type=null;
               $this->eid=null;
               $this->agency=null;
               $this->occupational_group=null;
               $this->occupational_subgroup=null;
               $this->job_code=null;
               //$this->service_join_date=null;
               //$this->current_school_join_date=null;
               $this->tpn=null;
               $this->gis_no=null;
               $this->nppf_no=null;
               $this->bobacc_no=null;
               //$this->contract_renewal_last_date=null;
               //$this->contract_expiry_date=null;
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
}
