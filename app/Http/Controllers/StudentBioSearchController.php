<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\studentbio;
use DataTables;
use PDF;
class StudentBioSearchController extends Controller
{
//function to show individual student details. this is linked from addstudnet livewire data table page
public function showStudentDetails($id)
{
$student=studentbio::find($id);

if(is_null($student)){
  abort(404);
}

return view('studentViews.showstudent',compact('student'));
}

//this function to used to load individual student show page to pdf file
public function generatePDF($id)
   {
      $student=studentbio::find($id)  ;
      //dd($student);
  //  return view('individual_stdinfo_pdf',compact('student'));
      $pdf = PDF::loadView('individual_stdinfo_pdf', ['student'=>  $student]);

     return $pdf->download('studentdetails.pdf');
   }



}
