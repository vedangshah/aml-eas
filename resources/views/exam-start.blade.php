@extends('layout.main')
@section('title', 'Exam Starts')

@foreach(['success', 'error'] as $key)
	@if(Session::has($key))
		<div class="alert alert-{{ $key }} alert-block">
			<button type="button" class="close" data-dismiss='alert'>x</button>
			{{ Session::get($key) }}
		</div>
	@endif
@endforeach

@section('content')
    <section class="admin-content">
        <!-- BEGIN PlACE PAGE CONTENT HERE -->
        <div class="bg-dark">
            <div class="container  m-b-30">
                <div class="row">
                    <div class="col-12 text-white p-t-20 p-b-20">
                        <h4 class="">
                            Exam Starts
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
                            <h5 class="m-b-0" id="questionNumber">
                                Question 1
                            </h5>
                            <hr>
                        </div>
                        <div class="card-body ">
                            <div class="question-container">
                                <h5 id="question">
                                    This is a question
                                </h5>
                                <div class="option-container">
                                    <input type="radio" name="option" class="form-controller">
                                    <label for="">a) ABCD</label><br>
                                    <input type="radio" name="option" class="form-controller">
                                    <label for="">b) DEFG</label><br>
                                    <input type="radio" name="option" class="form-controller">
                                    <label for="">c) JKLM</label><br>
                                    <input type="radio" name="option" class="form-controller">
                                    <label for="">d) PQRS</label>
                                </div>
                                <button class="btn btn-primary float-right" id="submitAnswer">Submit & Next </button>
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

@section('scrpt')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        var usersExamDetails = [
            {
                'maxQuestions': "{{ $exam->max_questions }}",
                'correctlyAttemptedQuestions' : 0
            }
        ];
        var questionCount = 0;
        var currentQuestion;

        function questionToBeFetched()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var data = {};
            if (usersExamDetails.length > 1)
            {
                if (usersExamDetails[0]['maxQuestions'] <= usersExamDetails[0]['correctlyAttemptedQuestions']) {
                    Swal.fire({
                        title: "success!",
                        text: 'You have reached to the maximum questions to pass the exam. Collect your certificate from the result tab.',
                        icon: "success",
                        onClose: function() {
                            window.location.href = "{{ route('examStart', request()->examId) }}"
                        }
                    });
                }
                else
                {
                    var consecutiveCorrect = [];
                    var difficultyLevel = [];
                    data['questionIds'] = [];
                    usersExamDetails.slice().reverse().every(function(cValue, index) {
                        if (index >= usersExamDetails.length - 1) {
                            return false;
                        }
                        difficultyLevel.push(cValue.difficultyLevel);
                        if (index <= 1) {
                            if (cValue.isCorrect) {
                                consecutiveCorrect.push(true);
                            } else {
                                consecutiveCorrect.push(false);
                            }
                        }
                        data['questionIds'].push(cValue.questionId);
                        return true;
                    });
                    
                    if (difficultyLevel.length == 1) {
                        data['difficultyLevel'] = difficultyLevel[0];
                    } else if (difficultyLevel[0] == difficultyLevel[1]) {
                        if ((consecutiveCorrect[0] == consecutiveCorrect[1]) && (consecutiveCorrect[0] == true)) {
                            if (difficultyLevel[0] == 3) {
                                data['difficultyLevel'] = difficultyLevel[0];
                            } else {
                                data['difficultyLevel'] = difficultyLevel[0] + 1;
                            }
                        } else if (consecutiveCorrect[0] != consecutiveCorrect[1])  {
                            if ((difficultyLevel[0] == 1) || (consecutiveCorrect[0] == true || consecutiveCorrect[1] == true)) {
                                data['difficultyLevel'] = difficultyLevel[0];
                            } else {
                                data['difficultyLevel'] = difficultyLevel[0] - 1;
                            }
                        } else {
                            if (difficultyLevel[0] == 1) {
                                data['difficultyLevel'] = difficultyLevel[0];
                            } else {
                                data['difficultyLevel'] = difficultyLevel[0] - 1;
                            }
                        }
                    } else {
                        if (((consecutiveCorrect[0] == consecutiveCorrect[1]) && (consecutiveCorrect[0] == true)) || (difficultyLevel[0] == 1)) {
                            data['difficultyLevel'] = difficultyLevel[0];
                        } else {
                            data['difficultyLevel'] = difficultyLevel[0] - 1;
                        }
                    }

                }
            }
            else
            {
                data['difficultyLevel'] = 1;
                data['questionIds'] = [];
            }

            return data;
        }

        function fetchQuestion()
        {
            var data = questionToBeFetched();
            $.ajax({
                type: 'GET',
                url: "{{ route('fetchQuestion', $exam->id) }}",
                data: data,
                success: function(result) {
                    if (result.hasOwnProperty('html')) {
                        $('.question-container').html(result.html);
                        questionCount += 1;
                        $('#questionNumber').text('Question ' + questionCount);
                        currentQuestion = result.questionDetails;
                        console.log(currentQuestion);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log(jqXHR);
                }
            });

        }

        $(document).ready(function() {
            fetchQuestion();

            $(document).on('click', '#submitAnswer', function (e) {
                var allOptions = $('input[name="option"]');
                var selectedOption;
                
                allOptions.each(function (index, ele) {
                    if ($(ele).is(':checked')) {
                        selectedOption = $(ele).val();
                    }
                });


                if (! selectedOption) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Please select one option',
                        icon: 'error',
                        timer: 2000,
                    });
                } else {
                    var chosenCorrectOption = false;
                    currentQuestion.option.every(function(option, index) {
                        if (option.is_correct == 1) {
                            if (option.id == selectedOption) {
                                chosenCorrectOption = true;
                                usersExamDetails[0]['correctlyAttemptedQuestions'] = usersExamDetails[0]['correctlyAttemptedQuestions'] + 1;
                                return false;
                            }
                        }
                        return true;
                    });

                    var submittedData = {
                        'selectedOption' : selectedOption,
                        'questionId': currentQuestion.id,
                    };

                    examDetails = {};

                    examDetails['difficultyLevel'] =currentQuestion. difficulty_levels_id;
                    examDetails['isCorrect'] = chosenCorrectOption ? 1 : 0;
                    examDetails['selectedOption'] = selectedOption;
                    examDetails['questionId'] = currentQuestion.id;

                    usersExamDetails.push(examDetails);


                    $.ajax({
                        type: 'POST',
                        url: "{{ route('submitAnswer', $exam->id) }}",
                        data: submittedData,
                        success: function(result) {
                            fetchQuestion();
                        },
                        error: function(jqXHR, exception) {
                            console.log(jqXHR);
                        }
                    }); 
                }
            });
        });
    </script>
@endsection

