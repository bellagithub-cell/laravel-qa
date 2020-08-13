{{-- mark the question as favorite --}}
<a title="Click to mark as favorite question (CLick again to undo)" 
class="favorite mt-2 {{ Auth::guest() ? 'off' : ($model->is_favorited ? 'favorited' : '' ) }}"
onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $model->id }}').submit();"
>
{{-- ganti fontawesome --}}
<i class="fas fa-star fa-2x"></i>

{{-- how many people favorite this question --}}
<span class="favorites-count">{{ $model->favorites_count }}</span>
</a>

{{-- form and submit when the user favorite hit button --}}
<form action="/questions/{{ $model->id }}/favorites" method="POST" id="favorite-question-{{ $model->id }}" style="display:none;">
@csrf

@if($model->is_favorited)
    @method ('DELETE')
@endif
</form>