{{-- buat answernya --}}
<div class="row mt-4">
    <div class="col-md-12">
        {{-- utilize bootstrap component --}}
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer </h3>
                </div>
                <hr>
                {{-- form buat answer --}}
                <form action="{{ route('questions.answers.store', $question->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        {{-- show validation error messages with $error --}}
                        <textarea name="body" cols="30" rows="7" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"></textarea>
                        {{-- invalid-feedback  --}}
                        @if ($errors->has('body'))
                            <div class="invalid-feedbacks">
                                <strong>{{  $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>