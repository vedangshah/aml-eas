<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<title>Login</title>
		<link rel="icon" type="image/x-icon" href="{{ asset('css/vendor/img/logo.png')}}"/>
		<link rel="icon" href="{{ asset('css/vendor/img/logo.png')}}" type="image/png" sizes="16x16">
        <link rel="stylesheet" href="{{('css/vendor/pace/pace.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/bootstrap-datepicker/bootstrap-datepicker3.min.css') }}">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/jquery-scrollbar/jquery.scrollbar.css') }}">
		<link rel="stylesheet" href="{{ asset('css/vendor/select2/css/select2.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/vendor/jquery-ui/jquery-ui.min.css')}}">
		<link rel="stylesheet" href="{{ asset('css/vendor/daterangepicker/daterangepicker.css')}}">
		<link rel="stylesheet" href="{{ asset('css/vendor/timepicker/bootstrap-timepicker.min.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Hind+Vadodara:400,500,600" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/vendor/fonts/jost/jost.css')}}">
		<!--Material Icons-->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/fonts/materialdesignicons/materialdesignicons.min.css')}}">
		<!--Bootstrap + atmos Admin CSS-->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/css/atmos.min.css')}}">
        <!-- Additional library for page -->
        <!-- Latest compiled and minified CSS -->
		<style>
			html, body {
			background-color: #fff;
			color: #636b6f;
			font-family: 'Nunito', sans-serif;
			font-weight: 200;
			height: 100vh;
			margin: 0;
			}
			.full-height {
			height: 100vh;
			}
			.flex-center {
			align-items: center;
			display: flex;
			justify-content: center;
			}
			.position-ref {
			position: relative;
			}
			.top-right {
			position: absolute;
			right: 10px;
			top: 18px;
			}
			.content {
			text-align: center;
			}
			.title {
			font-size: 84px;
			}
			.links > a {
			color: #636b6f;
			padding: 0 25px;
			font-size: 13px;
			font-weight: 600;
			letter-spacing: .1rem;
			text-decoration: none;
			text-transform: uppercase;
			}
			.m-b-md {
			margin-bottom: 30px;
			}
		</style>
		
	</head>
	<body>
		<main class="admin-main1 ">
			<div class="container-fluid">
				<div class="row ">
					<div class="col-lg-4  bg-white">
						<div class="row align-items-center m-h-100">
							<div class="mx-auto col-md-8">
								<div class="p-b-20 text-center">
									<p>
										<img src="{{ asset('img/logo.svg') }}" width="80" alt="">
									</p>
									<p class="admin-brand-content">
										atmos
									</p>
								</div>
								<h3 class="text-center p-b-20 fw-400">Login</h3>
								<form class="needs-validation" method="post" action="{{ route('login.store') }}" >
									@csrf
									<div class="form-row">
										<div class="form-group floating-label col-md-12">
											<label>User Name</label>
											<input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="User Name" name="email" id="email">
											@error('email')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group floating-label col-md-12">
											<label>Password</label>
											<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" >
											@error('password')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div>
										  	@error('login-failed')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>
									<input type="checkbox" name="s_password" id="s_password">show password		
									<br>		
									<button type="submit"  class="btn btn-primary btn-block btn-lg">Login</button>
								</form>
								<p class="text-right p-t-10">
									<a href="#!" class="text-underline">Forgot Password?</a>
								</p>
							</div>
						</div>
					</div>
					<div class="col-lg-8 d-none d-md-block bg-cover" style="background-image: url({{ asset('/img/auth.svg') }});">
					</div>
				</div>
			</div>
        </main>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous"></script>
        
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
		<script>
		  $(document).ready(function(event){
            $('#s_password').on("click",function(){
                var pf=$("#password");
				var pt=pf.attr('type');
				if(pf.val() != '')
				{
					 if(pt =='password')
					 {
						   pf.attr('type','text');
						   $(this).text('Hide Password');
					 }
					 else
					 {
						 
						  pf.attr('type','password');
						   $(this).text('show Password');
					 }
				}
			});
		  });
		</script>
        
	</body>
</html>