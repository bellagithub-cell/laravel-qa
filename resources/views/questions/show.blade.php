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
                            <a title="Click to mark as favorite question (CLick again to undo)" 
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '' ) }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();"
                                >
                                {{-- ganti fontawesome --}}
                                <i class="fas fa-star fa-2x"></i>

                                {{-- how many people favorite this question --}}
                                <span class="favorites-count">{{ $question->favorites_count }}</span>
                            </a>

                            {{-- form and submit when the user favorite hit button --}}
                            <form action="/questions/{{ $question->id }}/favorites" method="POST" id="favorite-question-{{ $question->id }}" style="display:none;">
                                @csrf

                                @if($question->is_favorited)
                                    @method ('DELETE')
                                @endif
                            </form>

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
    {{-- bagian answersnya dipindah  --}}
    @include ('answers._index', [
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])

    {{-- view baru create answer --}}
    @include ('answers._create')
</div>
@endsection
