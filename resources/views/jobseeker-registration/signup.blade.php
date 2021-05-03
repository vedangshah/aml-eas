<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<title>Sign-Up</title>
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/fonts/materialdesignicons/materialdesignicons.min.css')}}">
		<!--Bootstrap + atmos Admin CSS-->
		<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/css/atmos.min.css')}}">
        <!-- Additional library for page -->
        <!-- Latest compiled and minified CSS -->

</head>

@foreach(['success', 'error'] as $key)
	@if(Session::has($key))
		<div class="alert alert-{{ $key }} alert-block">
			<button type="button" class="close" data-dismiss='alert'>x</button>
			{{ Session::get($key) }}
		</div>
	@endif
@endforeach
<body class="jumbo-page">

<main class="admin-main  ">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-6  bg-white">
                <div class="row align-items-center m-h-100">
                    <div class="mx-auto col-md-8">
                        <form class="needs-validation" method="post" action="{{ route('signup.store') }}">
                               @csrf
                             
                            <div class="p-b-20 text-center">
                                <p>
                                    <img src="{{ asset('img/logo.svg') }}" width="50" alt="">

                                </p>
                                <p class="admin-brand-content">
                                    atmos
                                </p>
                            </div>
                            <h3 class="text-center p-b-20 fw-400">Register</h3>

                            <div class="form-row">
                               
                                <div class="form-group form-floating floating-label col-md-6">
											<input type="text" class="form-control @error('jobseeker_name') is-invalid @enderror"  id="jobseeker_name" name="jobseeker_name" placeholder="Jobseeker Name" tabindex="1" autofocus>                                       
                                            <label for="jobseeker-name">Name</label>
                                            @error('jobseeker_name')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
                                </div>
                                <div class="form-group form-floating floating-label col-md-6">
                                            <input type="email" class="form-control @error('jobseeker_email') is-invalid @enderror"  id="jobseeker_email" name="jobseeker_email" placeholder="Jobseeker-Email" tabindex="2" autofocus>
                                            <label for="jobseeker-email">E-mail</label>
                                            @error('jobseeker_email')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
                                </div>
                                
                                <div class="form-group form-floating floating-label col-md-6">
                                  		<input type="text" class="form-control @error('jobseeker_contact_no') is-invalid @enderror"  id="jobseeker_contact_no" name="jobseeker_contact_no" placeholder="Jobseeker-Contact-No" tabindex="3" autofocus>
                                          <label for="jobseeker-contact-no">Contact No</label>
										@error('jobseeker_contact_no')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
                                </div>
                                
                                <div class="form-group floating-label col-md-6">
                                            <input type="date"  class="form-control @error('jobseeker_birth_date') is-invalid @enderror" id="jobseeker_birth_date" name="jobseeker_birth_date" placeholder="Jobseeker-Birth-Date" tabindex="4" autofocus>
                                            @error('jobseeker_birth_date')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
                                </div>
                                
                                <div class="form-group  form-floating floating-label col-md-6">
                                          	<input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="user-Name" tabindex="5" autofocus>				
                                              <label for="user_name">User-Name</label>
										
                                              @error('user_name')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
                                </div>
                                
                                <div class="form-group form-floating  shadow-textarea floating-label col-md-6">
                                         
                                            <input type="password" class="form-control @error('jobseeker_password') is-invalid @enderror" id="jobseeker_password" name="jobseeker_password" placeholder="Password" tabindex="6" autofocus>                                    
                                            <label for="jobseeker_password" class="mb-5">Password</label>
                                        	@error('jobseeker_password')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										
                                </div>
                                
                                <div class="form-group form-floating shadow-textarea floating-label col-md-12">
                                        <textarea class="form-control z-depth-0 @error('jobseeker_password') is-invalid @enderror" id="exampleFormControlTextarea6" rows="5" placeholder="Write Address here..." rows="3" id="jobseeker_address" name="jobseeker_address" tabindex="7" autofocus></textarea>
                                        <label for="exampleFormControlTextarea6">Address</label>
                                            @error('jobseeker_address')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
                                </div>

                                <div class="form-group floating-label col-md-12">

                                       <div class="input-group ">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text bg-dark text-white">upload</span>
                                        </div>
                                        <div class="custom-file">
                                           <input type="file" class="custom-file-input @error('profile') is-invalid @enderror" id="profile" name="profile" tabindex="8">
                                           
										  @error('profile')
													<div class="invalid-feedback">{{ $message }}</div>
									  		@enderror
										    <label class="custom-file-label">CHOOSE FILE</label>
										
									    </div>    

                                </div>

                                <div class="form-group floating-label col-md-12">
                                </div>
                              
                            </div>
                           
                          
                            <p class="">
                                <label class="cstm-switch">
                                    <input type="checkbox" checked name="option" value="1" class="cstm-switch-input">
                                    <span class="cstm-switch-indicator "></span>
                                    <span class="cstm-switch-description">  I agree to the Terms and Privacy. </span>
                                </label>


                            </p>

                            <button class="btn btn-dark btn-block" type="submit" tabindex="9">Submit</button>
									
                        </form>
                        <p class="text-right p-t-10">
                            <a href="{{ route('login')}}" class="text-underline">Already a user?</a>
                        </p>
                    </div>

                </div>
            </div>
       
        </div>
        
        <div class="col-lg-6 d-none d-md-block bg-cover" style="background-image: url({{ asset('img/auth.svg') }});height:100vh;">

</div>
    </div>
</main>

<!-- <div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-body p-all-0" id="site-search">
                <button type="button" class="close light" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="form-dark bg-dark text-white p-t-60 p-b-20 bg-dots" >
                    <h3 class="text-uppercase    text-center  fw-300 "> Search</h3>

                    <div class="container-fluid">
                        <div class="col-md-10 p-t-10 m-auto">
                            <input type="search" placeholder="Search Something"
                                   class=" search form-control form-control-lg">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="bg-dark text-muted container-fluid p-b-10 text-center text-overline">
                        results
                    </div>
                    <div class="list-group list  ">


                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"   src="assets/img/users/user-3.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Eric Chen</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-4.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Sean Valdez</div>
                                <div class="text-muted">Marketing</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm "><img class="avatar-img rounded-circle"
                                                                    src="assets/img/users/user-8.jpg" alt="user-image"></div>
                            </div>
                            <div class="">
                                <div class="name">Marie Arnold</div>
                                <div class="text-muted">Developer</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i class="mdi mdi-24px mdi-file-pdf"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">SRS Document</div>
                                <div class="text-muted">25.5 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar-title bg-dark rounded"><i
                                                class="mdi mdi-24px mdi-file-document-box"></i></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">Design Guide.pdf</div>
                                <div class="text-muted">9 Mb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm  ">
                                        <div class="avatar-title bg-primary rounded"><i
                                                    class="mdi mdi-24px mdi-code-braces"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">response.json</div>
                                <div class="text-muted">15 Kb</div>
                            </div>


                        </div>
                        <div class="list-group-item d-flex  align-items-center">
                            <div class="m-r-20">
                                <div class="avatar avatar-sm ">
                                    <div class="avatar avatar-sm ">
                                        <div class="avatar-title bg-info rounded"><i
                                                    class="mdi mdi-24px mdi-file-excel"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="name">June Accounts.xls</div>
                                <div class="text-muted">6 Mb</div>
                            </div>


                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div> -->


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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</body>
</html>