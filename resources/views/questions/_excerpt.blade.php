<div class="media post">
    {{-- buat bikin votes --}}
    <div class="d-felx flex-column counters">
        <div class="vote">
        <strong>{{ $question->votes_count }}</strong>
        {{ Str::plural('vote', $question->votes_count) }}
        </div>
        <div class="status {{ $question->status }} ">
            <strong>{{ $question->answers_count}}</strong>
            {{ Str::plural('answers', $question->answers_count) }}
        </div>
        <div class="view">
            {{ $question->views . " " . Str::plural('view', $question->views) }}
        </div>
    </div>  
    <div class="media-body">
        {{-- buat class div button edit dan judul --}}
        <div class="d-flex align-items-center">
            <h3 class="mt-0">
            <a href="{{ $question->url }}">
                {{ $question->title }}
            </a>
            </h3>
            <div class="ml-auto">
                {{-- auth user supaya button edit gk muncul --}}
                {{-- bisa juga pakai ini --}}
                @can('update', $question)
                    <a href="{{ route('questions.edit', $question->id ) }}" class="btn btn-sm btn-outline-info">Edit</a>
                @endcan

                {{-- bisa pakai ini untuk auth --}}
                {{-- @if(Auth::user()->can('delete', $question)) --}}
                @can('delete', $question)
                    <form class="form-delete" action="{{ route('questions.destroy', $question->id)}}" method="POST">
                        {{-- {{  method_field('DELETE') }} --}}
                        {{-- bisa pakai yg atas, bisa pakai yg bawah --}}
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                @endif
            </div>
        </div>
        <p class="lead">
            Asked by 
            <a href="{{ $question->user->url }} ">
                {{ $question->user->name }}
            </a>

            {{-- buat creation date --}}
            <small class="text-muted">
                {{ $question->created_date }}
            </small>
        </p>
        <div class="excerpt">
            {{ $question->excerpt(350) }}
        </div>
    </div>
</div>