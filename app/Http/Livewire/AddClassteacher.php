<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\User ;
use App\Admin;
use App\classteacher;
use App\period;
use  Livewire\WithPagination;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClassteacherImport;
use App\Exports\classteacher_detailsExport;
class AddClassteacher extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search='';
    public $sortfield='created_at';
    public $sortDesc=true;
    public $showperpage=10;
    public $selectedItem;
    Public $Users_in_list;
    public $Class;
    public $Section;
    public $Class_in_list;
    public $SectionList=['A','B','C','D','F','G','H','Science A','Science B','Science C','Science D','Arts A','Arts B','Arts C','Arts D','Commerce','Commerce A','Commerce B','Commerce C','Commerce D'];
    //public $classTeache
    public $user_id_of_teacher;
    public $Name_of_teacher;
    public $filelocation;
    public $excelfile;
    public $errorsImport;
    protected $listeners=['importErrorsDisplayed' => 'unsetErrorsOfImport'];
    public function render()
    {


      $classTeacherList=classteacher::search($this->search)->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      $this->Users_in_list=User::all();
      $this->Class_in_list=period::select('Class')->groupBy('Class')->get();
        return view('livewire.add-classteacher',['classTeacherList'=>  $classTeacherList])->layout('layouts.sbadmin');
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

    public function store()
        {


          //  $validatedData = $this->validate();
  $data=[


    'user_id_of_teacher'=>$this->user_id_of_teacher,
    'Name_of_teacher'=>User::where("id",$this->user_id_of_teacher)->value("name"),
    'Class'=>$this->Class,
    'Section'=>$this->Section,
    'user_id_of_updater'=>Auth::guard('admin')->user()->id,
  ];


  $this->validate([
       'user_id_of_teacher'=>'required|numeric|unique:classteachers'
   ]);
   if (classteacher::where('Class', '=', $this->Class)->where('Section', '=', $this->Section)->count() > 0)
       {
   // user found
     session()->flash('errormessage', 'These section is already allocated a class teacher');
     $this->emit('storecouldnotbeconpletedbecauseofduplicate');
     return view('livewire.subject-allocation-form');
       }
            classteacher::create($data);


          session()->flash('message', 'Class teacher successfully allocated for the class.');
          $this->emit('Storefinished');
          //  $this->resetInputFields();
      //      $this->emit('refreshComponent'); // Close model to using to jquery



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

        public function delete()
           {
               classteacher::find($this->selectedItem)->delete();
               session()->flash('message', 'Record Deleted Successfully.');
              // $this->cleanVars();
               $this->emit('DeleteFinished');
           }

           public function importExcel()
               {


                 $this->validate([
                     'excelfile' => 'required|max:50000|mimes:xlsx,xls',
                 ]);


                 if(!empty($this->excelfile))
                 {

                   $this->excelfile->store('public/excelfiles/class teacher');
                   $this->filelocation=  'public/excelfiles/class teacher/'.$this->excelfile->hashName();
                 }

                   $import=new ClassteacherImport;
                   $import->import($this->filelocation);

                   if($import->failures()->isNotEmpty())
                   {

                     $this->errorsImport=$import->failures()->toArray();

                   }

                    session()->flash('message', 'The import operation completed');
                    session()->flash('errorsImport',  $this->errorsImport);
                    $this->emit('finishedImporting');

               }

               public function unsetErrorsOfImport()
               {
               $this->errorsImport=null;

               }

               public function exportExcel()
               {

                 return Excel::download(new classteacher_detailsExport($this->search), 'class_teacher_details.xlsx');
               }
}
