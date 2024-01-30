<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\studentbio ;
use App\User ;
use App\Admin;
use  Livewire\WithPagination;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentDetailsImport;
use App\Exports\StudentDetailsExport;
class AddStudentDetails extends Component
{
  use WithFileUploads;
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='created_at';
  public $sortDesc=true;
  public $showperpage=10;
  public $photo;
  public $modelId;
  public $excelfile;
  public $fullclass;
  public $errorsImport;
    Public $selectedItem;
  //public fields from insert model
  public $student_code;
  public $index_number;
  public $adm_no;
  public $cid_no;
  public $Name;
  public $gender;
  public $dob;
  public $current_class;
  public $stream;
  public $current_section;
  public $village;
  public $gewog;
  public $dzongkhag;
  public $mother_name;
  public $father_name;
  public $guardian_contact;
  public $email;
  public $date_of_joining_school;
  public $class_when_joining_school;
  public $previous_schools;
  public $hostel_status;
  public $house;
  public $differently_abled;
  public $kidu_receipent;
  public $self_contact;
  public $blood_group;
  public $img_location;
  public $user_id;
  public $user_name;
  protected $listeners=['getModelId','importErrorsDisplayed' => 'unsetErrorsOfImport'];
  public function render()
  {
    $studentList=studentbio::search($this->search)->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      return view('livewire.add-student-details',['studentList'=>$studentList])->layout('layouts.sbadmin');
  }

//funtion to call that will remove all the previous excel import erros
  public function unsetErrorsOfImport()
  {
  $this->errorsImport=null;

  }
//function to call when update button in clicked and action from buttion is determined as update
public function getModelId($modelId)
{

  $this->modelId=$modelId;
  $model=studentbio::find($this->modelId);

//dfadsf
$this->student_code=$model->student_code;
$this->index_number=$model->index_number;
$this->adm_no=$model->adm_no;
$this->cid_no=$model->cid_no;
$this->Name=$model->Name;
$this->dob=Carbon::createFromFormat('Y-m-d H:i:s',$model->dob)->format('Y-m-d');
$this->gender=$model->gender;
$this->blood_group=$model->blood_group;
$this->current_class=$model->current_class;
$this->stream=$model->stream;
$this->current_section=$model->current_section;
$this->village=$model->village;
$this->gewog=$model->gewog;
$this->dzongkhag=$model->dzongkhag;
$this->mother_name=$model->mother_name;
$this->father_name=$model->father_name;
$this->guardian_contact=$model->guardian_contact;
$this->self_contact=$model->self_contact;
$this->email=$model->email;
$this->date_of_joining_school=Carbon::createFromFormat('Y-m-d H:i:s',$model->date_of_joining_school)->format('Y-m-d');
$this->class_when_joining_school=$model->class_when_joining_school;
$this->previous_schools=$model->previous_schools;
$this->hostel_status=$model->hostel_status;
$this->house=$model->house;
$this->kidu_receipent=$model->kidu_receipent;
$this->differently_abled=$model->differently_abled;
$this->img_location=$model->img_location;
$this->user_id=$model->user_id;
$this->user_name=$model->user_name;

}
//this funciton is for the real time validation of the selected photo
  public function updatedPhoto()
  {
      $this->validate([
          'photo' => 'mimes:png,jpg,jpeg,bmp,gif|max:1024', // 1MB Max
      ]);


  }

//funciton evoked when update or delete button is clicked
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
       studentbio::find($this->selectedItem)->delete();
       session()->flash('message', 'Record Deleted Successfully.');
       $this->cleanVars();
       $this->emit('DeleteFinished');
   }


