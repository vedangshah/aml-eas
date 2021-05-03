@extends('layout.main')
@section('title', 'examlist')

@foreach(['success', 'error'] as $key)
	@if(Session::has($key))
		<div class="alert alert-{{ $key }} alert-block">
			<button type="button" class="close" data-dismiss='alert'>x</button>
			{{ Session::get($key) }}
		</div>
	@endif
@endforeach

@section('scrpt')
    <link rel="stylesheet" href="{{asset('css/vendor/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">		<link rel="stylesheet" href="{{ asset('css/vendor/daterangepicker/daterangepicker.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

@endsection
@section('li')
     
<script src="{{asset('js/vendor/DataTables/datatables.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js" integrity="sha512-GDey37RZAxFkpFeJorEUwNoIbkTwsyC736KNSYucu1WJWFK9qTdzYub8ATxktr6Dwke7nbFaioypzbDOQykoRg==" crossorigin="anonymous"></script>
<script src="{{asset('js/vendor/datatable-data.js')}}"></script>



           <script> 
		    $(document).ready(function(event){
                 $("#datatableid").dataTable({
                     "pagingType" : "full_numbers",
                     "pageLength": 5,
                     "lengthChange": false,
                     "ordering": false,
                     responsive:true,
                     language:{
                         search:"_INPUT_",
                         searchPlaceholder:"Search records",
                     }
                 });
			});

			</script>		
	    
@endsection
@section('content')
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
                                            <th>Created by</th>
                                            <th>Exam Name</th>
                                            <th>Max-Question</th>
                                            <th>Max-Marks</th>
                                            <th>Start-Date</th>
                                            <th>End-Date</th>
                                            @if(auth()->user()->roles()->first()->name == 'Company')
                                            <th>Action</th>
                                            @endif
                                            @if(auth()->user()->roles()->first()->name == 'JobSeeker')
                                            <th>Enrol Exam</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if(isset($exams))
                                            @if($exams->count() > 0)
                                                @php $count = 0 @endphp
                                                @foreach($exams as $exam)
                                                        <tr>
                                                            <td>{{ ++$count }}</td>
                                                            <td>{{ $exam->user->name}}</td>
                                                            <td>{{ $exam->name}}</td>
                                                            <td>{{ $exam->max_questions }}</td>
                                                            <td>{{ $exam->max_marks }}</td>
                                                            <td>{{ $exam->start_date_time }}</td>
                                                            <td>{{ $exam->end_date_time }}</td>
                                                            @if(auth()->user()->roles()->first()->name == 'Company')
                                                                <td class="pt-1"  style="display:flex">
                                                                    <a href="{{ route('exam-user.edit', $exam->id) }}" class="btn btn-primary m-b-15 ml-2 mr-2">                                                                 
                                                                        <i class="fas fa-user-edit"></i>
                                                                    </a>
                                                                    
                                                                    <a href="{{ route('exam-user.edit', $exam->id) }}" class="btn btn-danger m-b-15 ml-2 mr-2">
                                                                        <i class="far fa-trash-alt"></i>
                                                                    </a>
                                                                </td>
                                                            @endif  
                                                            @if(auth()->user()->roles()->first()->name == 'JobSeeker')
                                                            <td class="pt-1">
                                                                @if ($page == 'exam-user')
                                                                    <a href="{{ route('enroll-user', $exam->id) }}" class="btn btn-primary m-b-15 ml-2 mr-2">
                                                                    <i class="fas fa-plus"></i>
                                                                    
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('enroll-user', $exam->id) }}" class="btn btn-primary m-b-15 ml-2 mr-2">
                                                                    start exam
                                                                    </a>    
                                                                @endif
                                                            </td>        
                                                            @endif  
                                                        </tr>
                                                
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
                                                    <td colspan="6">Internal Server Error</td>
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