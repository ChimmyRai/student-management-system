<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\staffEmploymentDetails;
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
use App\Imports\staffEmplloymentDetailsImport;
use App\Exports\StaffEmploymentDetailsExport;
class AddStaffEmploymentDetails extends Component
{
  use WithPagination;
  use WithFileUploads;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='staff_employment_details.created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $selectedItem;
  public $Staff_in_list;
  public $staff_name_from_list;
  public $filelocation;
  public $excelfile;
  public $errorsImport;
  public $cid;
  public $school;
  public $dzongkhag_served;
  public $start_date;
  public $end_date;
  public $modelId;
  public $user_id_of_updater;
  public $user_name_of_updater;
  protected $listeners=['getModelId'];
    public function render()
    {

        $employmentDetailsList=staffEmploymentDetails::search_employemntdetailstoleftjoinstaffdetails($this->search)->leftJoin('staffdetails', 'staff_employment_details.cid', '=', 'staffdetails.cid')
        ->select('staff_employment_details.*','staffdetails.img_location','staffdetails.Name')->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
        $this->Staff_in_list=staffdetail::all();
      //dd($employmentDetailsList->pluck('start_date'));
        return view('livewire.add-staff-employment-details',['employmentDetailsList'=>$employmentDetailsList])->layout('layouts.sbadmin');
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
    public function getModelId($modelId)
    {

      $this->modelId=$modelId;
      $model=staffEmploymentDetails::find($this->modelId);
      //dd($model->start_date);
      $this->cid=$model->cid;
      $this->school=$model->school;
      $this->dzongkhag_served=$model->dzongkhag_served;
      $this->start_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->start_date)->format('Y-m-d');
      if($this->end_date==null)
      {
        $this->end_date=Carbon::createFromFormat('Y-m-d H:i:s','1900-1-1 00:00:00')->format('Y-m-d');

      }
      else {
          $this->end_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->end_date)->format('Y-m-d');
      }

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
               staffEmploymentDetails::find($this->selectedItem)->delete();
               session()->flash('message', 'Employment Detail Deleted Successfully.');
               $this->cleanVars();
               $this->emit('DeleteFinished');
           }

public function store()
    {
      if($this->end_date==null||$this->end_date==''
      ||$this->end_date=='1900-01-01')
      {
        $this->end_date=null;
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
         'school'=>$this->school,
         'dzongkhag_served'=>$this->dzongkhag_served,
         'start_date'=>$this->start_date,
         'end_date'=>$this->end_date,
         'user_id_of_updater'=>$this->user_id_of_updater,
         'user_name_of_updater'=>$this->user_name_of_updater,


       ];
      // dd($data);

       if($this->modelId)

       {
         $this->validate([
              'cid'=>'required|string|numeric',
              'school'=>'required|string',
              'dzongkhag_served'=>'required',
              'start_date'=>'required|date',
              'end_date'=>'date|nullable',


          ]);
         staffEmploymentDetails::find($this->modelId)->update($data);
            $this->cleanVars();
         session()->flash('message', 'The employment details of the staff has been updated successfully');
         $this->emit('Storefinished');
       }
       else
       {
         $this->validate([
              'cid'=>'required|string|numeric',
              'school'=>'required|string',
              'dzongkhag_served'=>'required',
              'start_date'=>'required|date',
              'end_date'=>'date|nullable',


          ]);
         staffEmploymentDetails::create($data);
         session()->flash('message', 'The employment details of the staff has been successfully saved');
       }
          $this->cleanVars();
          $this->emit('Storefinished');

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
            $import=new staffEmplloymentDetailsImport;
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
return Excel::download(new StaffEmploymentDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Employment_History_Details.xlsx');
    
    }

private function cleanVars()
            {
              $this->school=null;
              $this->start_date=null;
              $this->end_date=null;
            }



}
