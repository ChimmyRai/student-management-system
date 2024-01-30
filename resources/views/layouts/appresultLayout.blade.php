<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PCS-Management System</title>

  <!-- Bootstrap core CSS -->
  <!--  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="{{ asset('css/simple-sidebar.css') }}" rel="stylesheet">
  @livewireStyles
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
  <style>

  /*
  *  STYLE 2
  */

 .mustFill
 {

   color: red;
 }
 .toggleDisplay1{
         display: table-cell;
         word-wrap: break-word;
         max-width: 160px;
         min-width: 100px;
       }


   .toggleDisplay2
   {
       display: table-cell;
       word-wrap: break-word;
       max-width: 160px;
       min-width: 100px;
               }
 .nonToogleDisplay
 {

   word-wrap: break-word;
   max-width: 160px;
     min-width: 100px;


 }

   .btn:focus{
                   background: #CCCCFF;
               }

 .datatablepic
 {

   max-width:100px;
   max-height:100px;
   border-radius:15px;
 }

 #labelforinput {
   background-color: #6E6E6E;
   color: white;
   padding: 0.5rem;
   font-family: sans-serif;
   border-radius: 0.3rem;
   cursor: pointer;
   margin-top: 1rem;
 }

 #file-chosen{
   margin-left: 0.3rem;
   font-family: sans-serif;
 }
 .header {
             position: sticky;
             top:0;
         }

 </style>
 @livewireScripts
   <script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/mycustom.js') }}"></script>
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>

  <!--<script src="vendor/jquery/jquery.min.js" defer></script>-->


    <script src="{{ asset('js/turbolinkstart.js') }}" defer></script>
  <!-- Menu Toggle Script -->


</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper" >
      <div class="sidebar-heading">Start Bootstrap </div>
      <div class="list-group list-group-flush">
        <a href="{{route('resultAdditionLower')}}" class="list-group-item list-group-item-action bg-light">Lower Secondary</a>
        <a href="{{route('resultAdditionMiddle')}}" class="list-group-item list-group-item-action bg-light">Middle Secondary</a>
        <a href="{{route('resultAdditionHigherSci')}}" class="list-group-item list-group-item-action bg-light">Higher Secondary(Science)</a>
        <a href="{{route('resultAdditionHigherCom')}}" class="list-group-item list-group-item-action bg-light">Higher Secondary(Commerce)</a>
        <a href="{{route('resultAdditionHigherArts')}}" class="list-group-item list-group-item-action bg-light">Higher Secondary(Arts)</a>
        <a href="{{route('resultDownload')}}" class="list-group-item list-group-item-action bg-light">Result Download</a>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <button class="btn btn-primary" id="menu-toggle"><i id="toggleIconForMenu" class="fas fa-angle-double-left"></i>Class Level</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">

            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                                        @if(Auth::guard('admin')->check())
                                                      {{Auth::guard('admin')->user()->name}}
                                                      @elseif(Auth::guard('student')->check())
                                                      {{Auth::guard('student')->user()->name}}
                                                      @else
                                                      {{ Auth::user()->name }}
                                                      @endif <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
          </ul>
        </div>
      </nav>
  <main class="py-4">
      <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">

              {{$slot}}

     </div>
     </div>
      </div>
  </main>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
<script src="{{ asset('js/livewire-turbolinks.js') }}" data-turbolinks-eval="false"></script>
  <!-- Bootstrap core JavaScript -->
  <!--<script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false"></script>-->
</body>

</html>
