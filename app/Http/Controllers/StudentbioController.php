<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\studentbio;
use DataTables;
class StudentbioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
       {
           $this->middleware('auth:web,admin');
       }


    public function index(Request $request)
    {
      if ($request->ajax()) {
          $data = studentbio::latest()->get();
          return Datatables::of($data)
                  ->addIndexColumn()
                  ->setRowId('id')
                  ->addColumn('action', function($row) {
                         $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">edit</a>';
                         $btn.='&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" class="delete btn btn-danger btn-sm">delete</a>';
                         return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
      }

      return view('studentstableshowauthenticatedusers');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('studentViews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\HTTP\Requests\CreateStudentRequest $request)
    {
       $std= new \App\Studentbio;

        //image upload statements

        $indexnumber=$request->get('index_number');
        $image = $request->file('image');
        $input['imagename'] = $indexnumber.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/student');
      if($image->move($destinationPath, $input['imagename']))
      {
          $std->img_location =$input['imagename'];
            session()->flash('upload_success','Image Upload successful');

      }
      else
      {
        session()->flash('upload_failure','Something went wrong with image upload');
      }
        //$this->postImage->add($input);


        //end of image upload statements
        $std->student_code = $request->student_code;
        $std->index_number = $request->index_number;
        $std->adm_no = $request->adm_no;
        $std->Name = $request->Name;
        $std->gender = $request->gender;
        $std->dob = $request->dob;
        $std->village = $request->village;
        $std->gewog = $request->gewog;
        $std->dzongkhag = $request->dzongkhag;
        $std->mother_name = $request->mother_name;
        $std->father_name = $request->father_name;
        $std->father_occupation = $request->father_occupation;
        $std->mother_occupation = $request->mother_occupation;
        $std->guardian_contact = $request->guardian_contact;
        $std->email = $request->email;
        $std->date_of_joining_school = $request->date_of_joining_school;
        $std->class_when_joining_school = $request->class_when_joining_school;
        $std->current_class = $request->current_class;
        $std->current_section = $request->current_section;
       $std->previous_schools = $request->previous_schools;
        $std->hostel_status = $request->hostel_status;
        $std->house = $request->house;
        $std->user_id = \Auth::id(); //add the authenticated user id to "user_id" column.
        $std->user_name=\Auth::user()->name;//add the authenticated user name to "user_name" column.
        $std->save();
        session()->flash('flash_msg','Student is successfully added');

        //\Session::flash('flash_msg','Student is successfully added');
         return redirect()->action('StudentbioController@create');
    }





/**
*display the search page


**/

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $studentbio=studentbio::findorfail($id);
        return view('studentViews.updatestudentview',compact('studentbio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\HTTP\Requests\CreateStudentRequest $request, $id)
    {
      $studentbio=studentbio::findorfail($id);
      $indexnumber=$request->get('index_number');
      $oldindexnumber=$studentbio->index_number;
      //dd($oldindexnumber);
      //code to get change the image
      if ($request->hasFile('image'))
       {

        $image = $request->file('image');
        $input['imagename'] = $indexnumber.'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/student');
        if($image->move($destinationPath, $input['imagename']))
        {
          session()->flash('upload_success','Image change successful');
          $imglocation=$input['imagename'];
             $myNewData = $request->request->add(['img_location' => $imglocation]);
            session()->flash('img_change','New image successfully uploaded');
        }

          }
          else
          {
            if($indexnumber!=$oldindexnumber){
            $oldprofileimagepath=public_path('images/student/').$studentbio->img_location;
              $oldprofileimage=str_replace(DIRECTORY_SEPARATOR,'/', $oldprofileimagepath);
          //dd($oldprofileimage);
            $newprofileimagepath=public_path('images/student/').$indexnumber.'.jpg';
            $newprofileimage=str_replace(DIRECTORY_SEPARATOR,'/', $newprofileimagepath);
            //dd($newprofileimage);
            if(rename($oldprofileimage, $newprofileimage))
            {
              $studentbio->img_location =$indexnumber.'.jpg';
                session()->flash('img_change','Image name has been successfully changed');
            }
          else
          {
          dd("Something went wrong in image change");
          }
        }

          }
          $studentbio->user_id = \Auth::id(); //add the authenticated user id to "user_id" column.
          $studentbio->user_name=\Auth::user()->name.'(updated)';//add the authenticated user name to "user_name" column.
      //end of code to change the image
        if($studentbio->update($request->all()))
        {
          session()->flash('flash_msg','Student Details successfully updated');
        }
        else {
          {
            dd("Update not working");
          }
        }
        return redirect('studentbio');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      studentbio::find($id)->delete();

        return response()->json(['success'=>'Record deleted successfully.']);
    }//end of detroy function
}