//this function stores the user entered through the create model
public function store()
{
  //dd($this->photo);

  if (Auth::check())
  {

  //  $authenticatedUser=User::where("id",$this->Subject)->where("Class",$this->Class)->value('Number_of_periods')
  $this->user_id=Auth::user()->id;
  $this->user_name=Auth::user()->name;

  }
  else
  {

    $this->user_id=Auth::guard('admin')->user()->id;
    $this->user_name=Auth::guard('admin')->user()->name;
  }


if($this->stream=="General")
{
  $this->fullclass=$this->current_class;
}
else
{
  $this->fullclass=$this->current_class." ".$this->stream;
}

if(!empty($this->photo))
{

  $this->photo->store('public/images/student');
  $this->img_location=  $this->photo->hashName();

}

   $data=[
     'student_code'=>$this->student_code,
     'index_number'=>$this->index_number,
     'adm_no'=>$this->adm_no,
     'cid_no'=>$this->cid_no,
     'Name'=>$this->Name,
     'dob'=>$this->dob,
     'gender'=>$this->gender,
    'blood_group'=>$this->blood_group,
     'current_class'=>$this->fullclass,
     'current_section'=>$this->current_section,
     'village'=>$this->village,
     'gewog'=>$this->gewog,
     'dzongkhag'=>$this->dzongkhag,
     'mother_name'=>$this->mother_name,
     'father_name'=>$this->father_name,
     'guardian_contact'=>$this->guardian_contact,
     'self_contact'=>$this->self_contact,
     'email'=>$this->email,
     'date_of_joining_school'=>$this->date_of_joining_school,
     'class_when_joining_school'=>$this->class_when_joining_school,
     'previous_schools'=>$this->previous_schools,
     'hostel_status'=>$this->hostel_status,
     'house'=>$this->house,
      'kidu_receipent'=>$this->kidu_receipent,
      'differently_abled'=>$this->differently_abled,
     'img_location'=>$this->img_location,
     'user_id'=>$this->user_id,
     'user_name'=>$this->user_name,

   ];

   if($this->modelId)

   {

     $this->validate([
       'photo' => 'nullable|image|max:1024', // 1MB Max
       'student_code'=>'required',
       'index_number'=>'required',
       'adm_no'=>'required',
       'Name'=>'required|string',
       'dob'=>'required|date',
       'gender'=>'required',
       'blood_group'=>'required',
       'current_class'=>'required',
       'current_section'=>'required',
       'village'=>'required|string',
       'gewog'=>'required|string',
       'dzongkhag'=>'required|string',
       'mother_name'=>'string|nullable',
       'father_name'=>'string|nullable',
       'guardian_contact'=>'required|regex:^\d+(,\d+)*$^',
        'self_contact'=>'regex:^\d+(,\d+)*$^',
       'email'=>'required|email',
       'date_of_joining_school'=>'required|date',
       'class_when_joining_school'=>'required|numeric',
       'previous_schools'=>'nullable|string',
       'hostel_status'=>'required|string',
       'house'=>'required|string',
       'kidu_receipent'=>'required|string',
       'differently_abled'=>'required|string',
       'img_location'=>'string|nullable',


      ]);
     studentbio::find($this->modelId)->update($data);
        $this->cleanVars();
     session()->flash('message', 'The Students details has been updated successfully');
      $this->emit('Storefinished');
   }
   else
   {
     $this->validate([
          'photo' => 'nullable|image|max:1024', // 1MB Max
          'student_code'=>'required|unique:studentbios|regex:/^[0-9]+(\.[0-9]+)+$/',
          'index_number'=>'required|unique:studentbios|regex:/^\d+$/',
          'adm_no'=>'required',
          'Name'=>'required|string',
          'dob'=>'required|date',
          'gender'=>'required',
          'blood_group'=>'required',
          'current_class'=>'required',
          'current_section'=>'required',
          'village'=>'required|string',
          'gewog'=>'required|string',
          'dzongkhag'=>'required|string',
          'mother_name'=>'string|nullable',
          'father_name'=>'string|nullable',
          'guardian_contact'=>'required|regex:^\d+(,\d+)*$^',
           'self_contact'=>'regex:^\d+(,\d+)*$^',
          'email'=>'required|email',
          'date_of_joining_school'=>'required|date',
          'class_when_joining_school'=>'required|numeric',
          'previous_schools'=>'nullable|string',
          'hostel_status'=>'required|string',
          'house'=>'required|string',
          'kidu_receipent'=>'required|string',
          'differently_abled'=>'required|string',
          'img_location'=>'string|nullable',


      ]);


     studentbio::create($data);
      $this->cleanVars();
     session()->flash('message', 'The Student details has been successfully saved');
       $this->emit('Storefinished');
   }

}
//funtion to redirect to show individual ldap_control_paged_result

public function showStudentDetailsIndividual($id)
     {


    //return redirect('staffdetail.show',compact('staff'));
  //  return redirect()->route('/searchstaffdetails/'.$id);
  redirect()->to('/searchstudents/'.$id);
     }

//function to import excel data to the database
public function importExcel()
    {


      $this->validate([
          'excelfile' => 'required|max:50000|mimes:xlsx,xls',
      ]);

      if(!empty($this->excelfile))
      {

        $this->excelfile->store('public/excelfiles/student');
        $this->filelocation= 'public/excelfiles/student/'.$this->excelfile->hashName();
      }




        //Excel::import(new StaffDetailsImport,$this->filelocation);
        //(new StaffDetailsImport)->import($this->filelocation);
        $import=new StudentDetailsImport;
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
{
  if($this->sortDesc)
  {
    $sortOrder='desc';
  }
  else {
    $sortOrder='asc';
  }
//  dd($this->search,$this->sortfield, $sortOrder);
return Excel::download(new StudentDetailsExport($this->search,$this->sortfield, $sortOrder), 'Student_Details.xlsx');

}
//funtion for sorting data depending on the sorting field and asc or desc
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

//clean your variables
    private function cleanVars()
            {
              $this->student_code=null;
              $this->index_number=null;
              $this->adm_no=null;
              $this->cid_no=null;
              $this->Name=null;
              $this->dob=null;
              $this->gender=null;
              $this->blood_group=null;
              $this->current_class=null;
              $this->stream=null;
              $this->current_section=null;
              $this->village=null;
              $this->gewog=null;
              $this->dzongkhag=null;
              $this->mother_name=null;
              $this->father_name=null;
              $this->guardian_contact=null;
              $this->self_contact=null;
              $this->email=null;
              $this->date_of_joining_school=null;
              $this->class_when_joining_school=null;
              $this->previous_schools=null;
              $this->hostel_status=null;
              $this->house=null;
              $this->kidu_receipent=null;
              $this->differently_abled=null;
              $this->img_location=null;

            }

}
