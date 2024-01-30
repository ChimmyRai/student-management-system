<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\period ;
use App\User ;
use App\AllocatedSubject ;
use  Livewire\WithPagination;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SubjectAllocationForm extends Component
{
  //use WithPagination;
 use WithPagination;
 protected $paginationTheme = 'bootstrap';
 public $search='';
 public $sortfield='created_at';
 public $sortDesc=true;
//public $allocatedList;
  Public $showperpage=10;
  Public $Users_in_list;
  public $Subjects_in_list;
  public $Class_in_list;
  public $SectionList=['A','B','C','D','F','G','H','Sci A','Sci B','Sci C','Arts A','Arts B','Arts C','Com A','Com B'];
public $Admin_ID;
  public $User_ID;
  public $Name_of_teacher;
  public $Section;
  public $Subject;
  public $Class;
  public $Number_of_periods;

  protected $rules = [
    'Admin_ID' => 'required',
    'User_ID' => 'required',

    'Section'=>'required',
    'Subject'=>'required',
    'Class'=>'required',
    'Number_of_periods'=>'required',
   ];




   public function render()
   {

     //$Users_in_list=User::all('id','name');
     //$Subjects_in_list=period::select('Subject')->groupBy('Subject')->get();
     //$Class_in_list=period::select('Class')->groupBy('Class')->get();
 $allocatedList=AllocatedSubject::search($this->search)->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
 $this->Users_in_list=User::all();
 $this->Subjects_in_list=period::select('Subject')->groupBy('Subject')->get();
 $this->Class_in_list=period::select('Class')->groupBy('Class')->get();
 return view('livewire.subject-allocation-form',['allocatedList'=>$allocatedList])->layout('layouts.sbadmin');

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
  'Admin_ID'=>Auth::guard('admin')->user()->id,
  'User_ID'=>$this->User_ID,
  'Name_of_teacher'=>User::where("id",$this->User_ID)->value("name"),
  'Section'=>$this->Section,
  'Subject'=>$this->Subject,
  'Class'=>$this->Class,
  'Number_of_periods'=>period::where("Subject",$this->Subject)->where("Class",$this->Class)->value('Number_of_periods'),
];

//dd($data);
if (AllocatedSubject::where('User_ID','=',$this->User_ID)->where('Subject', '=', $this->Subject)
                                                         ->where('Class', '=', $this->Class)
                                                         ->where('Section', '=', $this->Section)
                                                         ->count() > 0)
    {
// user found
  session()->flash('errormessage', 'The subject is already alllcocated');
  $this->emit('userStore');
  return view('livewire.subject-allocation-form');
    }
          AllocatedSubject::create($data);


        session()->flash('message', 'Subject successfully allocated to the teacher.');
        $this->emit('userStore');
        //  $this->resetInputFields();
    //      $this->emit('refreshComponent'); // Close model to using to jquery



      }


public function delete($id)
   {
       AllocatedSubject::find($id)->delete();
       session()->flash('message', 'Data Deleted Successfully.');
         $this->emit('userDeleted');
   }




}
