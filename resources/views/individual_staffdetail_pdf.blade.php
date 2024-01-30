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
}
th, td {
     border: 1px solid black;
      padding: 10px;
}
th{
  background-color: #f7f7ff !important;
  font-family: "mouse-500", Arial, Helvetica, sans-serif;
  color: #6A6A6A;
   text-align: left;
}

  td img {
    max-width:100px;
    max-height:100px ;
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
        <td>{{$staff->Name}}</td>
        <th >Contact Number</th>
        <td>{{$staff->contact_number}}</td>

      </tr>

      <tr>
        <th >Photo</th>
            <td><img src="{{public_path('storage/images/staff/'.$staff->img_location) }}"></td>
        <th>Email</th>
        <td>{{$staff->email}}</td>

      </tr>

      <tr>
        <th>Citizen ID</th>
        <td>{{$staff->cid}}</td>
        <th >Qualification</th>
        <td>{{$staff->Qualification}}</td>

      </tr>

      <tr>
        <th >Employee ID</th>
        <td>{{$staff->eid}}</td>
        <th >Subject Specilization</th>
        <td>{{$staff->subject_specilization}}</td>


      </tr>

      <tr>
        <th >Gender</th>
        <td>{{$staff->gender}}</td>
        <th >Appointement Date</th>
        <td>{{\Carbon\Carbon::parse($staff->date_of_appointment)->format('M d Y')}}</td>


      </tr>

      <tr>
        <th >Date of Birth</th>
        <td>{{\Carbon\Carbon::parse($staff->dob)->format('M d Y')}}</td>
        <th>Previous Schools Served</th>
        <td>{{$staff->previous_schools_served}}</td>


      </tr>

      <tr>

        <th >Nationality</th>
        <td>{{$staff->Nationality}}</td>
        <th >Permanent Address</th>
        <td>{{$staff->village}}, {{$staff->gewog}}, {{$staff->dzongkhag}}</td>

      </tr>

      <tr>

        <th >Position/Grade/Title</th>
        <td colspan="3">{{$staff->position_level}}, {{$staff->grade}}, {{$staff->position_title}} </td>

      </tr>






    </tbody>
  </table>

</body>
</html>
