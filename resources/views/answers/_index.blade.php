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
                    @include('answers._answer')
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif
