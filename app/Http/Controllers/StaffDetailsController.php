<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\staffdetail ;
use DataTables;
use pdf;
class StaffDetailsController extends Controller
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
          $data = staffdetail::latest()->get();
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

      return view('staffstableshowauthenticatedusers');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('staffViews.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\HTTP\Requests\StoreStaffDetails $request)
    {
        $staff= new \App\staffdetail;
      //image upload statements
      $cid=$request->cid;
      //dd($cid);

      $image = $request->file('image');
      $input['imagename'] = $cid.'.'.$image->getClientOriginalExtension();

      $destinationPath = public_path('/images/staff');
    //  $image->move($destinationPath, $input['imagename']);
      if($image->move($destinationPath, $input['imagename']))
      {
          $staff->img_location =$input['imagename'];
            session()->flash('upload_success','Image Upload successful');

      }
      else
      {
        session()->flash('upload_failure','Something went wrong with image upload');
      }
      //$this->postImage->add($input);


             //end of image upload statements

               $staff->cid=$cid;
            //   dd($staff->cid);
               $staff->eid=$request->eid;
               $staff->Name=$request->Name;
               $staff->dob=$request->dob;
               $staff->gender=$request->gender;
               $staff->Nationality=$request->Nationality;
               $staff->grade=$request->grade;
               $staff->position_level=$request->position_level;
               $staff->position_title=$request->position_title;
               $staff->contact_number=$request->contact_number;
               $staff->Qualification=$request->Qualification;
               $staff->subject_specilization=$request->subject_specilization;
               $staff->date_of_appointment=$request->date_of_appointment;
               $staff->village = $request->village;
               $staff->gewog = $request->gewog;
               $staff->dzongkhag = $request->dzongkhag;
               $staff->email = $request->email;
               $staff->previous_schools_served=$request->previous_schools_served;
               $staff->user_id_of_updater = \Auth::id(); //add the authenticated user id to "user_id" column.
               $staff->user_name_of_updater=\Auth::user()->name;//add the authenticated user name to "user_name" column.
               $staff->save();
             session()->flash('flash_msg','Staff Details is successfully added');
             session()->flash('upload_success','Image Upload successful');
             //\Session::flash('flash_msg','Student is successfully added');
              return redirect()->action('StaffDetailsController@create');

    }

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
      $staffdetail=staffdetail::findorfail($id);
        return view('staffViews.updatestaffview',compact('staffdetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\App\HTTP\Requests\StoreStaffDetails $request, $id)
    {
      $staffdetail=staffdetail::findorfail($id);
      $cid=$request->cid;
      $oldcid=$staffdetail->cid;
        //code to get change the image
        if ($request->hasFile('image')) {

          $image = $request->file('image');
          $input['imagename'] = $cid.'.'.$image->getClientOriginalExtension();
          //dd(  $input['imagename'] );
          $destinationPath = public_path('/images/staff');
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
         if($cid!=$oldcid)
         {
           $oldprofileimagepath=public_path('images/staff/').$staffdetail->img_location;
             $oldprofileimage=str_replace(DIRECTORY_SEPARATOR,'/', $oldprofileimagepath);
        // dd($oldprofileimage);
           $newprofileimagepath=public_path('images/staff/').$cid.'.jpg';
           $newprofileimage=str_replace(DIRECTORY_SEPARATOR,'/', $newprofileimagepath);
           //dd($newprofileimage);
           if(rename($oldprofileimage, $newprofileimage))
           {
             $staffdetail->img_location =$cid.'.jpg';
               session()->flash('img_change','Image name has been successfully changed');
           }
         else
         {
         dd("Something went wrong in image change");
         }

         }

    }
    $staffdetail->user_id_of_updater = \Auth::id(); //add the authenticated user id to "user_id" column.
    $staffdetail->user_name_of_updater=\Auth::user()->name.'(updated)';//add the authenticated user name to "user_name" column.
    //end of code to change the image
    if($staffdetail->update($request->all()))
    {
      session()->flash('flash_msg','Staff Details successfully updated');

    }
    else {

        dd("update not working");

    }
      return redirect('staffdetail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      staffdetail::find($id)->delete();

        return response()->json(['success'=>'Record deleted successfully.']);
    }
}
