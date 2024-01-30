@extends('layouts.sbadmin')

@section('content')

<div class="row">


  
 </div>
<div class="row">
  <!--calender display-->
     <div class="col-xl-6">
         <div class="card mb-4">
             <div class="card-header">
                <i class="far fa-calendar-alt"></i>
                School Calender
             </div>
             <div class="card-body"><div id='calendar'></div></canvas></div>
         </div>
     </div>
     <div class="col-xl-6">
         <div class="card mb-4">
             <div class="card-header">
                 <i class="fas fa-chart-bar mr-1"></i>
                 Bar Chart Example
             </div>
             <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
         </div>
     </div>
 </div>
 <!--javascript for the calender-->
 <script>
 $(document).ready(function () {

 var SITEURL = "{{ url('/') }}";

 $.ajaxSetup({
     headers: {
     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
 });

 var calendar = $('#calendar').fullCalendar({
                     editable: false,
                     events: SITEURL + "/fullcalender",
                     displayEventTime: false,
                     editable: false,
                     eventRender: function (event, element, view) {
                         if (event.allDay === 'true') {
                                 event.allDay = true;
                         } else {
                                 event.allDay = false;
                         }
                     },
                     selectable: true,
                     selectHelper: true,




                 });

 });

 function displayMessage(message) {
     toastr.success(message, 'Event');
 }

 </script>

@endsection
