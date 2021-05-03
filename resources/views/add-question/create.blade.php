@extends('layout.main')
@section('title', 'Add-Question')

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
									@if(isset($exams) && isset($difficultyLevels))
										@if($exams->count() > 0)
											<div class="card-body ">
												<form method="post" action="{{ route('add-question.store') }}">
													@csrf
													
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="question-no" class="mt-2" ><p>Exam Name:</p></label>
														</div>
														<div class="form-group col-md-9">
															
															<select class="form-control @error('exam_id') is-invalid @enderror" name="exam_id" id="exam_id">
																@foreach($exams as $exam)
																	<option value="{{ $exam->id }}">{{ $exam->name }}</option>
																@endforeach
															</select>
														</div>
													</div>
													
													
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="question" class="mt-2" ><p>Question :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" class="form-control  @error('question') is-invalid @enderror"  id="question" name="question" placeholder="Enter The Question" tabindex="2" autofocus>
															@error('question')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="option-one" class="mt-2" ><p>Option One :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" class="form-control @error('option_one') is-invalid @enderror"  id="option_one" name="option_one" placeholder="Enter option one" tabindex="3" autofocus>
															@error('option_one')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="option-two" class="mt-2" ><p>Option Two :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" class="form-control @error('option_two') is-invalid @enderror"  id="option_two" name="option_two" placeholder="Enter option two" tabindex="4" autofocus>
															@error('option_two')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="option-three" class="mt-2" ><p>Option Three :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" class="form-control @error('option_three') is-invalid @enderror"  id="option_three" name="option_three" placeholder="Enter option three" tabindex="5" autofocus>
															@error('option_three')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="option-four" class="mt-2" ><p>Option Four :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" class="form-control @error('option_four') is-invalid @enderror"  id="option_four" name="option_four" placeholder="Enter option four" tabindex="6" autofocus>
															@error('option_four')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>

													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="correct-answer" class="mt-2" ><p>Correct Answer :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" class="form-control @error('correct_answer') is-invalid @enderror" id="correct_answer" name="correct_answer" placeholder="Enter Correct Answer" tabindex="7" autofocus>
															@error('correct_answer')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="difficulty-level" class="mt-2" ><p>Difficulty Level :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<select class="form-control @error('diff_level') is-invalid @enderror" name="diff_level" id="diff_level">
																@foreach($difficultyLevels as $difficultyLevel)
																	<option value="{{ $difficultyLevel->id }}">{{ $difficultyLevel->level_name }}</option>
																@endforeach
															</select>
															
															@error('diff_level')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
												

													<div class="form-group">
														<button class="btn btn-dark" type="submit" tabindex="8">Add a Question</button>
													</div>
												</form>
											</div>
										@else

										@endif
									@else
									@endif
								</div>
								<!--widget card ends-->
							</div>
						</div>
					</div>
					<!-- END PLACE PAGE CONTENT HERE -->
				</section>
				
@endsection