<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-touch-fullscreen" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="default">
		<title>Atmos Admin Panel- Bootstrap 4 Based Admin Panel</title>
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
		
			</head>
	<!--body with default sidebar pinned -->
	<body class="sidebar-pinned">
		<!--sidebar Begins-->
		<aside class="admin-sidebar">
			<div class="admin-sidebar-brand">
				<!-- begin sidebar branding-->
				<img class="admin-brand-logo" src="{{ asset('img/logo.svg') }}" width="40" alt="atmos Logo">
				<span class="admin-brand-content"><a href="index.html">  atmos</a></span>
				<!-- end sidebar branding-->
				<div class="ml-auto">
					<!-- sidebar pin-->
					<a href="#" class="admin-pin-sidebar btn-ghost btn btn-rounded-circle"></a>
					<!-- sidebar close for mobile device-->
					<a href="#" class="admin-close-sidebar"></a>
				</div>
			</div>
			<div class="admin-sidebar-wrapper js-scrollbar">
				<!-- Menu List Begins-->
				<ul class="menu">
					<!--list item begins-->
					<li class="menu-item active">
						<a href="#" class="menu-link">
						<span class="menu-label">
						<span class="menu-name">Link
						</span>
						</span>
						<span class="menu-icon">
						<span class="icon-badge badge-success badge badge-pill">1</span>
						<i class="icon-placeholder mdi mdi-link-variant "></i>
						</span>
						</a>
					</li>
					<!--list item ends-->
					<!--list item begins-->
					<li class="menu-item ">
						<a href="#" class="open-dropdown menu-link">
						<span class="menu-label">
						<span class="menu-name">Menu level 1
						<span class="menu-arrow"></span>
						</span>
						<span class="menu-info">Contains submenu</span>
						</span>
						<span class="menu-icon">
						<i class="icon-placeholder mdi mdi-link-variant "></i>
						</span>
						</a>
						<!--submenu-->
						<ul class="sub-menu">
							<li class="menu-item">
								<a href="#" class=" menu-link">
								<span class="menu-label">
								<span class="menu-name">Menu Level 1.1</span>
								</span>
								<span class="menu-icon">
								<i class="icon-placeholder  ">
								L
								</i>
								</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="#" class=" menu-link">
								<span class="menu-label">
								<span class="menu-name">Menu Level 1.1</span>
								</span>
								<span class="menu-icon">
								<i class="icon-placeholder  ">
								L
								</i>
								</span>
								</a>
							</li>
						</ul>
					</li>
					<!--list item ends-->
					<!--list item begins-->
					<li class="menu-item ">
						<a href="#" class="open-dropdown menu-link">
						<span class="menu-label">
						<span class="menu-name">Menu Level 2
						<span class="menu-arrow"></span>
						</span>
						<span class="menu-info">Contains submenu</span>
						</span>
						<span class="menu-icon">
						<i class="icon-placeholder mdi mdi-link-variant "></i>
						</span>
						</a>
						<!--submenu-->
						<ul class="sub-menu">
							<li class="menu-item">
								<a href="#" class=" menu-link">
								<span class="menu-label">
								<span class="menu-name">Menu Level 1.1</span>
								</span>
								<span class="menu-icon">
								<i class="icon-placeholder  ">
								L
								</i>
								</span>
								</a>
							</li>
							<li class="menu-item">
								<a href="#" class="open-dropdown menu-link">
								<span class="menu-label">
								<span class="menu-name">Menu Level 1.1
								<span class="menu-arrow"></span>
								</span>
								</span>
								<span class="menu-icon">
								<i class="icon-placeholder mdi mdi-link-variant "></i>
								</span>
								</a>
								<!--submenu-->
								<ul class="sub-menu">
									<li class="menu-item">
										<a href="#" class=" menu-link">
										<span class="menu-label">
										<span class="menu-name">Menu Level 2.1 </span>
										</span>
										<span class="menu-icon">
										<i class="icon-placeholder  ">
										L
										</i>
										</span>
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!--list item ends-->
				</ul>
				<!-- Menu List Ends-->
			</div>
		</aside>
		<!--sidebar Ends-->
		<main class="admin-main">
			<!--site header begins-->
			<header class="admin-header">
				<a href="#" class="sidebar-toggle" data-toggleclass="sidebar-open" data-target="body"> </a>
				<nav class=" mr-auto my-auto">
					<ul class="nav align-items-center">
						<li class="nav-item">
							<a class="nav-link  " data-target="#siteSearchModal" data-toggle="modal" href="#">
							<i class=" mdi mdi-magnify mdi-24px align-middle"></i>
							</a>
						</li>
					</ul>
				</nav>
				<nav class=" ml-auto">
					<ul class="nav align-items-center">
						<li class="nav-item">
							<div class="dropdown">
								<a href="#" class="nav-link" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-24px mdi-bell-outline"></i>
								<span class="notification-counter"></span>
								</a>
								<div class="dropdown-menu notification-container dropdown-menu-right">
									<div class="d-flex p-all-15 bg-white justify-content-between border-bottom ">
										<a href="#!" class="mdi mdi-18px mdi-settings text-muted"></a>
										<span class="h5 m-0">Notifications</span>
										<a href="#!" class="mdi mdi-18px mdi-notification-clear-all text-muted"></a>
									</div>
									<div class="notification-events bg-gray-300">
										<div class="text-overline m-b-5">today</div>
										<a href="#" class="d-block m-b-10">
											<div class="card">
												<div class="card-body"> <i class="mdi mdi-circle text-success"></i> All systems operational.</div>
											</div>
										</a>
										<a href="#" class="d-block m-b-10">
											<div class="card">
												<div class="card-body"> <i class="mdi mdi-upload-multiple "></i> File upload successful.</div>
											</div>
										</a>
										<a href="#" class="d-block m-b-10">
											<div class="card">
												<div class="card-body">
													<i class="mdi mdi-cancel text-danger"></i> Your holiday has been denied
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown ">
							<a class="nav-link dropdown-toggle" href="#"   role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false">
								<div class="avatar avatar-sm avatar-online">
									<span class="avatar-title rounded-circle bg-dark">V</span>
								</div>
							</a>
							<div class="dropdown-menu  dropdown-menu-right"   >
								<a class="dropdown-item" href="#">  Add Account
								</a>
								<a class="dropdown-item" href="#">  Reset Password</a>
								<a class="dropdown-item" href="#">  Help </a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"> Logout</a>
							</div>
						</li>
					</ul>
				</nav>
			</header>
			<!--site header ends -->    
			<section class="admin-content">
				<!-- BEGIN PlACE PAGE CONTENT HERE -->
				<div class="bg-dark">
					<div class="container  m-b-30">
						<div class="row">
							<div class="col-12 text-white p-t-20 p-b-20">
								<h4 class="">
                                    Add Question
								</h4>
							</div>
						</div>
					</div>
				</div>
				<!--  container or container-fluid as per your need           -->
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<!--widget card begin-->
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="m-b-0">
										Add Question
									</h5>
								</div>
								<div class="card-body ">
									<div class="form-row">
										<div class="form-group col-md-3">
											<label for="question-no" class="mt-2" ><p>Question No:</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="number" class="form-control" required id="question-no" name="question-no" placeholder="question-no" tabindex="2" autofocus>
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="question" class="mt-2" ><p>Question :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="text" class="form-control" required id="question" name="question" placeholder="Enter The Question" tabindex="2" autofocus>
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="option-one" class="mt-2" ><p>Option One :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="text" class="form-control" required id="option-one" name="option-one" placeholder="Enter option one" tabindex="2" autofocus>
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="option-two" class="mt-2" ><p>Option Two :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="text" class="form-control" required id="option-two" name="option-two" placeholder="Enter option two" tabindex="2" autofocus>
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="option-three" class="mt-2" ><p>Option Three :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="text" class="form-control" required id="option-three" name="option-three" placeholder="Enter option three" tabindex="2" autofocus>
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="option-four" class="mt-2" ><p>Option Four :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="text" class="form-control" required id="option-four" name="option-four" placeholder="Enter option four" tabindex="2" autofocus>
										</div>
									</div>

                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="correct-answer" class="mt-2" ><p>Correct Answer :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <input type="text" class="form-control" required id="correct-answer" name="correct-answer" placeholder="Enter Correct Answer" tabindex="2" autofocus>
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-3">
											<label for="difficulty-level" class="mt-2" ><p>Difficulty Level :</p></label>
									   </div>
										<div class="form-group col-md-9">
											
                                            <select class="form-control">
                                                <option selected>-select-level-</option>
                                                <option>Easy</option>
                                                <option>Medium</option>
                                                <option>Hard</option>

                                            </select>
										</div>
									</div>
                                

									<div class="form-group">
										<button class="btn btn-dark" tabindex="9">Add a Question</button>
									</div>
								</div>
							</div>
							<!--widget card ends-->
						</div>
					</div>
				</div>
				<!-- END PLACE PAGE CONTENT HERE -->
			</section>
		</main>
		<div class="modal modal-slide-left  fade" id="siteSearchModal" tabindex="-1" role="dialog" aria-labelledby="siteSearchModal"
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
		</div>
		<!--page specific scripts for demo-->
	</body>
    
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
	
</html>