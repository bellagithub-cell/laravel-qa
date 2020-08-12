{{-- buat answernya --}}
<div class="row mt-4">
    <div class="col-md-12">
        {{-- utilize bootstrap component --}}
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    {{-- total number answer of the curr question --}}
                    <h2>{{ $answersCount . " " . Str::plural('Answer', $question->answers_count) }}</h2>
                </div>
                <hr>
                {{-- render flash message --}}
                @include('layouts._messages')
                
                {{-- display all answer --}}
                @foreach ($answers as $answer )
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