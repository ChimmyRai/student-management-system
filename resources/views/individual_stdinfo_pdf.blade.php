<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> SMS</title>


<style>
@font-face {
  font-family: 'mouse-300';
  src: url("../fonts/RobotoSlab-Regular.ttf") format("truetype"); }
@font-face {
  font-family: 'mouse-500';
  src: url("../fonts/RobotoSlab-Bold.ttf") format("truetype"); }


  body {
    background-color: #f7f7ff !important;
    font-family: "mouse-300", Arial, Helvetica, sans-serif;
    color: #6A6A6A; }
#table{
   border: 2px solid black;
   width: 100%;
   height:auto;
   text-align: left;
   vertical-align: middle;
   border-collapse: collapse;
   background-color:#F0F3F4 ;

}
th, td {
     border: 1px solid #626567;
      padding: 10px;
}
th{

  font-family: "mouse-500", Arial, Helvetica, sans-serif;

   text-align: left;
}

  td img {
    max-width:100px;
    max-height:100px  ;
    border-radius: 25px;
}
</style>
</head>
<body>
  <table class="table" id="table">
    <thead>
      <tr>
        <th scope="col" colspan="4" style="text-align:center;">Details</th>

      </tr>
    </thead>
    <tbody>
      <tr>
        <th >Name</th>
        <td>{{$student->Name}}</td>
        <th>School Joining Date</th>
        <td>{{\Carbon\Carbon::parse($student->date_of_joining_school)->format('M d Y')}}</td>
      </tr>

      <tr>
        <th >Photo</th>
        <td><img src="{{public_path('storage/images/student/'.$student->img_location) }}"></td>
        <th >Class when joining school</th>
        <td>{{$student->class_when_joining_school}}</td>
      </tr>

      <tr>
        <th>Student Code</th>
        <td>{{$student->student_code}}</td>

        <th >Previous School</th>
        <td>{{$student->previous_schools}}</td>
      </tr>

      <tr>
        <th >Index</th>
        <td>{{$student->index_number}}</td>
        <th >Village</th>
        <td>{{$student->village}}</td>
      </tr>

      <tr>
        <th >Admission Number</th>
        <td>{{$student->adm_no}}</td>
        <th >Gewog</th>
        <td>{{$student->gewog}}</td>
      </tr>

      <tr>
        <th >Date of Birth</th>
        <td>{{\Carbon\Carbon::parse($student->dob)->format('M d Y')}}</td>
        <th>Dzongkhag</th>
        <td>{{$student->dzongkhag}}</td>
      </tr>

      <tr>

        <th >Class</th>
        <td>{{$student->current_class}}</td>
        <th >Father</th>
        <td>{{$student->father_name}}</td>
      </tr>

      <tr>

        <th >Section</th>
        <td>{{$student->current_section}}</td>
        <th>Mother</th>
        <td>{{$student->mother_name}}</td>
      </tr>

      <tr>
        <th >Email</th>
        <td>{{$student->email}}</td>
        <th>Guardian's contact</th>
        <td>{{$student->guardian_contact}}</td>
      </tr>

      <tr>
        <th>Hostel Status</th>
        <td>{{$student->hostel_status}}</td>
        <th></th>
        <td></td>
      </tr>

      <tr>
        <th >House</th>
        <td>{{$student->house}}</td>
        <th ></th>
        <td></td>
      </tr>

    </tbody>
  </table>

</body>
</html>
