<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\staffPromotionDetails;
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
use App\Imports\staffPromotionDetailsImport;
use App\Exports\StaffPromotionDetailsExport;
class Addstaffpromotiondetails extends Component
{
  use WithPagination;
  use WithFileUploads;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='staff_promotion_details.created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $selectedItem;
  public $Staff_in_list;
  public $filelocation;
  public $excelfile;
  public $errorsImport;
  public $modelId;
  public $cid;
  public $grade;
  public $position_level;
  public $position_title;
  public $promotion_date;
  public $promotion_type;
  public $user_id_of_updater;
  public $user_name_of_updater;
  protected $listeners=['getModelId'];
    public function render()
    {
      $promotionDetailsList=staffPromotionDetails::search_staffpromotiondetailstoleftjoinstaffdetails($this->search)->leftJoin('staffdetails', 'staff_promotion_details.cid', '=', 'staffdetails.cid')
      ->select('staff_promotion_details.*','staffdetails.img_location','staffdetails.Name')->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Staff_in_list=staffdetail::all();
    //dd($employmentDetailsList->pluck('start_date'));
      return view('livewire.addstaffpromotiondetails',['promotionDetailsList'=>$promotionDetailsList])->layout('layouts.sbadmin');
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
      $model=staffPromotionDetails::find($this->modelId);
      $this->cid=$model->cid;
      $this->position_title=$model->position_title;
      $this->position_level=$model->position_level;
      $this->grade=$model->grade;
      $this->promotion_date=Carbon::createFromFormat('Y-m-d H:i:s',$model->promotion_date)->format('Y-m-d');;
      $this->promotion_type=$model->promotion_type;
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
               staffPromotionDetails::find($this->selectedItem)->delete();
               session()->flash('message', 'Promotion Detail Deleted Successfully.');
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
             'position_title'=>$this->position_title,
             'position_level'=>$this->position_level,
             'grade'=>$this->grade,
             'promotion_date'=>$this->promotion_date,
             'promotion_type'=>$this->promotion_type,

             'user_id_of_updater'=>$this->user_id_of_updater,
             'user_name_of_updater'=>$this->user_name_of_updater,
           ];
          // dd($data);

           if($this->modelId)

           {
             $this->validate([
                  'cid'=>'required|string|numeric',
                  'position_title'=>'nullable|string',
                  'position_level'=>'nullable|string',
                  'grade'=>'nullable',
                  'promotion_date'=>'required|date',
                  'promotion_type'=>'required|string',

              ]);
             staffPromotionDetails::find($this->modelId)->update($data);
             $this->cleanVars();
             session()->flash('message', 'The promotion details of the staff has been updated successfully');
             $this->emit('Storefinished');
           }
           else
           {
             $this->validate([
               'cid'=>'required|string|numeric',
               'position_title'=>'nullable|string',
               'position_level'=>'nullable|string',
               'grade'=>'nullable|string',
               'promotion_date'=>'required|date',
               'promotion_type'=>'required|string',

              ]);
             staffPromotionDetails::create($data);
             session()->flash('message', 'The promtion details of the staff has been successfully saved');
           }

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
                $import=new staffPromotionDetailsImport;
                $import->import($this->filelocation);
                //dd($import->errors());
                //dd($import->failures());
                if($import->failures()->isNotEmpty())
                {

                $this->errorsImport=$import->failures()->toArray();
                }
              //  $this->cleanVars();
                 session()->flash('message', 'The import operation completed');
                 session()->flash('errorsImport',  $this->errorsImport);
                 $this->emit('finishedImporting');

            }

//function to export table to excel
public function exportExcel()
    {  if($this->sortDesc)
      {
        $sortOrder='desc';
      }
      else {
        $sortOrder='asc';
      }
    //  dd($this->search,$this->sortfield, $sortOrder);
  return Excel::download(new StaffPromotionDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Promotion_Details.xlsx');
          
    }
    private function cleanVars()
                {
                  $this->position_title=null;
                  $this->position_level=null;
                  $this->grade=null;
                  $this->promotion_date=null;
                  $this->promotion_type=null;
                }
}
