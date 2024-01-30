<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\resulthighersci ;
use App\resultHigherCom ;
use App\resultHigherArts ;
use App\resultmiddle ;
use App\resultlower ;
use App\User ;
use App\Admin;
use  Livewire\WithPagination;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\resultHigherArtsExport;
use App\Exports\resultHigherComExport;
use App\Exports\resultHigherSciExport;
use App\Exports\resultMiddleExport;
use App\Exports\resultLowerExport;
class DownloadResult extends Component
{
  public $classlevel='Lower';
  public $classlist=[];
//  public $sectionlist;
  public $selectedClass;
  //  public $selectedSection;


    public function render()
    {

      if(!empty($this->classlevel)) {
        if($this->classlevel=='Lower')
        {
         $this->classlist=resultlower::select('class','section')->groupBy('class')->get();
        }
        elseif($this->classlevel=='Middle')
        {
           $this->classlist=resultmiddle::select('class','section')->groupBy('class')->get();

        }
        elseif($this->classlevel=='Higher Science')
        {
            $this->classlist=resulthighersci::select('class','section')->groupBy('class')->get();
        }
        elseif($this->classlevel=='Higher Arts')
        {
            $this->classlist=resultHigherArts::select('class','section')->groupBy('class')->get();
        }
        elseif($this->classlevel=='Higher Commerce')
        {
            $this->classlist=resultHigherCom::select('class','section')->groupBy('class')->get();
        }
        else
        {
          $this->classlist=$this->classlist;

        }
       }

        return view('livewire.download-result',['classlist'=>$this->classlist])->layout('layouts.sbadmin');
    }//end of render( ) function




public function download()
{

  $class = preg_replace('/[^0-9]/', '', $this->selectedClass);
  $section =trim(str_replace($class,"", $this->selectedClass));
if($class==null||$section==null||$class==''||$section==''||$class==' '||$section==' '){
  session()->flash('errormessage', 'The download  operation could not be completed because class is not selected');
}
else{
  if($this->classlevel=='Lower')
  {
    return Excel::download(new resultLowerExport($class,$section),$this->selectedClass.' result.xlsx');
  }
  elseif($this->classlevel=='Middle')
  {
      return Excel::download(new resultMiddleExport($class,$section),$this->selectedClass.' result.xlsx');

  }
  elseif($this->classlevel=='Higher Science')
  {
      return Excel::download(new resultHigherSciExport($class,$section),$this->selectedClass.' result.xlsx');
  }
  elseif($this->classlevel=='Higher Arts')
  {
      return Excel::download(new resultHigherArtsExport($class,$section),$this->selectedClass.' result.xlsx');
  }
  elseif($this->classlevel=='Higher Commerce')
  {
      return Excel::download(new resultHigherComExport($class,$section),$this->selectedClass.' result.xlsx');
  }
  else
  {
    session()->flash('errormessage', 'The download  operation could not be completed because level is not selected');

  }
}

}



}
