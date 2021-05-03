<!DOCTYPE html>
<html lang="en">
<head>
  
<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
        <title>@yield('title')</title>
<!-- Additional library for page -->
        <!-- Latest compiled and minified CSS -->
		{{--@include('css')--}}
        <!-- Page specific styles -->
        <link rel="icon" type="image/x-icon" href="{{ asset('css/vendor/img/logo.png')}}"/>
		<link rel="icon" href="{{ asset('css/vendor/img/logo.png')}}" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="{{('css/vendor/pace/pace.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/jquery-scrollbar/jquery.scrollbar.css') }}">
		<link rel="stylesheet" href="{{ asset('css/vendor/select2/css/select2.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/vendor/jquery-ui/jquery-ui.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/vendor/DataTables/datatables.min.css')}}">
        <link rel="stylesheet" href="{{asset('css/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">		<link rel="stylesheet" href="{{ asset('css/vendor/daterangepicker/daterangepicker.css')}}">
		<link rel="stylesheet" href="{{ asset('css/vendor/timepicker/bootstrap-timepicker.min.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/fontawesome.min.css" integrity="sha512-shT5e46zNSD6lt4dlJHb+7LoUko9QZXTGlmWWx0qjI9UhQrElRb+Q5DM7SVte9G9ZNmovz2qIaV7IWv0xQkBkw==" crossorigin="anonymous" />
		<link rel="stylesheet" href="{{ asset('css/vendor/fonts/jost/jost.css')}}">
		<!--Material Icons-->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/fonts/materialdesignicons/materialdesignicons.min.css')}}">
		<!--Bootstrap + atmos Admin CSS-->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/css/atmos.min.css')}}">
        </head>
<body class="jumbo-page bg-dark">

<main class="admin-main  bg-pattern">
    <div class="container">
        <div class="row m-h-100 ">
            <div class="col-md-8 col-lg-4  m-auto">
                <div class="card shadow-lg p-t-20 p-b-20">
                    <div class="card-body text-center">
                        <img width="200" alt="image" src="{{asset('img/404.svg')}}">
                        <h1 class="display-1 fw-600 font-secondary">404</h1>
                        <h5>Oops, the page you're
                            looking for does not exist.</h5>
                        <p class="opacity-75">
                            You may want to head back to the homepage.
                            If you think something is broken, report a problem.
                        </p>
                        <div class="p-t-10">
                            <a href="{{route('logout')}}" class="btn btn-lg btn-primary">Go Back Home</a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="{{ asset('js/vendor/pace/pace.min.js')}}"></script>
        <script src="{{ asset('js/vendor/jquery/jquery.min.js')}}"></script>
		<script src="{{ asset('js/vendor/jquery-ui/jquery-ui.min.js')}}"></script>
		<script src="{{ asset('js/vendor/popper/popper.js')}}"></script>
		<script src="{{ asset('js/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
		<script src="{{ asset('js/vendor/select2/js/select2.full.min.js')}}"></script>
		<script src="{{ asset('js/vendor/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
		<script src="{{ asset('js/vendor/listjs/listjs.min.js')}}"></script>
		<script src="{{ asset('js/vendor/moment/moment.min.js')}}"></script>
		<script src="{{asset('js/vendor/daterangepicker/daterangepicker.js')}}"></script>
		<script src="{{asset('js/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
		<script src="{{asset('js/vendor/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
		<script src="{{asset('js/vendor/js/atmos.min.js')}}"></script>



</body>
</html>