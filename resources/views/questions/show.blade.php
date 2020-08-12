@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h1>{{ $question->title }}</h1>
                            <div class="ml-auto">
                                {{-- will be positioned in the right --}}
                                <a href="{{ route('questions.index') }}"  class="btn btn-outline-secondary">Back to all Questions</a>
                            </div>
                        </div>
                    </div>

                    <hr>
    
                    <div class="media">
                        {{-- vote control --}}
                        <div class="d-flex-column vote-controls">
                            <a title="This question is useful" class="vote-up">
                                {{-- ganti fontawesome --}}
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>

                            {{-- show the number of votes --}}
                            <div class="votes-count"> 12234</div>
                            {{-- vote down the vote --}}
                            <a  title="This question is not useful" class="vote-down off">
                                {{-- ganti fontawesome --}}
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            {{-- mark the question as favorite --}}
                            <a title="Click to mark as favorite question (CLick again to undo)" class="favorite mt-2 favorited">
                                {{-- ganti fontawesome --}}
                                <i class="fas fa-star fa-2x"></i>

                                {{-- how many people favorite this question --}}
                                <span class="favorites-count">123</span>
                            </a>
                        </div>
                       <div class="media-body">
                            {{-- karena question body is in markdown syntax --}}
                            {{-- jadi kita buat a new accessor where encapsulates the markdown to html conversion. --}}
                        {!!  $question->body_html !!}
    
                        {{-- add other info and creation date  of question--}}
                        <div class="float-right">
                            {{-- show answer creation date --}}
                            <span class="text-muted">
                                Questioned {{ $question->created_date }}</span>
                            <div class="media mt-2">
                                <a href="{{ $question->user->url }}" class="pr-2">
                                    <img src="{{ $question->user->avatar }}">
                                </a>
                                <div class="media-body mt-1">
                                    <a href="{{ $question->user->url }}">
                                    {{ $question->user->name }} </a>
                                </div>
                            </div>
                        </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- buat answernya --}}
    <div class="row mt-4">
        <div class="col-md-12">
            {{-- utilize bootstrap component --}}
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        {{-- total number answer of the curr question --}}
                        <h2>{{ $question->answers_count . " " . Str::plural('Answer', $question->answers_count) }}</h2>
                    </div>
                    <hr>
                    {{-- display all answer --}}
                    @foreach ($question->answers as $answer )
                        <div class="media">
                            {{-- vote control --}}
                            <div class="d-flex-column vote-controls">
                                <a title="This answer is useful" class="vote-up">
                                    {{-- ganti fontawesome --}}
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>

                                {{-- show the number of votes --}}
                                <div class="votes-count"> 12234</div>
                                {{-- vote down the vote --}}
                                <a  title="This answer is not useful" class="vote-down off">
                                    {{-- ganti fontawesome --}}
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>
                                {{-- mark the question as favorite --}}
                                <a title="Click this answer as best answer" class="vote-accepted mt-2">
                                    {{-- ganti fontawesome --}}
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                {!! $answer->body_html !!}

                                {{-- add other info and creation date --}}
                                <div class="float-right">
                                    {{-- show answer creation date --}}
                                    <span class="text-muted">
                                        Answered {{ $answer->created_date }}
                                        <div class="media mt-2">
                                        <a href="{{ $answer->user->url }}" class="pr-2">
                                            <img src="{{ $answer->user->avatar }}">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href="{{ $answer->user->url }}">
                                            {{ $answer->user->name }} </a>
                                        </div>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
