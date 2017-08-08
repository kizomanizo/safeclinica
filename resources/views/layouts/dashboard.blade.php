<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-favicon.png') }}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon.png') }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Safefocus') }}</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="{{ asset('css/vendors/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/paper/animate.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/paper/paper-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/paper/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

<style type="text/css">
  html {
    overflow-y: hidden;
    height: 100vh
    }

  ::-webkit-scrollbar { 
    display: none; 
    }
</style>
</head>

<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="black" data-active-color="danger">

    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="url('patients/create')" class="simple-text">
                    {{ config('app.name', 'SafeClinic') }}
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="{{ url('patients/create') }}">
                        <i class="fa fa-edit"></i>
                        <p>Registration</p>
                    </a>
                </li>
                @foreach($services as $service)
                <li>
                    <a href="{{ url('services') }}/{{$service->id}}">
                        <i class="fa fa-user-md"></i>
                        <p>{{ $service->name }}</p>
                    </a>
                </li>
                @endforeach
               <li>
                    <a href="{{ route('reports') }}">
                        <i class="fa fa-file-excel-o"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings') }}">
                        <i class="fa fa-cogs"></i>
                        <p>Settings</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#">Safe Focus Polyclinic</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">

                        <li class="dropdown">
                              <a href="#">
                                    <i class="ti-bell"></i>
                                    <p class="notification">{{ $count }}</p>
									<p>Pending</p>
                              </a>
                        </li>

                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="ti-user"></i>
                                    <p>{{ Auth::user()->name }}</p>
                                    <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif

                    </ul>

                </div>
            </div>
        </nav>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <!-- Page content goes here -->
                    @yield('content')
                    <!-- Page content ends here | kizomanizo@gmail.com -->
                    </div>
                </div>
            </div>
        <footer class="footer">
            <div class="container-fluid">
                <div class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script>, made by <a href="http://www.twitter.com/kizomanizo">Kizomanizo</a>
                </div>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/vendors/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/paper/bootstrap.min.js') }}" type="text/javascript"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="{{ asset('js/paper/bootstrap-checkbox-radio.js') }}"></script>

    <!--  Notifications Plugin    -->
    <script src="{{ asset('js/paper/bootstrap-notify.js') }}"></script>

    <!--  Custom JS scripts for doing various tasks -->
    <script src="{{ asset('js/custom/disable_input.js') }}" ></script>
    <script src="{{ asset('js/custom/removealerts.js') }}"></script>
    <script src="{{ asset('js/custom/add_treatment_field.js') }}" > </script>


</html>
