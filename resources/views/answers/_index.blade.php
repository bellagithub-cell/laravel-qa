{{-- buat answernya --}}
@if($answersCount > 0)
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
                                    {{-- pindah ke _author.blade --}}
                                    @include('shared._author', [
                                        'model' => $answer,
                                        'label' => 'answered'
                                    ])
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
@endif
