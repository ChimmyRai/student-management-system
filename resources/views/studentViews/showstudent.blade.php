<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> SMS</title>
    <link rel="shortcut icon" href="{{asset('images/fav.jpg')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" />
</head>

<body>

    <div class="container-fluid overcover">
        <div class="container profile-box">
            <div class="top-cover">
                <div class="covwe-inn" style="background: linear-gradient(90deg, #136a8a 0%, #267871 100%);">
                    <div class="row no-margin">
                        <div class="col-md-3 img-c">
                            <img src="{{url('storage/images/student/'.$student->img_location) }}" alt="">
                        </div>
                        <div class="col-md-9 tit-det">
                            <h2>{{$student->Name}}</h2>

                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row no-margin home-det">

                      <div class="col-md-12 home-dat">


                          <div class="links">
                          <div class="row ">
                              <div class="col-xl-6 col-md-12">
                                  <ul class="btn-link">

                                      <li>
                                          <a href="{{ route('students.show',$student->id) }}"><i class='fas fa-download' style='font-size:24px'></i> Download in PDF</a>
                                      </li>
                                  </ul>
                              </div>

                          </div>
                      </div>
                      <div class="jumbo-address">
                         <div class="row no-margin">
                                  <div class="col-lg-5 no-padding">

                                  <table class="addrss-list">
                                      <tbody><tr>
                                          <th>Name</th>
                                          <td>{{$student->Name}}</td>
                                      </tr>

                                      <tr>
                                          <th>Student Code</th>
                                          <td>{{$student->student_code}}</td>
                                      </tr>
                                      <tr>
                                          <th>Index No</th>
                                          <td>{{$student->index_number}}</td>
                                      </tr>
                                      <tr>
                                          <th>Admission No</th>
                                          <td>{{$student->adm_no}}</td>
                                      </tr>
                                      <tr>
                                          <th>class</th>
                                          <td>{{$student->current_class}}</td>
                                      </tr>
                                      <tr>
                                          <th>Section</th>
                                          <td>{{$student->current_section}}</td>
                                      </tr>
                                      <tr>
                                          <th>School Joining date</th>
                                          <td>{{\Carbon\Carbon::parse($student->date_of_joining_school)->format('M d Y')}}</td>
                                      </tr>
                                      <tr>
                                          <th>Class when joining school</th>
                                          <td>{{$student->class_when_joining_school}}</td>
                                      </tr>
                                      <tr>
                                          <th>Previous School(s)</th>
                                          <td>{{$student->previous_schools}}</td>
                                      </tr>

                                      <tr>
                                          <th>House</th>
                                          <td>{{$student->house}}</td>
                                      </tr>

                                      <tr>
                                          <th>email</th>
                                          <td>{{$student->email}}</td>
                                      </tr>
                                      <tr>
                                          <th>Hostel status</th>
                                          <td>{{$student->hostel_status}}</td>
                                      </tr>



                                  </tbody></table>

                          </div>
                          <div class="col-lg-1 no-padding"></div>
                          <div class="col-lg-6 no-padding">
                               <table class="addrss-list">
                                      <tbody>
                                        <tr>
                                            <th>Date of birth</th>
                                            <td>{{\Carbon\Carbon::parse($student->dob)->format('M d Y')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Village</th>
                                            <td>{{$student->village}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gewog</th>
                                            <td>{{$student->gewog}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dzongkhag</th>
                                            <td>{{$student->dzongkhag}}</td>
                                        </tr>
                                        <tr>
                                            <th>Father</th>
                                            <td>{{$student->father_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mother</th>
                                            <td>{{$student->mother_name}}</td>
                                        </tr>
                                        <tr>
                                            <th>Father's Occupation</th>
                                            <td>{{$student->father_occupation}}</td>
                                        </tr>
                                        <tr>
                                            <th>Mothers's Occupation</th>
                                            <td>{{$student->mother_occupation}}</td>
                                        </tr>
                                        <tr>
                                            <th>Guardian Conatact</th>
                                            <td>{{$student->guardian_contact}}</td>
                                        </tr>
                                  </tbody></table>
                          </div>
                         </div>

                      </div>
                      </div>
                  </div>
              </div>
              </div>
              </div>
            </div>
        </div>
    </div>
</body>

<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>

</html>
