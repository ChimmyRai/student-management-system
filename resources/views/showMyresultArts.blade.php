
   @extends('layouts.sbstudent')

   @section('content')

   <div class="container-fluid overcover" style="margin-top:-35px;">

           <div class="container profile-box">

              <div style="text-align: center;padding-top:10px;">
                  <img src="{{ asset('img/dzongkha text.png') }}" class="img-fluid" alt="Responsive image" style="">
              </div>
             <div style="text-align: center;padding-top:4px;">

               <img src="{{asset('img/Logo2020.png')}}" class="img-fluid" alt="Responsive image" style="max-height:200px;width:auto;min-height:200px">
             </div>
             <div style="text-align: center;margin-top:-20px;">
                 <img src="{{ asset('img/english text.png') }}" class="img-fluid" alt="Responsive image" style="">
             </div>
             <hr/>

               <div class="row">
                  @foreach($stdbio as $deatils)
                   <div class="col-md-4 left-co">
                       <div class="left-side">
                           <div class="profile-info">
                               <img src="{{url('storage/images/student/'.$deatils->img_location) }}" alt="">
                               <h3>{{$deatils->Name}}</h3>
                           </div>
                           <h4 class="ltitle">Student Code</h4>
                           <div class="contact-box pb0">
                               <div class="icon">
                            <i class="fas fa-id-card"></i>

                               </div>
                               <div class="detail">
                                   {{$deatils->student_code}}
                               </div>
                           </div>
                            <h4 class="ltitle">Index Number</h4>
                           <div class="contact-box pb0">
                               <div class="icon">
                            <i class="far fa-id-badge"></i>
                               </div>
                               <div class="detail">
                               {{$deatils->index_number}}
                               </div>
                           </div>
                           <h4 class="ltitle">Email</h4>
                          <div class="contact-box pb0">
                              <div class="icon">
                        <i class="far fa-envelope"></i>
                              </div>
                              <div class="detail">
                                 {{$deatils->email}}
                              </div>
                          </div>
                          <h4 class="ltitle">Contact</h4>
                         <div class="contact-box pb0">
                             @if(!empty($deatils->self_contact))
                             <div class="icon">

                      <i class="fas fa-mobile-alt"></i>
                             </div>

                             <div class="detail">
                            {{$deatils->self_contact}}
                             </div>
                             @endif

                             @if(!empty($deatils->guardian_contact))
                             <div class="icon">

                      <i class="fas fa-mobile-alt"></i>
                             </div>

                             <div class="detail">
                            {{$deatils->guardian_contact}}
                             </div>
                             @endif
                         </div>
                         <h4 class="ltitle">House</h4>
                        <div class="contact-box pb0">
                            <div class="icon">
                  <i class="fas fa-house-user"></i>
                            </div>
                            <div class="detail">
                             {{$deatils->house}}
                            </div>
                        </div>




                       </div>
                   </div>
                   @endforeach
                    @foreach($resultArts as $result)
                   <div class="col-md-8 rt-div">

                       <div class="rit-cover">

                           <h2 class="rit-titl"><i class="fas fa-graduation-cap"></i> Examination Result ({{$result->class}}   {{$result->section}})</h2>
                           <div class="about">
                              <!--result table start-->

                              <div class="table-responsive" style="width:70%;margin-left:10%;">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Subjects</th>
          <th>Marks(100)</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Dzongkha</td>
          <td>{{$result->dzongkha}}</td>
        </tr>
        <tr>
          <td>English</td>
          <td>{{$result->english}}</td>
        </tr>
        <tr>
          <td>Math</td>
          <td>{{$result->b_math}}</td>
        </tr>
        <tr>
          <td>Geography</td>
          <td>{{$result->geography}}</td>
        </tr>
        <tr>
          <td>History</td>
          <td>{{$result->history}}</td>
        </tr>
        <tr>
          <td>Economics</td>
          <td>{{$result->economics}}</td>
        </tr>

        <tr>
          <td>Media Studies</td>
          <td>{{$result->media_studies}}</td>
        </tr>
        <tr>
          <td>Rigzhung</td>
          <td>{{$result->rigzhung}}</td>
        </tr>
        <tr>
          <td><b>Average</b></td>
          <td>{{$result->average}}</td>
        </tr>
        <tr>
          <td><b>Remarks</b></td>
          <td>{{$result->remarks}}</td>
        </tr>
        <tr>
          <td><b>Rank</b></td>
          @if($result->rank==0)
          <td>NA</td>
          @else
            <td>{{$result->rank}}</td>
            @endif
        </tr>
      </tbody>
    </table>
   </div>
   </div>



                              <!--result table end-->
                           </div>






                           <h2 class="rit-titl"><i class="fas fa-chart-bar"></i> Performance Chart</h2>
                           <div class="profess-cover row no-margin">

                               <div class="col-md-6">
                                   <div class=" prog-row row">
                                       <div class="col-sm-6">
                                           Dzongkha
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="row prog-row">
                                       <div class="col-sm-6">
                                           English
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="row prog-row">
                                       <div class="col-sm-6">
                                           B.Math
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="row prog-row">
                                       <div class="col-sm-6">
                                           Geography
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>


                               <div class="col-md-6">
                                   <div class=" prog-row row">
                                       <div class="col-sm-6">
                                           History
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="row prog-row">
                                       <div class="col-sm-6">
                                           Economics
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="row prog-row">
                                       <div class="col-sm-6">
                                        Media
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                   <div class="row prog-row">
                                       <div class="col-sm-6">
                                          Rigzhung
                                       </div>
                                       <div class="col-sm-6">
                                           <div class="progress">
                                               <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                           </div>
                                       </div>
                                   </div>
                               </div>






                           </div>
                       </div>
                        @endforeach
                   </div>
               </div>
           </div>
       </div>

   @endsection
