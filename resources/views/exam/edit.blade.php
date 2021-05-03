@extends('layout.main')
@section('title', 'Create-Exam')


@section('scrpt')
<link rel="stylesheet" type="text/css" href="{{ asset('css/vendor/daterangepicker/daterangepicker.css') }}">
@endsection

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
                                    Update exam
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
										Update exam
									</h5>
								</div>
								<div class="card-body ">
								
								<form method="POST" action="{{ route('exam-user.update', $exam->id) }}">
								  @csrf
                                  @method("PUT")
									<div class="form-row">
										<div class="form-group col-md-12">
											<label for="exam_name">Exam-Name</label>
											<input type="text" class="form-control @error('exam_name') is-invalid @enderror" value="{{$exam->name}}" id="exam_name" name="exam_name" placeholder="exam Name" tabindex="1" autofocus>
											@error('exam_name')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										
										</div>
                                    </div>
                                    
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="Max_question">Max_question</label>
                                            <input type="text" min="1"  class="form-control  @error('Max_question') is-invalid @enderror" value="{{$exam->max_questions}}" id="Max_question" name="Max_question" placeholder="Max_question" tabindex="2" autofocus>
											@error('Max_question')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										 
										</div>
                                        
										<div class="form-group col-md-6">
											<label for="Max_Marks">Max_Marks</label>
                                            <input type="text" min="1" class="form-control @error('Max_Marks') is-invalid @enderror" value="{{$exam->max_marks}}" id="Max_Marks" name="Max_Marks" placeholder="Max_Marks" tabindex="3" autofocus>
											@error('Max_Marks')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										
										
										</div>
									</div>
                                    
									
                                    <div class="form-row">
										<div class="form-group col-md-6">
											<label for="start_date">start_date</label>
											<input type="text" value="{{$exam->start_date_time}}" class="form-control input-daterange-timepicker @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="yyyy-mm-dd HH-MM-SS" tabindex="4" autofocus>										
											@error('start_date')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div> 
                                        <div class="form-group col-md-6">
											<label for="end_date">end_date</label>
                                            <input type="text" value="{{$exam->end_date_time}}"  class="form-control input-daterange-timepicker @error('end_date') is-invalid @enderror"  id="end_date" name="end_date" placeholder="yyyy-mm-dd HH-MM-SS" tabindex="5" autofocus>
											@error('end_date')
													<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
                                   
                                    </div> 

									<div class="form-group">
										<button class="btn btn-dark" tabindex="6">Update</button>
									</div>
                                    <div class="form-group">
										<button class="btn btn-dark" id="{{route('add-question.create')}}" tabindex="7">Add Question</button>
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

			    <section class="admin-content">
                    <!-- BEGIN PlACE PAGE CONTENT HERE -->
                    <div class="bg-dark">
                        <div class="container  m-b-30">
                            <div class="row">
                                <div class="col-12 text-white p-t-20 p-b-20">
                                    <h4 class="">
                                        Exam List
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
                                            Exam List
                                        </h5>
                                    </div>
                                    <div class="card-body ">
                                        <div>
                                    <table id="datatableid" width="100%">
                                        <thead class="bg-dark text-white text-center">
                                            <tr>
                                                <th class="p-2">No.</th>
                                                <th>Exam Name</th>
                                                <th>Question</th>
                                                <th>Correct Answer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @if(isset($questions) )
                                                @if($questions->count() > 0)
                                                    @php $count = 0 @endphp
                                                    @foreach($questions as $question)
                                                        @if($question->option->count() > 0)
                                                            <tr>
                                                                <td>{{ ++$count }}</td>
                                                                
                                                                <td>{{ $question->exam->name }}</td>
                                                                <td>{{ $question->description }}</td>
                                                                <td>{{ $question->option[0]->is_correct }}</td>
                                                                <td class="pt-1" style="display:flex;">
                                                                    <a href="{{ route('add-question.edit', $question->id) }}" class="btn btn-primary m-b-15 ml-2 mr-2">                                                                  <i class="fas fa-user-edit"></i>
                                                                    </a>
                                                                    
                                                                    <a href="{{ route('add-question.edit', $question->id) }}" class="btn btn-danger m-b-15 ml-2 mr-2">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    
                                                @else
                                                    <tr>
                                                        <td colspan="6">No Records Found</td>
                                                    </tr>
                                                @endif
                                            @else
                                                @if(isset($errorMessage))
                                                    <tr>
                                                        <td colspan="6">{{ $errorMessage }}</td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        <td colspan="6">Internal Server Errorss</td>
                                                    </tr>
                                                @endif
                                            @endif
                                        </tbody>
                                    </table>
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
