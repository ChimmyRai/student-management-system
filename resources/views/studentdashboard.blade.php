

   @extends('layouts.sbstudent')

   @section('content')
   <div class="container">
       <div class="row justify-content-center">
           <div class="col-md-8">
               <div class="card">
                   <div class="card-header">Dashboard</div>

                   <div class="card-body">
                         @if(!empty($message))
                        <div class="alert alert-danger" role="alert" id="scrollableAlertDiv">
                           {{$message}}
                         </div>
                         @else
                         <p>
                        Hi student,you will view your result  once it is uploaded. To view your result, please click on the result tab of your dashboard
                        </p>
                        @endif
                   </div>
               </div>
           </div>
       </div>
   </div>
   @endsection
