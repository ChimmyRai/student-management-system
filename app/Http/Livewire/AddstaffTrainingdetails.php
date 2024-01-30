<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\staffTrainingDetails;
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
use App\Imports\staffTrainingDetailsImport;
use App\Exports\StaffTrainingDetailsExport;
class AddstaffTrainingdetails extends Component
{

  use WithPagination;
  use WithFileUploads;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='staff_training_details.created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $selectedItem;
  public $Staff_in_list;
  public $filelocation;
  public $excelfile;
  public $errorsImport;
  public $modelId;
  public $cid;
  public $training_name;
  public $training_start_date;
  public $training_end_date;
  public $attendence_type;
  public $user_id_of_updater;
  public $user_name_of_updater;
  protected $listeners=['getModelId'];
public function render()
    {  $trainingDetailsList=staffTrainingDetails::search_trainingdetailstoleftjoinstaffdetails($this->search)
      ->leftJoin('staffdetails', 'staff_training_details.cid', '=', 'staffdetails.cid')
      ->select('staff_training_details.*','staffdetails.img_location','staffdetails.Name')->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Staff_in_list=staffdetail::all();
        return view('livewire.addstaff-trainingdetails',['trainingDetailsList'=>$trainingDetailsList])->layout('layouts.sbadmin');
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
              $model=staffTrainingDetails::find($this->modelId);
              $this->cid=$model->cid;
              $this->training_name=$model->training_name;
              $this->training_start_date=Carbon::createFromFormat('Y-m-d',$model->training_start_date)->format('Y-m-d');
              $this->training_end_date=Carbon::createFromFormat('Y-m-d',$model->training_end_date)->format('Y-m-d');
              $this->attendence_type=$model->attendence_type;
              //Carbon::createFromFormat('Y-m-d H:i:s',$model->date_of_joining_school)->format('Y-m-d');
            }
public function selectItem($itemId,$action)
            {
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
                       staffTrainingDetails::find($this->selectedItem)->delete();
                       session()->flash('message', 'Training Detail Deleted Successfully.');
                       $this->cleanVars();
                       $this->emit('DeleteFinished');
                   }
public function store()
                {

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
                     'training_name'=>$this->training_name,
                     'training_start_date'=>$this->training_start_date,
                     'training_end_date'=>$this->training_end_date,
                     'attendence_type'=>$this->attendence_type,


                     'user_id_of_updater'=>$this->user_id_of_updater,
                     'user_name_of_updater'=>$this->user_name_of_updater,
                   ];
                  // dd($data);

                   if($this->modelId)

                   {
                     $this->validate([
                          'cid'=>'required|string|numeric',
                          'training_name'=>'string',
                          'training_start_date'=>'required|date',
                          'training_end_date'=>'required|date',
                          'attendence_type'=>'nullable|string',

                      ]);
                     staffTrainingDetails::find($this->modelId)->update($data);
                     $this->cleanVars();
                     session()->flash('message', 'The training details of the staff has been updated successfully');
                     $this->emit('Storefinished');
                   }
                   else
                   {
                     $this->validate([
                       'cid'=>'required|string|numeric',
                       'training_name'=>'string',
                       'training_start_date'=>'required|date',
                       'training_end_date'=>'required|date',
                       'attendence_type'=>'nullable|string',

                      ]);
                     staffTrainingDetails::create($data);
                     session()->flash('message', 'The training details of the staff has been successfully saved');
                   }

                      $this->emit('Storefinished');

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
      return Excel::download(new StaffTrainingDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Training_Details.xlsx');
      
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


                 $import=new staffTrainingDetailsImport;
                $import->import($this->filelocation);

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
                $this->position_title=null;
                $this->training_name=null;
                $this->training_start_date=null;
                $this->training_end_date=null;
                $this->attendence_type=null;
                  }
}
