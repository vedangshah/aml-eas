@extends('layout.main')
@section('title', 'Add-Question')

@section('content')

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
								@if(isset($exams) && isset($difficultyLevels) && isset($question))
									@if($exams->count() > 0)
										@if($question->count() > 0)
											<div class="card-body ">
												<form method="POST" action="{{ route('add-question.update', $question->id) }}">
													@csrf
													@method("PUT")
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="question-no" class="mt-2" ><p>Exam Name:</p></label>
														</div>
														<div class="form-group col-md-9">
															
															<select class="form-control @error('exam_id') is-invalid @enderror" name="exam_id" id="exam_id">
																@foreach($exams as $exam)
																	@if ($question->exam_id == $exam->id)
																	<option value="{{ $exam->id }}" selected>{{ $exam->name }}</option>
																	@else
																	<option value="{{ $exam->id }}">{{ $exam->name }}</option>
																	@endif
																@endforeach
															</select>
														</div>
													</div>
													
													
													
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="question" class="mt-2" ><p>Question :</p></label>
													</div>
														<div class="form-group col-md-9">
															<input type="text" value="{{$question->description}}" class="form-control  @error('question') is-invalid @enderror"  id="question" name="question" placeholder="Enter The Question" tabindex="2" autofocus>
															@error('question')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
													<div class="form-row">
														<div class="form-group col-md-3">
														<label for="difficulty-level" class="mt-2" ><p>Options :</p></label>
											
													</div>
													<div class="col-md-9" style="display:flex">
															@foreach ($question->option as $opt)
																	@if ($opt->is_correct)
																		@php $correct_answer = $opt->option_description; @endphp
																	@endif
																	<input type="text" class="form-control ml-2" name="options[]" id="option_{{ $loop->iteration }}" value="{{ $opt->option_description }}">
																
															@endforeach
															</div>
													</div>
													
													<div class="form-row">
														<div class="form-group col-md-3">
															<label for="correct-answer" class="mt-2" ><p>Correct Answer :</p></label>
													</div>
														<div class="form-group col-md-9">
															
															<input type="text" value="{{ $correct_answer }}"  class="form-control @error('correct_answer') is-invalid @enderror" id="correct_answer" name="correct_answer" placeholder="Enter Correct Answer" tabindex="7" autofocus>
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
															
															<select  class="form-control @error('diff_level') is-invalid @enderror" name="diff_level" id="diff_level">
																@foreach($difficultyLevels as $difficultyLevel)
																@if ($question->difficulty_levels_id == $difficultyLevel->id)
																<option value="{{ $difficultyLevel->id }}" selected>{{ $difficultyLevel->level_name }}</option>
																	@else
																	<option value="{{ $difficultyLevel->id }}">{{ $difficultyLevel->level_name }}</option>
																	@endif
																	
																@endforeach
															</select>
															
															@error('diff_level')
																<div class="invalid-feedback">{{ $message }}</div>
															@enderror
														</div>
													</div>
												
												

													<div class="form-group">
														<button class="btn btn-dark" tabindex="8">Update</button>
													</div>
												</form>
											</div>
										@endif
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