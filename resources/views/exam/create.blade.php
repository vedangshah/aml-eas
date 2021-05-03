@extends('layout.main')
@section('title', 'Create-Exam')

@section('scrpt')
<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/daterangepicker/daterangepicker.css') }}">
@endsection



@section('content')

<section class="admin-content">
				<!-- BEGIN PlACE PAGE CONTENT HERE -->
				<div class="bg-dark">
					<div class="container  m-b-30">
						<div class="row">
							<div class="col-12 text-white p-t-20 p-b-20">
								<h4 class="">
                                    Create exam
								</h4>
							</div>
						</div>
					</div>
				</div>
				<!--  container or container-fluid as per your need           -->
				<div class="container">
					<div class="row">
						<div class="col-lg-12 m-auto">
							<!--widget card begin-->
							<div class="card m-b-30">
								<div class="card-header">
									<h5 class="m-b-0">
										Create exam
									</h5>
								</div>
								<div class="card-body ">
								
								<form method="post" action="{{ route('exam-user.store') }}">
								  @csrf
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="exam_name">Exam-Name</label>
											<input type="text" class="form-control @error('exam_name') is-invalid @enderror" id="exam_name" name="exam_name" placeholder="exam Name" tabindex="1" autofocus>
											@error('exam_name')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										
										</div>
                                    </div>
                                    
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="Max_question">Max_question</label>
                                            <input type="text" min="1"  class="form-control @error('Max_question') is-invalid @enderror" id="Max_question" name="Max_question" placeholder="Max_question" tabindex="2" autofocus>
											@error('Max_question')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										 
										</div>
                                        
										<div class="form-group col-md-6">
											<label for="Max_Marks">Max_Marks</label>
                                            <input type="text" min="1" class="form-control @error('Max_Marks') is-invalid @enderror" id="Max_Marks" name="Max_Marks" placeholder="Max_Marks" tabindex="3" autofocus>
											@error('Max_Marks')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										
										
										</div>
									</div>
                                    
									
                                    <div class="form-row">
										<div class="form-group col-md-6">
											<label for="start_date">start_date</label>
											<input type="text"  class="form-control input-daterange-timepicker @error('start_date') is-invalid @enderror"  id="start_date" name="start_date" placeholder="yyyy-mm-dd" tabindex="4" autofocus>										
										   
											@error('start_date')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div> 
                                        <div class="form-group col-md-6">
											<label for="end_date">end_date</label>
                                            <input type="text"  class="form-control input-daterange-timepicker @error('end_date') is-invalid @enderror" id="end_date" name="end_date" placeholder="yyyy-mm-dd" tabindex="5" autofocus>
											@error('end_date')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
                                   
                                    </div> 

									<div class="form-group">
										<button class="btn btn-dark" tabindex="6">Submit</button>
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
@section('li')
<script src="{{ asset('js/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('js/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script>
	$('.input-daterange-timepicker').daterangepicker({
        timePicker:true,
        singleDatePicker: true,
        locale: { format: 'YYYY-MM-DD hh:mm:ss' }
    });
</script>
@endsection