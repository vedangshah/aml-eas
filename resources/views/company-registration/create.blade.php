@extends('layout.main')
@section('title', 'Company Registration')
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
                                    Create Company User
								</h4>
							</div>
						</div>
					</div>
				</div>
				<!--  container or container-fluid as per your need           -->
				<div class="container">
					<div class="row bg-light">
						<div class="col-lg-12">
							<!--widget card begin-->
							<div class="card m-b-30 bg-light">
								<div class="card-header">
									<h5 class="m-b-0">
										Create Company User
									</h5>
								</div>
								<div class="card-body ">
									<form method="post" action="{{ route('company-user.store') }}">
										@csrf
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="company-name">Name</label>
												<input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" placeholder="Company Name" tabindex="1" value="{{ old('company_name') }}" autofocus>
												@error('company_name')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
											<div class="form-group col-md-6">
												<label for="company_user_name">company-user-name</label>
												<input type="text" class="form-control @error('company_user_name') is-invalid @enderror" id="company_user_name" name="company_user_name" placeholder="Company User Name" tabindex="2" value="{{ old('company_user_name') }}" autofocus>
												@error('company_user_name')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>
										
										
										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="company_password">Password</label>
												<input type="password"  class="form-control @error('company_password') is-invalid @enderror" id="company_password" name="company_password" placeholder="password" tabindex="3" autofocus>										
												@error('company_password')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>                                          
											<div class="form-group col-md-6">
												<label for="company_email">Email</label>
												<input type="email"  class="form-control @error('company_email') is-invalid @enderror " id="company_email" name="company_email" placeholder="Company email" tabindex="4" autofocus>
											    @error('company_email')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>

										<div class="form-row">
											<div class="form-group col-md-6">
												<label for="company_address">Address</label>
												<textarea class="form-control  @error('company_address') is-invalid @enderror" id="company_address" name="company_address" tabindex="5" autofocus>
												</textarea>
												@error('company_address')
													<div class="invalid-feedback">{{ $message }}</div>
												@enderror
											</div>
										</div>
										<div class="form-group">
											<button class="btn btn-danger" type="submit" tabindex="6">Submit</button>
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
