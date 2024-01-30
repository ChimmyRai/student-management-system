<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Punakha SMS</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styleforresume.css') }}" rel="stylesheet">
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
      <!--  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />-->
      <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>-->

    <!--  <script src="{{ asset('js/chart-area-demo.js') }}"></script>-->
    <!--  <script src="{{ asset('js/chart-bar-demo.js') }}"></script>-->


     @livewireScripts
       <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/mycustom.js') }}"></script>

       <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>

      <!--<script src="vendor/jquery/jquery.min.js" defer></script>-->


  <script src="{{ asset('js/turbolinkstart.js') }}" defer></script>

      <!-- Menu Toggle Script -->
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark" id="navbar">
          @if(Auth::guard('admin')->check())
          <a class="navbar-brand" href="{{ url('/admin') }}">
                PCS Management System
          </a>
          @elseif(Auth::guard('student')->check())
          <a class="navbar-brand" href="{{ url('/student') }}">
            PCS Management System
          </a>
          @else
          <a class="navbar-brand" href="{{ url('/home') }}">
            PCS Management System
          </a>
          @endif

            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
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

                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                        <a class="dropdown-item" href="#">  @if(Auth::guard('admin')->check())
                        {{Auth::guard('admin')->user()->name}}
                        @elseif(Auth::guard('student')->check())
                        {{Auth::guard('student')->user()->name}}
                        @else
                        {{ Auth::user()->name }}
                        @endif</a>

                        <div class="dropdown-divider"></div>
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
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">

                            @if(Auth::guard('admin')->check())
                            <a class="nav-link" href="{{ url('/admin') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            @elseif(Auth::guard('student')->check())
                            <a class="nav-link" href="{{ url('/student') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            @else
                            <a class="nav-link" href="{{ url('/home') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            @endif





                            <div class="sb-sidenav-menu-heading">Student</div>


                            <a class="nav-link collapsed" href="{{ url('/showresult') }}"  aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-poll-h"></i></div>
                                Result

                            </a>



                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        @if(Auth::guard('admin')->check())
                              Admin
                      @elseif(Auth::guard('student')->check())
                          Student
                      @else
                      Teacher
                      @endif
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                      <br/>
                      <!--    <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Primary Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Warning Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Success Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Danger Card</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>-->
                  <!--      <div class="row">
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-chart-area mr-1"></i>
                                        Area Chart Example
                                    </div>
                                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
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
                        </div>-->
                        @hasSection ('content')
                               @yield('content')
                        @else
                                {{$slot}}
                           @endif


                    </div><!--end of container fluid-->
                </main>

            </div>
        </div>
      <!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>-->

    <!--   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>-->

      <!--  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>-->
      <!--  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>-->
      <!--  <script src="assets/demo/datatables-demo.js"></script>-->
        <script src="{{ asset('js/livewire-turbolinks.js') }}" data-turbolinks-eval="false"></script>
    </body>
</html>
