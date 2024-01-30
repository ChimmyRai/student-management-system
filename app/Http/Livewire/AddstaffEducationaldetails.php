<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\educationaldetailofstaff;
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
use App\Imports\staffEducationalDetailsImport;
use App\Exports\StaffEducationalDetailsExport;
class AddstaffEducationaldetails extends Component
{

  use WithPagination;
  use WithFileUploads;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='educationaldetailofstaffs.created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $selectedItem;
  public $Staff_in_list;
  public $staff_name_from_list;
  public $filelocation;
  public $excelfile;
  public $errorsImport;
  public $modelId;
  public $user_id_of_updater;
  public $user_name_of_updater;
  public $cid;
  public $academic_qualification;
  public $subject_specialization;
  public $trc_subject;
  protected $listeners=['getModelId'];
public function render()
    {
      $educaitonalDetailsList=educationaldetailofstaff::search_educationaldetailstoleftjoinstaffdetails($this->search)->leftJoin('staffdetails', 'educationaldetailofstaffs.cid', '=', 'staffdetails.cid')
      ->select('educationaldetailofstaffs.*','staffdetails.img_location','staffdetails.Name')->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Staff_in_list=staffdetail::all();
      return view('livewire.addstaff-educationaldetails',['educaitonalDetailsList'=>$educaitonalDetailsList])->layout('layouts.sbadmin');

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
      $model=educationaldetailofstaff::find($this->modelId);
      //dd($model->start_date);
      $this->cid=$model->cid;
      $this->academic_qualification=$model->academic_qualification;
      $this->subject_specialization=$model->subject_specialization;
      $this->trc_subject=$model->trc_subject;


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
               educationaldetailofstaff::find($this->selectedItem)->delete();
               session()->flash('message', 'Educatinal Detail Of the staff Deleted Successfully.');
               $this->cleanVars();
               $this->emit('DeleteFinished');
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
                   $import=new staffEducationalDetailsImport;
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


public function store()
    {

      if (Auth::check())
           {

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
                    'academic_qualification'=>$this->academic_qualification,
                    'subject_specialization'=>$this->subject_specialization,
                    'trc_subject'=>$this->trc_subject,

                    'user_id_of_updater'=>$this->user_id_of_updater,
                    'user_name_of_updater'=>$this->user_name_of_updater,
                    ];
                   // dd($data);

        if($this->modelId)

              {
                  $this->validate([
                           'cid'=>'required|string|numeric',
                           'academic_qualification'=>'required|nullable|string',
                           'subject_specialization'=>'required|nullable|string',
                           'trc_subject'=>'required|nullable|string',

                       ]);
                      educationaldetailofstaff::find($this->modelId)->update($data);
                      $this->cleanVars();
                      session()->flash('message', 'The educational details of the staff has been updated successfully');
                      $this->emit('Storefinished');
              }
        else
              {
                      $this->validate([
                        'cid'=>'required|string|numeric|unique:educationaldetailofstaffs',
                        'academic_qualification'=>'required|nullable|string',
                        'subject_specialization'=>'required|nullable|string',
                        'trc_subject'=>'required|nullable|string',

                       ]);
                      educationaldetailofstaff::create($data);
                      session()->flash('message', 'The educational details of the staff has been successfully saved');
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
  return Excel::download(new StaffEducationalDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Educational_Details.xlsx');
      
      }
private function cleanVars()
      {
            $this->position_title=null;
            $this->academic_qualification=null;
            $this->subject_specialization=null;
            $this->trc_subject=null;

              }
}
