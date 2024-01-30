<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PCS</title>
 @livewireStyles
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
    <!-- Scripts -->



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/css.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
<script src="{{ asset('js/app.js') }}"></script>
 @livewireScripts
<script src="{{ asset('js/mycustom.js') }}"></script>
<script src="{{ asset('js/turbolinkstart.js') }}" defer></script>

<script>
$( document ).on('turbolinks:load', function(e) {

  const actualBtn = document.getElementById('actual-btn');

  const fileChosen = document.getElementById('file-chosen');

  actualBtn.addEventListener('change', function(){
    fileChosen.textContent = this.files[0].name
  })

})
</script>



</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
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
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
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
            </div>
        </nav>

        <main class="py-4">
<div>

  {{$slot}}


</div>
        </main>


    </div>

</body>

</html>
