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
                            <a title="This Answer is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
                            onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                                >
                                {{-- ganti fontawesome --}}
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            {{-- form and submit when the user favorite hit button --}}
                            <form action="/answers/{{ $answer->id }}/vote" method="POST" id="up-vote-answer-{{ $answer->id }}" style="display:none;">
                                @csrf
                                {{-- send a value rpresent a vote up --}}
                                <input type="hidden" name="vote" value="1">
                            </form>


                            {{-- show the number of votes --}}
                            <span class="votes-count"> {{ $answer->votes_count }}</span>

                            {{-- vote down the vote --}}
                            <a  title="This Answer is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}" 
                            onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                                >
                                {{-- ganti fontawesome --}}
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>
                            <form action="/answers/{{ $answer->id }}/vote" method="POST" id="down-vote-answer-{{ $answer->id }}" style="display:none;">
                                @csrf
                                {{-- send a value rpresent a vote up --}}
                                <input type="hidden" name="vote" value="-1">
                            </form>


                            {{-- check if the current user can accept the answer --}}
                            @can('accept', $answer)
                                {{-- mark the question as favorite --}}
                                <a title="Mark this answer as best answer" class="{{ $answer->status }} mt-2"
                                onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
                                    >
                                    {{-- ganti fontawesome --}}
                                    <i class="fas fa-check fa-2x"></i>
                                </a>

                                {{-- form and submit when the creator of the question hit button --}}
                                <form action="{{ route('answers.accept', $answer->id) }}" method="POST" id="accept-answer-{{ $answer->id }}" style="display:none;">
                                    @csrf
                                </form>

                            {{-- show the green check icon to mark this answer as best answer to anyone that see this question. --}}
                            @else 
                            {{-- check apakah answer sudah di acc as best answer --}}
                                @if($answer->is_best)
                                    {{-- mark the question as favorite --}}
                                    <a title="The question owner accepted this answer as best answer" class="{{ $answer->status }} mt-2">
                                            {{-- ganti fontawesome --}}
                                            <i class="fas fa-check fa-2x"></i>
                                    </a>
                                @endif
                            @endcan
                        </div>
                        <div class="media-body">
                            {!! $answer->body_html !!}

                            <div class="row">
                                <div class="col-4">
                                    <div class="ml-auto">
                                        {{-- auth user supaya button edit gk muncul --}}
                                        {{-- bisa juga pakai ini --}}
                                        @can('update', $answer)
                                            <a href="{{ route('questions.answers.edit', [$question->id, $answer->id]) }}" class="btn btn-sm btn-outline-info">Edit</a>
                                        @endcan

                                        {{-- bisa pakai ini untuk auth --}}
                                        {{-- @if(Auth::user()->can('delete', $question)) --}}
                                        @can('delete', $answer)
                                            <form class="form-delete" action="{{ route('questions.answers.destroy', [$question->id, $answer->id])}}" method="POST">
                                                {{-- {{  method_field('DELETE') }} --}}
                                                {{-- bisa pakai yg atas, bisa pakai yg bawah --}}
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        @endcan
                                    </div>
                                  </div>
                                <div class="col-4">
                                </div>
                                {{-- add other info and creation date --}}
                                <div class="col-4">
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
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>