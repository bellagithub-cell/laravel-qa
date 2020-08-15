{{-- check if the current user can accept the answer --}}
@can('accept', $model)
{{-- mark the question as favorite --}}
<a title="Mark this answer as best answer" class="{{ $model->status }} mt-2"
onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $model->id }}').submit();"
    >
    {{-- ganti fontawesome --}}
    <i class="fas fa-check fa-2x"></i>
</a>

{{-- form and submit when the creator of the question hit button --}}
<form action="{{ route('answers.accept', $model->id) }}" method="POST" id="accept-answer-{{ $model->id }}" style="display:none;">
    @csrf
</form>

{{-- show the green check icon to mark this answer as best answer to anyone that see this question. --}}
@else 
{{-- check apakah answer sudah di acc as best answer --}}
@if($model->is_best)
    {{-- mark the question as favorite --}}
    <a title="The question owner accepted this answer as best answer" class="{{ $model->status }} mt-2">
            {{-- ganti fontawesome --}}
            <i class="fas fa-check fa-2x"></i>
    </a>
@endif
@endcan