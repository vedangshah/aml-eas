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
					<li class="menu-item {{ (Request::is('dashboard') ? 'active' : '') }}">
						<a href="#" class="menu-link">
						<span class="menu-label">
						<span class="menu-name">Dashboard
						</span>
						</span>
						<!-- <span class="menu-icon">
						<span class="icon-badge badge-success badge badge-pill">1</span>
						<i class="icon-placeholder mdi mdi-link-variant "></i>
						</span> -->
						</a>
					</li>
					<!--list item ends-->
					<!--list item begins-->
					@if(auth()->user()->roles()->first()->name == 'Admin')
						<li class="menu-item {{ (Request::is('company-user/*') || Request::is('company-user') ? 'active' : '') }}">
							<a href="#" class="open-dropdown menu-link">
								<span class="menu-label">
									<span class="menu-name">Company Users
										<span class="menu-arrow"></span>
									</span>
									<!-- <span class="menu-info">Contains submenu</span> -->
								</span>
								<span class="menu-icon">
									<i class="icon-placeholder mdi mdi-link-variant "></i>
								</span>
							</a>
							<!--submenu-->
							<ul class="sub-menu" style="{{ (Request::is('company-user/*') || Request::is('company-user') ? 'display: block;' : 'display: none;') }}">
								<li class="menu-item {{ (Request::url() == route('company-user.create') ? 'active' : '') }}">
									<a href="{{ route('company-user.create') }}" class="menu-link">
										<span class="menu-label">
											<span class="menu-name">Create</span>
										</span>
										<span class="menu-icon">
											<i class="icon-placeholder  ">
												L
											</i>
										</span>
									</a>
								</li>
								<li class="menu-item {{ (Request::url() == route('company-user.index') ? 'active' : '') }}">
									<a href="{{ route('company-user.index') }}" class=" menu-link">
										<span class="menu-label">
											<span class="menu-name">View All</span>
										</span>
										<span class="menu-icon">
											<i class="icon-placeholder  ">
												L
											</i>
										</span>
									</a>
								</li>
							</ul							
						</li>
					@endif
					<!--list item ends-->
					<!--list item begins-->
					@if(auth()->user()->roles()->first()->name == 'Admin' || auth()->user()->roles()->first()->name == 'Company' || auth()->user()->roles()->first()->name == 'JobSeeker')
						<li class="menu-item {{ (Request::url() == route('exam-user.create') ? 'active' : '') }}" >
							<a href="#" class="open-dropdown menu-link">
								<span class="menu-label">
									<span class="menu-name ">Exams
										<span class="menu-arrow"></span>
									</span>
									<!-- <span class="menu-info">Contains submenu</span> -->
								</span>
								<span class="menu-icon">
									<i class="icon-placeholder mdi mdi-link-variant "></i>
								</span>
							</a>
							<!--submenu-->
							<ul class="sub-menu" style="{{ (Request::is('exam-user/*') || Request::is('exam-user') ? 'display: block;' : 'display: none;') }}" >
								@if(auth()->user()->roles()->first()->name == 'Company')
									<li class="menu-item {{ (Request::url() == route('exam-user.create') ? 'active' : '') }}">
										<a href="{{ route('exam-user.create') }}" class=" menu-link">
											<span class="menu-label">
												<span class="menu-name">Create</span>
											</span>
											<span class="menu-icon">
												<i class="icon-placeholder  ">
													L
												</i>
											</span>
										</a>
									</li>
								@endif
								
								<li class="menu-item {{(Request:: url() == route('exam-user.index') ? 'active' : '')}} ">
				
									<a href="{{route('exam-user.index')}}?page=exam-user" class=" menu-link">
										<span class="menu-label">
											<span class="menu-name" >View All Exams</span>
										</span>
										<span class="menu-icon">
											<i class="icon-placeholder  ">
												L
											</i>
											</span>
									</a>
								    <li>
									<a href="#" class=" menu-link">
										<span class="menu-label">
											<span class="menu-name" >View Enrolled Exams
											
											   
									             	<span class="menu-arrow"></span>
											</span>
										</span>
										
											<span class="menu-icon">
												<i class="icon-placeholder mdi mdi-link-variant "></i>
											</span>
									</a>
									<li class="menu-item {{(Request:: url() == route('exam-user.index') ? 'active' : '')}} ">
				
										<a href="{{route('upexam')}}?page=exam-enrolled-user" class=" menu-link">
											<span class="menu-label">
												<span class="menu-name" >Upcoming Exams</span>
											</span>
											<span class="menu-icon">
												<i class="icon-placeholder  ">
													L
												</i>
												</span>
										</a>
										<li>
											
										<a href="{{route('cexam')}}?page=exam-enrolled-user" class=" menu-link">
											<span class="menu-label">
												<span class="menu-name" >Completed Exams</span>
											</span>
											<span class="menu-icon">
												<i class="icon-placeholder  ">
													L
												</i>
												</span>
										</a>
													
									
										</li>
									</li>
			
								
									</li>
								</li>
                             </ul>	
							
						</li>
					@endif
					@if(auth()->user()->roles()->first()->name == 'JobSeeker')
						<li class="menu-item {{ (Request::url() == route('exam-user.create') ? 'active' : '') }}" >
								<a href="#" class="open-dropdown menu-link">
									<span class="menu-label">
										<span class="menu-name ">Result
											<span class="menu-arrow"></span>
										</span>
										<!-- <span class="menu-info">Contains submenu</span> -->
									</span>
									<span class="menu-icon">
										<i class="icon-placeholder mdi mdi-link-variant "></i>
									</span>
								</a>
								<!--submenu-->
								<ul class="sub-menu" >
										<a href="#" class=" menu-link">
											<span class="menu-label">
												<span class="menu-name" >View Result</span>
											</span>
										    <span class="menu-icon">
												<i class="icon-placeholder mdi mdi-link-variant "></i>
								            </span>
							
										</a>
									</li>
								</ul>	
								
							</li>
						@endif	
					<!--list item ends-->
					<!--list item begins-->
					@if(auth()->user()->roles()->first()->name == 'Company' || auth()->user()->roles->first()->name == 'Admin')
						<li class="menu-item {{ (Request::url() == route('add-question.create') ? 'opened' : '') }}">
							<a href="#" class="open-dropdown menu-link">
							<span class="menu-label">
							<span class="menu-name">Question
							<span class="menu-arrow"></span>
							</span>
							<span class="menu-info"></span>
							</span>
							<span class="menu-icon">
							<i class="icon-placeholder mdi mdi-link-variant "></i>
							</span>
							</a>
							<!--submenu-->
							@if(auth()->user()->roles()->first()->name == 'Company')
							<ul class="sub-menu" style="{{ (Request::is('add-question/*') || Request::is('/view') || Request::is('add-question') ? 'display: block;' : 'display: none;') }}">
								<li class="menu-item {{ (Request::url() == route('add-question.create') ? 'active' : '') }}">
									<a href="{{route('add-question.create')}}" class=" menu-link">
									<span class="menu-label">
									<span class="menu-name">Add questions</span>
									</span>
									<span class="menu-icon">
									<i class="icon-placeholder  ">
									L
									</i>
									</span>
									</a>
								</li>
							@endif
								
									<li class="menu-item {{(Request:: url() == route('add-question.index') ? 'active' : '')}} ">
					
										<a href="{{route('add-question.index')}}" class=" menu-link">
											<span class="menu-label">
												<span class="menu-name" >View All</span>
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
					@endif
					<!--list item ends-->
				</ul>
				<!-- Menu List Ends-->
			</div>
		</aside>