@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        {{-- kelas d-flex ini  buat the content of both sides in the same base line --}}
                        <h2>Ask Questions</h2>
                        <div class="ml-auto">
                            {{-- will be positioned in the right --}}
                            <a href="{{ route('questions.index') }}"  class="btn btn-outline-secondary">Back to all Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   {{-- Question Form --}}
                <form action="{{  route('questions.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="question-title">
                            Question Title
                        </label>
                        <input type="text" name="title" id="question-title" class=" {{ $errors->has('title') ? 'is-invalid' : '' }} ">
                        
                        {{-- validation input --}}
                        {{-- if it found error message for title input, we'll show something and remember errors --}}
                        @if($errors->has('title'))
                            {{-- show message --}}
                            <div class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="question-body">
                            Explain your Question
                        </label>
                        <textarea name="body" id="question-body" cols="30" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }} "></textarea>
                        @if($errors->has('body'))
                            {{-- show message --}}
                            <div class="invalid-feedback">
                            <strong>{{ $errors->first('body') }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-primary btn-lg">
                            Ask this question
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
