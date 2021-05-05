<h5 id="question">
    {{ $question->description }}
</h5>
<div class="option-container">
    @foreach ($question->option as $option)
        <input type="radio" name="option" id="{{ $option->id }}" value="{{ $option->id }}" class="form-controller">
        <label for="{{ $option->id }}"> {{ $option->option_description }}</label><br>
    @endforeach
</div>
<button class="btn btn-primary float-right" id="submitAnswer">Submit & Next </button>