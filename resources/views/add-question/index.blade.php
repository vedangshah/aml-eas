@extends('layout.main')
@section('title', 'examlist')

@section('scrpt')
    <link rel="stylesheet" href="{{asset('css/vendor/DataTables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css')}}">		<link rel="stylesheet" href="{{ asset('css/vendor/daterangepicker/daterangepicker.css')}}">
@endsection
@section('li')
     
<script src="{{asset('js/vendor/DataTables/datatables.min.js')}}"></script>
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
                                                <th>Exam Name</th>
                                                <th>Question</th>
                                                <th>Correct Answer</th>
                                                @if(auth()->user()->roles()->first()->name == 'Company')
                                                <th>Action</th>
                                                @endif
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
                                                                @foreach ($question->option as $option)
                                                                    @if ($option->is_correct == 1)
                                                                        <td>{{ $option->option_description }}</td>
                                                                    @endif
                                                                @endforeach
                                                                @if(auth()->user()->roles()->first()->name == 'Company')
                                                                    <td class="pt-1" style="display:flex;">
                                                                        <a href="{{ route('add-question.edit', $question->id) }}" class="btn btn-primary m-b-15 ml-2 mr-2">                                                                  <i class="fas fa-user-edit"></i>
                                                                        </a>
                                                                        
                                                                        <a href="{{ route('add-question.edit', $question->id) }}" class="btn btn-danger m-b-15 ml-2 mr-2">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                    </td>
                                                                @endif
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