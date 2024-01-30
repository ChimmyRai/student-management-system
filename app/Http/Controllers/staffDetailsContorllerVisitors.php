<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\staffdetail ;
use DataTables;
use PDF;
class staffDetailsContorllerVisitors extends Controller
{

  public function showStaffDetails($id)
  {

  $staffdetail=staffdetail::find($id);
  //dd($staffdetail);
  if(is_null($staffdetail)){
    abort(404);
  }

  return view('staffViews.showstaff',compact('staffdetail'));
  }


  public function generatePDF($id)
     {
        $staff=staffdetail::find($id)  ;
        //dd($student);
    //  return view('individual_stdinfo_pdf',compact('student'));
        $pdf = PDF::loadView('individual_staffdetail_pdf', ['staff'=>  $staff]);

       return $pdf->download('staffdetails.pdf');
     }

}
