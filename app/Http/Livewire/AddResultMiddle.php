<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\resultmiddle ;
use App\User ;
use App\Admin;
use  Livewire\WithPagination;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MiddleResultImport;
use App\Exports\resultMiddleQueryExport;
class AddResultMiddle extends Component
{
  use WithFileUploads;
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='created_at';
  public $sortDesc=true;
  Public $showperpage=10;
  public $excelfile;
  public $filelocation;
  public $errorsImport;
  public $user_id_of_updater;
  public $user_name_of_updater;
  public $resultClassList;
  public $resultSectionList;
  public $selectedClass;
  public $selectedSection;

public function render()
    {
      $this->resultClassList=resultmiddle::select('class')->groupBy('class')->get();
      $this->resultSectionList=resultmiddle::select('section')->groupBy('section')->get();
      $result=resultmiddle::search($this->search)->where('user_id_of_updater','=',Auth::user()->id)->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      return view('livewire.add-result-middle',['result'=>$result,'resultClassList'=>$this->resultClassList,'resultSectionList'=>$this->resultSectionList])->layout('layouts.sbadmin');
    }
public function importExcel()
        {
          $this->validate([
              'excelfile' => 'required|max:50000|mimes:xlsx,xls',
          ]);

          if(!empty($this->excelfile))
          {

            $this->excelfile->store('public/excelfiles/result/middle');
            $this->filelocation=  'public/excelfiles/result/middle/'.$this->excelfile->hashName();

          }

            $import=new MiddleResultImport;

            $import->import($this->filelocation);
            if($import->failures()->isNotEmpty())
            {
              $this->errorsImport=$import->failures()->toArray();
            }

            session()->flash('message', 'The import operation completed');
            session()->flash('errorsImport',  $this->errorsImport);
            $this->emit('finishedImporting');

        }
//function to export table to excel which includes search results
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
        return Excel::download(new resultMiddleQueryExport($this->search,$this->sortfield, $sortOrder), 'student_result_middle.xlsx');

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
//funtion to delete a particular class result
public function emptyresult()
     {
      // dd($this->selectedClass);
      $this->validate([
          'selectedClass'=>'required|numeric',
          'selectedSection'=>'required',
       ]);


          $query=resultmiddle::where('class',$this->selectedClass)->where('section',$this->selectedSection)->where('user_id_of_updater','=', Auth::user()->id)->delete();
          if($query){
            session()->flash('message', 'Result Details for '.$this->selectedClass.' '.$this->selectedSection.' Emptied Successfully.');
            $this->emit('DeleteFinished');
          }
          else{
            session()->flash('errormessage', 'The delete operation could not be completed. Seems like you are not the class teacher of the class you want to delete');
             $this->emit('DeleteFinished');

          }
            }

}
