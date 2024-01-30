<?php

namespace App\Http\Controllers;
use App\period ;
use App\User ;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function __construct()
       {
          $this->middleware('auth:admin');
       }

    public function index()
    {
        return "dsfasdfasd";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $instructorOptions = User::pluck('Name','id')->toArray();

      $instructorOptions= User::select("id", DB::raw("CONCAT(name,' ','(','Teacher ID:',id,')') as full_name"))->pluck('full_name', 'id');
    //  dd($instructorOptions);
      return view('subjectViews.create',compact('instructorOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\HTTP\Requests\subjectAllocationRequest $request)
    {
      $subject= new \App\AllocatedSubject;
      $subject->Admin_ID= Auth::id();
      //dd(Auth::id());
      $subject->User_ID=$request->Teacher_Name ;
    //  $subject->Teacher_Name=$request->Teacher_Name;
    //  dd($request->Teacher_Name);
      $subject->Subject=$request->Subject;
      $subject->Class=$request->Class;
      $subject->Section=$request->Section;
      $matchThese = ['Subject'=>$request->Subject,'Class'=> $request->Class];
      $subject->Number_of_periods=period::where('Subject','=',$request->Subject)->where('Class','=',$request->Class)->value('Number_of_periods');
      if($subject->save())
      {
        session()->flash('flash_msg','Subject Allocation successfull');
        return redirect()->action('SubjectController@create');
      }
      else
      {
        return 'Something went wrong';
      }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
