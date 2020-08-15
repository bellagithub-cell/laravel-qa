{{-- viewnya pindah kesini --}}
@if($model instanceof App\Question)
    @php
      $name = 'question';
      $firstURISegment = 'questions';  
    @endphp
@elseif ($model instanceof App\Answer)
    @php
        $name = 'answer';
        $firstURISegment = 'answers';  
    @endphp
@endif


@php
    $formId = $name . "-" . $model->id;
    $formAction = "/{$firstURISegment}/{$model->id}/vote";
@endphp

{{-- vote control --}}
<div class="d-flex-column vote-controls">
    <a title="This {{ $name }} is useful" class="vote-up {{ Auth::guest() ? 'off' : '' }}"
    onclick="event.preventDefault(); document.getElementById('up-vote-{{ $formId }}').submit();"
        >
        {{-- ganti fontawesome --}}
        <i class="fas fa-caret-up fa-3x"></i>
    </a>
    {{-- form and submit when the user favorite hit button --}}
    <form action="{{ $formAction }}" method="POST" id="up-vote-{{ $formId }}" style="display:none;">
        @csrf
        {{-- send a value rpresent a vote up --}}
        <input type="hidden" name="vote" value="1">
    </form>


    {{-- show the number of votes --}}
    <span class="votes-count"> {{ $model->votes_count }}</span>

    {{-- vote down the vote --}}
    <a  title="This {{ $name }} is not useful" class="vote-down {{ Auth::guest() ? 'off' : '' }}" 
    onclick="event.preventDefault(); document.getElementById('down-vote-{{ $formId }}').submit();"
        >
        {{-- ganti fontawesome --}}
        <i class="fas fa-caret-down fa-3x"></i>
    </a>    
    <form id="down-vote-{{ $formId }}" action="{{ $formAction }}" method="POST" style="display:none;">
        @csrf
        {{-- send a value to represent vote up --}}
        <input type="hidden" name="vote" value="-1">
    </form>

    {{-- pindah ya yg favorite --}}
    @if($model instanceof App\Question)
        <favorite :question="{{ $model }}"></favorite>
    @elseif ($model instanceof App\Answer)
        <accept :answer="{{ $model }}"></accept>
    @endif
</div>