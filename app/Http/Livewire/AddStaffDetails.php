<?php

namespace App\Http\Livewire;

use Livewire\Component;
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
use App\Imports\StaffDetailsImport;
use App\Exports\StaffDetailsExport;
class AddStaffDetails extends Component
{
  use WithFileUploads;
  use WithPagination;
  protected $paginationTheme = 'bootstrap';
  public $search='';
  public $sortfield='created_at';
  public $sortDesc=true;
  Public $showperpage=10;
  Public $selectedItem;
  Public $action;
  public $modelId;
  public $excelfile;
  public $filelocation;
  public $photo;
  public $cid;
  public $Name;
  public $dob;
  public $gender;
  public $religion;
  public $nationality='Bhutanese';
  public $village;
  public $gewog;
  public $dzongkhag;
  public $house_no;
  public $tharm_no;
  public $phone;
  public $email;
  public $img_location;
  public $user_id_of_updater;
  public $user_name_of_updater;
  public $errorsImport;
  protected $listeners=['getModelId','importErrorsDisplayed' => 'unsetErrorsOfImport'];
  //protected $listeners = ['importErrorsDisplayed' => 'unsetErrorsOfImport'];

    public function unsetErrorsOfImport()
    {
    $this->errorsImport=null;

    }
  public function getModelId($modelId)
  {

    $this->modelId=$modelId;
    $model=staffdetail::find($this->modelId);
    $this->cid=$model->cid;
    $this->Name=$model->Name;
    $this->dob=Carbon::createFromFormat('Y-m-d H:i:s',$model->dob)->format('Y-m-d');
    $this->gender=$model->gender;
    $this->religion=$model->religion;
    $this->nationality=$model->nationality;
    $this->village=$model->village;
    $this->gewog=$model->gewog;
    $this->dzongkhag=$model->dzongkhag;
    $this->house_no=$model->house_no;
    $this->tharm_no=$model->tharm_no;
    $this->phone=$model->phone;
    $this->email=$model->email;
    $this->img_location=$model->img_location;
    $this->user_id_of_updater=$model->user_id_of_updater;
    $this->user_name_of_updater=$model->user_name_of_updater;
  }

    public function render()
    {
      $staffList=staffdetail::search($this->search)->orderBy($this->sortfield, $this->sortDesc ? 'desc':'asc')->paginate($this->showperpage);
      return view('livewire.add-staff-details',['staffList'=>$staffList])->layout('layouts.sbadmin');


    }


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'mimes:png,jpg,jpeg,bmp,gif|max:1024', // 1MB Max
        ]);


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
           staffdetail::find($this->selectedItem)->delete();
           session()->flash('message', 'Record Deleted Successfully.');
           $this->cleanVars();
           $this->emit('DeleteFinished');
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
  public function showStaffDetailsIndividual($id)
       {


      //return redirect('staffdetail.show',compact('staff'));
    //  return redirect()->route('/searchstaffdetails/'.$id);
    redirect()->to('/searchstaffdetails/'.$id);
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




       if(!empty($this->photo))
       {

         $this->photo->store('public/images/staff');
         $this->img_location=  $this->photo->hashName();
       }

       $data=[
         'cid'=>$this->cid,
         'Name'=>$this->Name,
         'dob'=>$this->dob,
         'gender'=>$this->gender,
         'religion'=>$this->religion,
         'nationality'=>$this->nationality,
         'village'=>$this->village,
         'gewog'=>$this->gewog,
         'dzongkhag'=>$this->dzongkhag,
         'house_no'=>$this->house_no,
         'tharm_no'=>$this->tharm_no,
         'phone'=>$this->phone,
         'email'=>$this->email,
         'img_location'=>$this->img_location,
         'user_id_of_updater'=>$this->user_id_of_updater,
         'user_name_of_updater'=>$this->user_name_of_updater,


       ];

       if($this->modelId)

       {
         $this->validate([
              'photo' => 'nullable|image|max:1024', // 1MB Max
              'cid'=>'required|string|numeric',
              'Name'=>'required',
              'dob'=>'required|date',
              'gender'=>'required',
              'religion'=>'required|string',
              'nationality'=>'required|string',
              'village'=>'required',
              'gewog'=>'required',
              'dzongkhag'=>'required',
              'house_no'=>'nullable|string',
              'tharm_no'=>'nullable|string',
              'phone'=>'required|string',
              'email'=>'email|nullable',

          ]);
         staffdetail::find($this->modelId)->update($data);
            $this->cleanVars();
         session()->flash('message', 'The Staff details has been updated successfully');
         $this->emit('Storefinished');
       }
       else
       {
         $this->validate([
              'photo' => 'nullable|image|max:1024', // 1MB Max
              'cid'=>'required|string|numeric|unique:staffdetails',
              'Name'=>'required',
              'dob'=>'required|date',
              'gender'=>'required',
              'religion'=>'required|string',
              'nationality'=>'required|string',
              'village'=>'required',
              'gewog'=>'required',
              'dzongkhag'=>'required',
              'house_no'=>'nullable|string',
              'tharm_no'=>'nullable|string',
              'phone'=>'required|string',
              'email'=>'email|nullable',


          ]);
         staffdetail::create($data);
           $this->cleanVars();
         session()->flash('message', 'The Staff details has been successfully saved');
       }

          $this->emit('Storefinished');

    }

    public function importExcel()
        {


          $this->validate([
              'excelfile' => 'required|max:50000|mimes:xlsx,xls',
          ]);

          if(!empty($this->excelfile))
          {

            $this->excelfile->store('public/excelfiles/student');
            $this->filelocation=  'public/excelfiles/student/'.$this->excelfile->hashName();
          }




            //Excel::import(new StaffDetailsImport,$this->filelocation);
            //(new StaffDetailsImport)->import($this->filelocation);
            $import=new StaffDetailsImport;
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
return Excel::download(new StaffDetailsExport($this->search,$this->sortfield, $sortOrder), 'Staff_Details.xlsx');

}

private function cleanVars()
        {
          $this->cid=null;
          $this->Name=null;
          $this->dob=null;
          $this->gender=null;
          $this->religion="Bhutanese";
          $this->nationality="Bhutanese";
          $this->village=null;
          $this->gewog=null;
          $this->dzongkhag=null;
          $this->house_no=null;
          $this->tharm_no=null;
          $this->phone=null;
          $this->email=null;
          $this->img_location=null;
          $this->user_id_of_updater=null;
          $this->user_name_of_updater=null;
          $this->filelocation=null;
          $this->selectedItem=null;
          $this->excelfile=null;
          $this->photo=null;
        }


}
