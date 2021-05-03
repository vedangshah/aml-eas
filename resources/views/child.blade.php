@extends('layout.main')
@section('title', 'EAS')




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
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="exam-name">Exam-Name</label>
											<input type="text" required class="form-control" id="exam-name" name="exam-name" placeholder="exam Name" tabindex="1" autofocus>
										</div>
                                    </div>
                                    
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="Max-question">Max-Question</label>
                                            <input type="number" min="1" required class="form-control" id="Max-question" name="Max-question" placeholder="Max-question" tabindex="2" autofocus>
										</div>
                                        
										<div class="form-group col-md-6">
											<label for="Max-Marks">Max-Marks</label>
                                            <input type="number" min="1" required class="form-control" id="Max-Marks" name="Max-Marks" placeholder="Max-Marks" tabindex="2" autofocus>
										</div>
									</div>
                                    
									
                                    <div class="form-row">
										<div class="form-group col-md-6">
											<label for="start-date">Start-Date</label>
											<input type="datetime-local" required class="form-control" required id="start-date" name="start-date" placeholder="Start-Date" tabindex="5" autofocus>										
										</div> 
                                        <div class="form-group col-md-6">
											<label for="end-date">End-Date</label>
                                            <input type="datetime-local" required class="form-control" id="end-date" name="end-date" placeholder="Company email" tabindex="4" autofocus>
										</div>
                                   
                                    </div> 

									<div class="form-group">
										<button class="btn btn-dark" tabindex="5">Submit</button>
									</div>
								</div>
							</div>
							<!--widget card ends-->
						</div>
					</div>
				</div>
				<!-- END PLACE PAGE CONTENT HERE -->
			</section>


@endsection


