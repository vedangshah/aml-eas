@extends('layout.main')
@section('title', 'jobseeker-registration')
@section('content')

@foreach(['success', 'error'] as $key)
	@if(Session::has($key))
		<div class="alert alert-{{ $key }} alert-block">
			<button type="button" class="close" data-dismiss='alert'>x</button>
			{{ Session::get($key) }}
		</div>
	@endif
@endforeach
<section class="admin-content">
				<!-- BEGIN PlACE PAGE CONTENT HERE -->
				<div class="bg-dark">
					<div class="container  m-b-30">
						<div class="row">
							<div class="col-12 text-white p-t-20 p-b-20">
								<h4 class="">
                                    Create Jobseeker User
								</h4>
							</div>
						</div>
					</div>
				</div>
				<!--  container or container-fluid as per your need           -->
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<!--widget card begin-->
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="m-b-0">
										Create Jobseeker User
									</h5>
								</div>
								<div class="card-body ">
								<form method="post" >
									@csrf
									<input type="hidden" name="user_id" value="{{ $role_id_for_jobseeker }}">
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="jobseeker-name">Name</label>
											<input type="text" class="form-control @error('jobseeker_name') is-invalid @enderror"  id="jobseeker_name" name="jobseeker_name" placeholder="Jobseeker Name" tabindex="1" autofocus>                                       
											@error('jobseeker_name')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										
										<div class="form-group col-md-6">
											<label for="jobseeker-email">E-mail</label>
                                            <input type="email" class="form-control @error('jobseeker_email') is-invalid @enderror"  id="jobseeker_email" name="jobseeker_email" placeholder="Jobseeker-Email" tabindex="2" autofocus>
											@error('jobseeker_email')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
									</div>
                                    <div class="form-row">
										<div class="form-group col-md-6">
											<label for="jobseeker-contact-no">Contact No</label>
											<input type="text" class="form-control @error('jobseeker_contact_no') is-invalid @enderror"  id="jobseeker_contact_no" name="jobseeker_contact_no" placeholder="Jobseeker-Contact-No" tabindex="3" autofocus>
											@error('jobseeker_contact_no')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="form-group col-md-6">
											<label for="jobseeker-birth-date">Date-of-Birth</label>
                                            <input type="date"  class="form-control @error('jobseeker_birth_date') is-invalid @enderror" id="jobseeker_birth_date" name="jobseeker_birth_date" placeholder="Jobseeker-Birth-Date" tabindex="4" autofocus>
											@error('jobseeker_birth_date')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										  </div>
                                          
                                    </div>
                                    <div class="form-row">
										<div class="form-group col-md-6">
											<label for="user-name">User-Name</label>
											<input type="text" class="form-control @error('user_name') is-invalid @enderror" id="user_name" name="user_name" placeholder="user-Name" tabindex="5" autofocus>				
											@error('user_name')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											</div>
										<div class="form-group col-md-6">
											<label for="jobseeker-password">Password</label>
                                            <input type="password" class="form-control @error('jobseeker_password') is-invalid @enderror" id="jobseeker_password" name="jobseeker_password" placeholder="Password" tabindex="6" autofocus>                                    
											@error('jobseeker_password')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
											</div>
                                         </div>    
                                    <div class="form-row">      
										<div class="form-group col-md-6">
											<label for="jobseeker-address">Address</label>
                                            <textarea class="form-control @error('jobseeker_password') is-invalid @enderror" id="jobseeker_address" name="jobseeker_address" tabindex="7" autofocus>
                                            </textarea>
											@error('jobseeker_address')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
                                          
										<div class="form-group col-md-6 mt-5">
										        
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
									  
                                          </div>
									</div>
									<div class="form-group">
										<button class="btn btn-dark" type="submit" tabindex="9">Submit</button>
									</div>
									</form>
								</div>
							</div>
							<!--widget card ends-->
						</div>
					</div>
				</div>
				<!-- END PLACE PAGE CONTENT HERE -->
</section>
@endsection