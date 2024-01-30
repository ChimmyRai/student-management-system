<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\awarddetailofstaff;
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
use App\Imports\staffAwardDetailsImport;
use App\Exports\StaffAwardDetailsExport;
class AddstaffAwarddetails extends Component
{
  use WithPagination;
  use WithFileUploads;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='awarddetailofstaffs.created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $selectedItem;
  public $Staff_in_list;
  public $filelocation;
  public $excelfile;
  public $errorsImport;
  public $modelId;
  public $cid;
  public $award_title;
  public $award_recieve_date;
  public $user_id_of_updater;
  public $user_name_of_updater;
  protected $listeners=['getModelId'];
    public function render()
    {
      $awardDetailsList=awarddetailofstaff::search_awardsdetailstoleftjoinstaffdetails($this->search)
      ->leftJoin('staffdetails', 'awarddetailofstaffs.cid', '=', 'staffdetails.cid')
      ->select('awarddetailofstaffs.*','staffdetails.img_location','staffdetails.Name')->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Staff_in_list=staffdetail::all();
        return view('livewire.addstaff-awarddetails',['awardDetailsList'=>$awardDetailsList])->layout('layouts.sbadmin');
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
                  $model=awarddetailofstaff::find($this->modelId);
                  $this->cid=$model->cid;
                  $this->award_title=$model->award_title;
                  $this->award_recieve_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->award_recieve_date)->format('Y-m-d');

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
                           awarddetailofstaff::find($this->selectedItem)->delete();
                           session()->flash('message', 'Award Detail Deleted Successfully.');
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
                         'award_title'=>$this->award_title,
                         'award_recieve_date'=>$this->award_recieve_date,
                         'user_id_of_updater'=>$this->user_id_of_updater,
                         'user_name_of_updater'=>$this->user_name_of_updater,
                       ];
                      // dd($data);

                       if($this->modelId)

                       {
                         $this->validate([
                              'cid'=>'required|string|numeric',
                              'award_title'=>'string',
                              'award_recieve_date'=>'required|date',
                          ]);
                         awarddetailofstaff::find($this->modelId)->update($data);
                         $this->cleanVars();
                         session()->flash('message', 'The Award details of the staff has been updated successfully');
                         $this->emit('Storefinished');
                       }
                       else
                       {
                         $this->validate([
                           'cid'=>'required|string|numeric',
                           'award_title'=>'string',
                           'award_recieve_date'=>'required|date',
                          ]);
                         awarddetailofstaff::create($data);
                         session()->flash('message', 'The Award details of the staff has been successfully saved');
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
          return Excel::download(new StaffAwardDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Award_Details.xlsx');
            
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


                     $import=new staffAwardDetailsImport;
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
