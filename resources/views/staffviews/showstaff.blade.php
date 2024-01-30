<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="turbolinks-visit-control" content="reload">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> SMS</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}" data-turbolinks-eval="false" />
</head>

<body>

    <div class="container-fluid overcover">
        <div class="container profile-box">
            <div class="top-cover">
                <div class="covwe-inn" style="background: linear-gradient(90deg, #136a8a 0%, #267871 100%);">
                    <div class="row no-margin">
                        <div class="col-md-3 img-c">
                          <img src="{{url('storage/images/staff/'.$staffdetail->img_location) }}" alt="">
                                              </div>
                        <div class="col-md-9 tit-det">
                            <h2>{{$staffdetail->Name}}</h2>

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
                                          <a href="{{ route('staffPDF.show',$staffdetail->id) }}"><i class='fas fa-download' style='font-size:24px'></i> Download in PDF</a>
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
                                          <td>{{$staffdetail->Name}}</td>
                                      </tr>

                                      <tr>
                                          <th>CID</th>
                                          <td>{{$staffdetail->cid}}</td>
                                      </tr>
                                      <tr>
                                          <th>Employee ID</th>
                                          <td>{{$staffdetail->eid}}</td>
                                      </tr>
                                      <tr>
                                          <th>Gender</th>
                                          <td>{{$staffdetail->gender}}</td>
                                      </tr>
                                      <tr>
                                          <th>Date of birth</th>
                                          <td>{{\Carbon\Carbon::parse($staffdetail->dob)->format('M d Y')}}</td>
                                      </tr>
                                      <tr>
                                          <th>Nationality</th>
                                          <td>{{$staffdetail->Nationality}}</td>
                                      </tr>
                                      <tr>
                                          <th>Grade</th>
                                          <td>{{$staffdetail->grade}}</td>
                                      </tr>
                                      <tr>
                                          <th>Position</th>
                                          <td>{{$staffdetail->position_level}}</td>
                                      </tr>
                                      <tr>
                                          <th>Postion Title</th>
                                          <td>{{$staffdetail->position_title}}</td>
                                      </tr>
                                      <tr>
                                          <th>Contact Number</th>
                                          <td>{{$staffdetail->contact_number}}</td>
                                      </tr>
                                      <tr>
                                          <th>Email</th>
                                          <td>{{$staffdetail->email}}</td>
                                      </tr>



                                  </tbody></table>

                          </div>
                            <div class="col-lg-1 no-padding"></div>
                          <div class="col-lg-6 no-padding">
                               <table class="addrss-list">
                                      <tbody>
                                        <tr>
                                            <th>Qualification</th>
                                            <td>{{$staffdetail->Qualification}}</td>
                                        </tr>
                                        <tr>
                                            <th>Subject Specilization</th>
                                            <td>{{$staffdetail->subject_specilization}}</td>
                                        </tr>
                                        <tr>
                                            <th>Appointement Date</th>
                                            <td>{{\Carbon\Carbon::parse($staffdetail->date_of_appointment)->format('M d Y')}}</td>
                                        </tr>
                                        <tr>
                                            <th>Village</th>
                                            <td>{{$staffdetail->village}}</td>
                                        </tr>
                                        <tr>
                                            <th>Gewog</th>
                                            <td>{{$staffdetail->gewog}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dzongkhag</th>
                                            <td>{{$staffdetail->dzongkhag}}</td>
                                        </tr>
                                        <tr>
                                            <th>Previous Schools Served</th>
                                            <td>{{$staffdetail->previous_schools_served}}</td>
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



</html>
