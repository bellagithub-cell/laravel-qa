@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h1>{{ $question->title }}</h1>
                        <div class="ml-auto">
                            {{-- will be positioned in the right --}}
                            <a href="{{ route('questions.index') }}"  class="btn btn-outline-secondary">Back to all Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- karena question body is in markdown syntax --}}
                    {{-- jadi kita buat a new accessor where encapsulates the markdown to html conversion. --}}
                  {!!  $question->body_html !!}

                  {{-- add other info and creation date  of question--}}
                  <div class="float-right">
                    {{-- show answer creation date --}}
                    <span class="text-muted">
                        Questioned {{ $question->created_date }}
                        <div class="media mt-2">
                        <a href="{{ $question->user->url }}" class="pr-2">
                            <img src="{{ $question->user->avatar }}">
                        </a>
                        <div class="media-body mt-1">
                            <a href="{{ $question->user->url }}">
                            {{ $question->user->name }} </a>
                        </div>
                        </div>
                    </span>
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
