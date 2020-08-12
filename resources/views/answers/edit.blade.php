{{-- buat edit answernya --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            {{-- utilize bootstrap component --}}
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h1>Editing answer for question: <strong> {{ $question->title }} </strong></h1>
                    </div>
                    <hr>
                    {{-- form buat answer --}}
                    <form action="{{ route('questions.answers.update', [$question->id, $answer->id]) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            {{-- show validation error messages with $error --}}
                            <textarea name="body" cols="30" rows="7" class="form-control {{ $errors->has('body') ? 'is-invalid' : ''}}"> {{ old('body', $answer->body) }}</textarea>
                            {{-- invalid-feedback  --}}
                            @if ($errors->has('body'))
                                <div class="invalid-feedbacks">
                                    <strong>{{  $errors->first('body') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-outline-primary">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection